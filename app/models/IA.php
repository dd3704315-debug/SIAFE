<?php

require_once "app/config/database.php";
require_once "app/config/ia.php";

class IA
{
    private $conexion;
    private $config;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
        $this->config = require "app/config/ia.php";
    }

    // =====================================================================
    // PUNTO DE ENTRADA: ARMA TODO EL ANÁLISIS DE UNA EMPRESA
    // =====================================================================
    //
    // Esta es la función que llama el controlador. Antes existía solo
    // "analizarVentas". Ahora se compone de varias piezas reales de
    // análisis, cada una en su propio método para poder probarlas o
    // reutilizarlas por separado (ej. desde el dashboard).
    // =====================================================================

    public function analizarEmpresa($idEmpresa)
    {
        $meses = $this->config["meses_historico"];

        $ventas       = $this->analizarVentas($idEmpresa);
        $serieMensual = $this->obtenerSerieMensual($idEmpresa, $meses);
        $tendencia    = $this->calcularTendencia($serieMensual["utilidad"]);
        $anomalias    = $this->detectarAnomalias($idEmpresa);
        $presupuesto  = $this->compararPresupuestoReal($idEmpresa);
        $salud        = $this->calcularSaludFinanciera(
            $idEmpresa,
            $tendencia,
            $anomalias,
            $presupuesto
        );
        $alertas        = $this->generarAlertas($idEmpresa, $tendencia, $anomalias, $presupuesto, $salud);
        $recomendaciones = $this->generarRecomendaciones($idEmpresa, $ventas, $tendencia, $presupuesto, $anomalias);

        $resumenEjecutivo = $this->generarResumenEjecutivo([
            "salud"        => $salud,
            "tendencia"    => $tendencia,
            "alertas"      => $alertas,
            "ventas"       => $ventas,
            "presupuesto"  => $presupuesto,
        ]);

        return [
            "ventas"          => $ventas,
            "serie_mensual"   => $serieMensual,
            "tendencia"       => $tendencia,
            "anomalias"       => $anomalias,
            "presupuesto"     => $presupuesto,
            "salud"           => $salud,
            "alertas"         => $alertas,
            "recomendaciones" => $recomendaciones,
            "resumen_ejecutivo" => $resumenEjecutivo,
        ];
    }

    // =====================================================================
    // ANALIZAR VENTAS (se mantiene, pero ahora entrega top 3 productos
    // en lugar de solo 1, y variación respecto al mes anterior)
    // =====================================================================

    public function analizarVentas($idEmpresa)
    {
        $sql = "SELECT
                    COUNT(*) AS cantidad_ventas,
                    COALESCE(SUM(total_venta), 0) AS total_vendido,
                    COALESCE(AVG(total_venta), 0) AS promedio_venta
                FROM ventas
                WHERE id_empresa = :id_empresa
                AND estado_venta = 'Pagada'";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([":id_empresa" => $idEmpresa]);
        $ventas = $stmt->fetch(PDO::FETCH_ASSOC);

        // Top 3 productos más vendidos (antes solo se traía 1)
        $sqlProductos = "SELECT
                            p.nombre_producto,
                            SUM(d.cantidad_producto_venta) AS cantidad_vendida
                        FROM detalle_ventas d
                        INNER JOIN ventas v ON d.id_venta = v.id_venta
                        INNER JOIN productos p ON d.id_producto = p.id_producto
                        WHERE v.id_empresa = :id_empresa
                        AND v.estado_venta = 'Pagada'
                        GROUP BY p.id_producto, p.nombre_producto
                        ORDER BY cantidad_vendida DESC
                        LIMIT 3";

        $stmtProductos = $this->conexion->prepare($sqlProductos);
        $stmtProductos->execute([":id_empresa" => $idEmpresa]);
        $topProductos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);

        // Comparación con el mes anterior (crecimiento/caída de ventas)
        $sqlComparativo = "SELECT
                DATE_FORMAT(fecha_venta, '%Y-%m') AS mes,
                COALESCE(SUM(total_venta), 0) AS total
            FROM ventas
            WHERE id_empresa = :id_empresa
            AND estado_venta = 'Pagada'
            AND fecha_venta >= DATE_SUB(CURDATE(), INTERVAL 2 MONTH)
            GROUP BY mes
            ORDER BY mes ASC";

        $stmtComp = $this->conexion->prepare($sqlComparativo);
        $stmtComp->execute([":id_empresa" => $idEmpresa]);
        $filas = $stmtComp->fetchAll(PDO::FETCH_ASSOC);

        $variacionVentas = null;
        if (count($filas) >= 2) {
            $anterior = (float) $filas[count($filas) - 2]["total"];
            $actual   = (float) $filas[count($filas) - 1]["total"];
            if ($anterior > 0) {
                $variacionVentas = round((($actual - $anterior) / $anterior) * 100, 1);
            }
        }

        return [
            "cantidad_ventas"     => (int) $ventas["cantidad_ventas"],
            "total_vendido"       => (float) $ventas["total_vendido"],
            "promedio_venta"      => (float) $ventas["promedio_venta"],
            "top_productos"       => $topProductos,
            "producto_mas_vendido" => $topProductos[0]["nombre_producto"] ?? "Sin datos",
            "cantidad_producto_mas_vendido" => (int) ($topProductos[0]["cantidad_vendida"] ?? 0),
            "variacion_ventas_pct" => $variacionVentas,
        ];
    }

    // =====================================================================
    // SERIE MENSUAL DE INGRESOS / GASTOS / UTILIDAD (últimos N meses)
    // =====================================================================
    //
    // Genera un histórico mes a mes, incluso rellenando con 0 los meses
    // sin movimientos, para que la serie sea continua (necesario para
    // que la regresión lineal de calcularTendencia() tenga sentido).
    // =====================================================================

    public function obtenerSerieMensual($idEmpresa, $meses = 6)
    {
        $etiquetas = [];
        $claves = [];

        for ($i = $meses - 1; $i >= 0; $i--) {
            $fecha = date("Y-m", strtotime("-$i month"));
            $claves[] = $fecha;
            $etiquetas[] = date("M Y", strtotime("-$i month"));
        }

        $ingresosPorMes = $this->obtenerAgregadoMensual(
            "ingresos", "valor_ingreso", "fecha_ingreso", "estado_ingreso", "Activo", $idEmpresa, $meses
        );

        $gastosPorMes = $this->obtenerAgregadoMensual(
            "gastos", "valor_gasto", "fecha_gasto", "estado_gasto", "Activo", $idEmpresa, $meses
        );

        $ingresos = [];
        $gastos = [];
        $utilidad = [];

        foreach ($claves as $clave) {
            $ing = (float) ($ingresosPorMes[$clave] ?? 0);
            $gas = (float) ($gastosPorMes[$clave] ?? 0);

            $ingresos[] = $ing;
            $gastos[] = $gas;
            $utilidad[] = $ing - $gas;
        }

        return [
            "etiquetas" => $etiquetas,
            "ingresos"  => $ingresos,
            "gastos"    => $gastos,
            "utilidad"  => $utilidad,
        ];
    }

    private function obtenerAgregadoMensual(
        $tabla, $campoValor, $campoFecha, $campoEstado, $estadoActivo, $idEmpresa, $meses
    ) {
        $sql = "SELECT
                    DATE_FORMAT($campoFecha, '%Y-%m') AS mes,
                    COALESCE(SUM($campoValor), 0) AS total
                FROM $tabla
                WHERE id_empresa = :id_empresa
                AND $campoEstado = :estado
                AND $campoFecha >= DATE_SUB(CURDATE(), INTERVAL :meses MONTH)
                GROUP BY mes
                ORDER BY mes ASC";

        // PDO no permite bind de INTERVAL como parámetro con nombre en todos los
        // drivers de forma confiable; se arma el intervalo de forma segura porque
        // $meses es un entero controlado internamente, no input de usuario.
        $sql = str_replace(":meses", (int) $meses, $sql);

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":estado"     => $estadoActivo,
        ]);

        $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $resultado = [];
        foreach ($filas as $fila) {
            $resultado[$fila["mes"]] = $fila["total"];
        }

        return $resultado;
    }

    // =====================================================================
    // PROYECCIÓN DE TENDENCIA (regresión lineal simple)
    // =====================================================================
    //
    // No requiere librerías de ML: es una regresión por mínimos cuadrados
    // sobre la serie mensual (x = número de mes, y = utilidad). Con esto
    // se estima hacia dónde va el negocio el próximo mes y si la
    // pendiente es positiva, negativa o estable.
    // =====================================================================

    public function calcularTendencia(array $serie)
    {
        $n = count($serie);

        if ($n < 2) {
            return [
                "disponible"    => false,
                "mensaje"       => "Histórico insuficiente para proyectar tendencia.",
            ];
        }

        $sumaX = 0; $sumaY = 0; $sumaXY = 0; $sumaX2 = 0;

        for ($x = 0; $x < $n; $x++) {
            $y = $serie[$x];
            $sumaX  += $x;
            $sumaY  += $y;
            $sumaXY += $x * $y;
            $sumaX2 += $x * $x;
        }

        $denominador = ($n * $sumaX2) - ($sumaX * $sumaX);

        if ($denominador == 0) {
            $pendiente = 0;
            $intercepto = $sumaY / $n;
        } else {
            $pendiente = (($n * $sumaXY) - ($sumaX * $sumaY)) / $denominador;
            $intercepto = ($sumaY - ($pendiente * $sumaX)) / $n;
        }

        $proyeccionProximoMes = $pendiente * $n + $intercepto;

        $promedio = $sumaY / $n;
        $umbralEstabilidad = max(abs($promedio) * 0.05, 1); // 5% del promedio, evita ruido

        if ($pendiente > $umbralEstabilidad) {
            $direccion = "creciente";
        } elseif ($pendiente < -$umbralEstabilidad) {
            $direccion = "decreciente";
        } else {
            $direccion = "estable";
        }

        $variacionPct = $promedio != 0
            ? round(($pendiente / abs($promedio)) * 100, 1)
            : 0;

        return [
            "disponible"            => true,
            "direccion"             => $direccion,
            "pendiente_mensual"     => round($pendiente, 2),
            "proyeccion_proximo_mes" => round($proyeccionProximoMes, 2),
            "variacion_relativa_pct" => $variacionPct,
        ];
    }

    // =====================================================================
    // DETECCIÓN DE ANOMALÍAS EN GASTOS (z-score)
    // =====================================================================
    //
    // Marca como "atípico" cualquier gasto individual que se aleje de la
    // media más de N desviaciones estándar (configurable). Esto es lo
    // que en un ERP real se llama detección de outliers / posible
    // fraude o error de registro.
    // =====================================================================

    public function detectarAnomalias($idEmpresa)
    {
        $sql = "SELECT
                    id_gasto,
                    valor_gasto,
                    descripcion_gasto,
                    fecha_gasto
                FROM gastos
                WHERE id_empresa = :id_empresa
                AND estado_gasto = 'Activo'
                AND fecha_gasto >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([":id_empresa" => $idEmpresa]);
        $gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $n = count($gastos);

        // Con muy pocos datos, el z-score no es confiable estadísticamente
        if ($n < 5) {
            return [];
        }

        $valores = array_map(fn($g) => (float) $g["valor_gasto"], $gastos);
        $media = array_sum($valores) / $n;

        $sumaCuadrados = 0;
        foreach ($valores as $v) {
            $sumaCuadrados += ($v - $media) ** 2;
        }
        $desviacion = sqrt($sumaCuadrados / $n);

        if ($desviacion == 0) {
            return [];
        }

        $umbral = $this->config["umbrales"]["anomalia_zscore"];
        $anomalias = [];

        foreach ($gastos as $i => $gasto) {
            $zscore = ($valores[$i] - $media) / $desviacion;

            if (abs($zscore) >= $umbral) {
                $anomalias[] = [
                    "id_gasto"     => $gasto["id_gasto"],
                    "descripcion"  => $gasto["descripcion_gasto"],
                    "valor"        => $valores[$i],
                    "fecha"        => $gasto["fecha_gasto"],
                    "zscore"       => round($zscore, 2),
                    "promedio_categoria" => round($media, 2),
                ];
            }
        }

        // Los más extremos primero
        usort($anomalias, fn($a, $b) => abs($b["zscore"]) <=> abs($a["zscore"]));

        return $anomalias;
    }

    // =====================================================================
    // PRESUPUESTO vs. REAL
    // =====================================================================
    //
    // Compara lo presupuestado para el mes actual (tabla presupuestos)
    // contra lo realmente ejecutado en ingresos/gastos ese mismo mes.
    // Antes el módulo de IA no usaba esta tabla en absoluto.
    // =====================================================================

    public function compararPresupuestoReal($idEmpresa)
    {
        $anioActual = date("Y");
        $mesActual  = date("n");

        $sql = "SELECT *
                FROM presupuestos
                WHERE id_empresa = :id_empresa
                AND anio_presupuesto = :anio
                AND mes_presupuesto = :mes
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":anio"       => $anioActual,
            ":mes"        => $mesActual,
        ]);

        $presupuesto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$presupuesto) {
            return [
                "disponible" => false,
                "mensaje"    => "No hay presupuesto registrado para el mes actual.",
            ];
        }

        $sqlReal = "SELECT
                    COALESCE((SELECT SUM(valor_ingreso) FROM ingresos
                        WHERE id_empresa = :id_empresa1
                        AND estado_ingreso = 'Activo'
                        AND YEAR(fecha_ingreso) = :anio1
                        AND MONTH(fecha_ingreso) = :mes1), 0) AS ingresos_reales,

                    COALESCE((SELECT SUM(valor_gasto) FROM gastos
                        WHERE id_empresa = :id_empresa2
                        AND estado_gasto = 'Activo'
                        AND YEAR(fecha_gasto) = :anio2
                        AND MONTH(fecha_gasto) = :mes2), 0) AS gastos_reales";

        $stmtReal = $this->conexion->prepare($sqlReal);
        $stmtReal->execute([
            ":id_empresa1" => $idEmpresa, ":anio1" => $anioActual, ":mes1" => $mesActual,
            ":id_empresa2" => $idEmpresa, ":anio2" => $anioActual, ":mes2" => $mesActual,
        ]);

        $real = $stmtReal->fetch(PDO::FETCH_ASSOC);

        $ingresosEstimados = (float) $presupuesto["presupuesto_ingresos_estimado"];
        $gastosEstimados   = (float) $presupuesto["presupuesto_gastos_estimado"];
        $ingresosReales    = (float) $real["ingresos_reales"];
        $gastosReales      = (float) $real["gastos_reales"];

        $desviacionGastosPct = $gastosEstimados > 0
            ? round((($gastosReales - $gastosEstimados) / $gastosEstimados) * 100, 1)
            : 0;

        $desviacionIngresosPct = $ingresosEstimados > 0
            ? round((($ingresosReales - $ingresosEstimados) / $ingresosEstimados) * 100, 1)
            : 0;

        return [
            "disponible"             => true,
            "ingresos_estimados"     => $ingresosEstimados,
            "gastos_estimados"       => $gastosEstimados,
            "ingresos_reales"        => $ingresosReales,
            "gastos_reales"          => $gastosReales,
            "desviacion_gastos_pct"   => $desviacionGastosPct,
            "desviacion_ingresos_pct" => $desviacionIngresosPct,
            "excede_presupuesto"     => $desviacionGastosPct > $this->config["umbrales"]["desviacion_presupuesto"],
        ];
    }

    // =====================================================================
    // SALUD FINANCIERA (score 0-100 + semáforo)
    // =====================================================================

    public function calcularSaludFinanciera($idEmpresa, array $tendencia, array $anomalias, array $presupuesto)
    {
        $sql = "SELECT
                    COALESCE((SELECT SUM(valor_ingreso) FROM ingresos
                        WHERE id_empresa = :id1 AND estado_ingreso = 'Activo'), 0) AS total_ingresos,
                    COALESCE((SELECT SUM(valor_gasto) FROM gastos
                        WHERE id_empresa = :id2 AND estado_gasto = 'Activo'), 0) AS total_gastos";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([":id1" => $idEmpresa, ":id2" => $idEmpresa]);
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        $ingresos = (float) $datos["total_ingresos"];
        $gastos = (float) $datos["total_gastos"];
        $utilidad = $ingresos - $gastos;

        $liquidez = $gastos > 0 ? $ingresos / $gastos : ($ingresos > 0 ? 2 : 0);
        $rentabilidad = $ingresos > 0 ? ($utilidad / $ingresos) * 100 : 0;

        $u = $this->config["umbrales"];
        $score = 100;
        $factores = [];

        if ($liquidez < $u["liquidez_critica"]) {
            $score -= 25;
            $factores[] = "Liquidez crítica (gastos superan ingresos)";
        } elseif ($liquidez < $u["liquidez_baja"]) {
            $score -= 10;
            $factores[] = "Liquidez ajustada";
        }

        if ($rentabilidad < $u["rentabilidad_critica"]) {
            $score -= 30;
            $factores[] = "Rentabilidad negativa";
        } elseif ($rentabilidad < $u["rentabilidad_baja"]) {
            $score -= 10;
            $factores[] = "Rentabilidad baja";
        }

        if (($tendencia["direccion"] ?? null) === "decreciente") {
            $score -= 15;
            $factores[] = "Tendencia de utilidad a la baja";
        }

        if (count($anomalias) > 0) {
            $score -= min(count($anomalias) * 5, 15);
            $factores[] = count($anomalias) . " gasto(s) atípico(s) detectado(s)";
        }

        if (($presupuesto["excede_presupuesto"] ?? false) === true) {
            $score -= 10;
            $factores[] = "Gastos reales superan el presupuesto del mes";
        }

        $score = max(0, min(100, $score));

        if ($score >= 75) {
            $semaforo = "verde";
        } elseif ($score >= 50) {
            $semaforo = "amarillo";
        } else {
            $semaforo = "rojo";
        }

        return [
            "score"        => $score,
            "semaforo"     => $semaforo,
            "liquidez"     => round($liquidez, 2),
            "rentabilidad" => round($rentabilidad, 1),
            "factores"     => $factores,
        ];
    }

    // =====================================================================
    // ALERTAS AUTOMÁTICAS
    // =====================================================================

    public function generarAlertas($idEmpresa, array $tendencia, array $anomalias, array $presupuesto, array $salud)
    {
        $alertas = [];

        foreach ($salud["factores"] as $factor) {
            $alertas[] = [
                "nivel"   => $salud["semaforo"] === "rojo" ? "critica" : "advertencia",
                "mensaje" => $factor,
            ];
        }

        if (!empty($anomalias)) {
            $top = $anomalias[0];
            $alertas[] = [
                "nivel"   => "advertencia",
                "mensaje" => "Gasto inusual detectado: \"" . $top["descripcion"] . "\" por $"
                    . number_format($top["valor"], 0, ",", ".")
                    . " (muy por encima del promedio habitual).",
            ];
        }

        if (($presupuesto["disponible"] ?? false) && $presupuesto["excede_presupuesto"]) {
            $alertas[] = [
                "nivel"   => "advertencia",
                "mensaje" => "Los gastos del mes ya superan el presupuesto estimado en "
                    . $presupuesto["desviacion_gastos_pct"] . "%.",
            ];
        }

        if (empty($alertas)) {
            $alertas[] = [
                "nivel"   => "info",
                "mensaje" => "No se detectaron alertas relevantes en el periodo analizado.",
            ];
        }

        return $alertas;
    }

    // =====================================================================
    // RECOMENDACIONES (varias, basadas en reglas sobre los datos reales)
    // =====================================================================

    public function generarRecomendaciones($idEmpresa, array $ventas, array $tendencia, array $presupuesto, array $anomalias)
    {
        $recomendaciones = [];

        if (!empty($ventas["top_productos"])) {
            $p = $ventas["top_productos"][0];
            $recomendaciones[] =
                "El producto con mayor movimiento es \"" . $p["nombre_producto"]
                . "\" (" . $p["cantidad_vendida"] . " unidades). Asegura stock suficiente para no perder ventas.";
        }

        if ($ventas["variacion_ventas_pct"] !== null) {
            if ($ventas["variacion_ventas_pct"] < 0) {
                $recomendaciones[] =
                    "Las ventas cayeron " . abs($ventas["variacion_ventas_pct"])
                    . "% respecto al mes anterior. Revisa campañas activas o estacionalidad antes de ajustar precios.";
            } elseif ($ventas["variacion_ventas_pct"] > 15) {
                $recomendaciones[] =
                    "Las ventas crecieron " . $ventas["variacion_ventas_pct"]
                    . "% respecto al mes anterior. Verifica que el inventario y el flujo de caja soporten ese ritmo.";
            }
        }

        if (($tendencia["direccion"] ?? null) === "decreciente") {
            $recomendaciones[] =
                "La utilidad muestra tendencia a la baja en los últimos meses. Revisa las categorías de gasto con mayor peso antes de que afecte la liquidez.";
        }

        if (($presupuesto["disponible"] ?? false) && $presupuesto["excede_presupuesto"]) {
            $recomendaciones[] =
                "Los gastos reales de este mes superan lo presupuestado. Considera revisar aprobaciones de gasto hasta ajustar la desviación.";
        }

        if (!empty($anomalias)) {
            $recomendaciones[] =
                "Se detectaron " . count($anomalias) . " gasto(s) fuera de lo habitual. Verifica los comprobantes correspondientes antes del cierre contable.";
        }

        if (empty($recomendaciones)) {
            $recomendaciones[] = "Los indicadores están dentro de rangos normales. Mantén el seguimiento periódico.";
        }

        return $recomendaciones;
    }

    // =====================================================================
    // RESUMEN EJECUTIVO EN LENGUAJE NATURAL
    // =====================================================================
    //
    // Si "narrativa_ia.activo" está en true y hay API key configurada,
    // se envía SOLO el resumen numérico ya calculado (nunca datos crudos
    // de clientes/facturas) a un LLM para redactar un párrafo ejecutivo.
    // Si está desactivado (por defecto), se arma un resumen con plantillas
    // locales — sigue siendo dinámico, solo que sin lenguaje generativo.
    // =====================================================================

    public function generarResumenEjecutivo(array $contexto)
    {
        $narrativaCfg = $this->config["narrativa_ia"];

        if ($narrativaCfg["activo"] && !empty($narrativaCfg["api_key"])) {
            $resultado = $this->llamarLLM($contexto, $narrativaCfg);
            if ($resultado !== null) {
                return $resultado;
            }
            // Si falla la llamada (timeout, error de red, etc.), no se rompe
            // la página: se cae al resumen local como respaldo.
        }

        return $this->resumenLocal($contexto);
    }

    private function resumenLocal(array $contexto)
    {
        $salud = $contexto["salud"];
        $tendencia = $contexto["tendencia"];

        $frasesSalud = [
            "verde"    => "La empresa presenta una situación financiera saludable",
            "amarillo" => "La empresa presenta una situación financiera que requiere atención",
            "rojo"     => "La empresa presenta señales de riesgo financiero que requieren acción inmediata",
        ];

        $texto = $frasesSalud[$salud["semaforo"]] . " (score " . $salud["score"] . "/100). ";

        if (($tendencia["direccion"] ?? null) === "creciente") {
            $texto .= "La utilidad muestra una tendencia creciente en el histórico reciente. ";
        } elseif (($tendencia["direccion"] ?? null) === "decreciente") {
            $texto .= "La utilidad muestra una tendencia decreciente que conviene monitorear. ";
        } else {
            $texto .= "La utilidad se ha mantenido relativamente estable. ";
        }

        $criticas = array_filter($contexto["alertas"], fn($a) => $a["nivel"] === "critica");
        if (!empty($criticas)) {
            $texto .= "Se identificaron " . count($criticas) . " alerta(s) crítica(s) que deben priorizarse.";
        } else {
            $texto .= "No se identificaron alertas críticas en el periodo.";
        }

        return $texto;
    }

    private function llamarLLM(array $contexto, array $cfg)
    {
        $prompt =
            "Eres un analista financiero. Con estos datos ya calculados (no inventes cifras nuevas), "
            . "redacta un resumen ejecutivo de 3-4 frases en español, claro y directo, para un dueño de "
            . "pequeña/mediana empresa:\n\n"
            . json_encode($contexto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $payload = json_encode([
            "model" => $cfg["modelo"],
            "max_tokens" => 300,
            "messages" => [
                ["role" => "user", "content" => $prompt],
            ],
        ]);

        $ch = curl_init("https://api.anthropic.com/v1/messages");

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_TIMEOUT => $cfg["timeout_s"],
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "x-api-key: " . $cfg["api_key"],
                "anthropic-version: 2023-06-01",
            ],
        ]);

        $respuesta = curl_exec($ch);
        $error = curl_errno($ch);
        curl_close($ch);

        if ($error || $respuesta === false) {
            return null;
        }

        $data = json_decode($respuesta, true);

        return $data["content"][0]["text"] ?? null;
    }
}
