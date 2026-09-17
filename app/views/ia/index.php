<?php

require_once "app/views/layouts/header.php";

// El controlador ahora entrega $analisis con esta forma:
// ventas, serie_mensual, tendencia, anomalias, presupuesto, salud, alertas,
// recomendaciones, resumen_ejecutivo
$ventas = $analisis["ventas"];
$tendencia = $analisis["tendencia"];
$anomalias = $analisis["anomalias"];
$presupuesto = $analisis["presupuesto"];
$salud = $analisis["salud"];
$alertas = $analisis["alertas"];
$recomendaciones = $analisis["recomendaciones"];

?>

<style>

    :root {
        --azul-rey: #1746A2;
        --azul-rey-oscuro: #10357D;
        --azul-claro: #EAF1FF;
        --amarillo-girasol: #F9C80E;
        --amarillo-oscuro: #D9A900;
        --blanco: #FFFFFF;
        --gris-fondo: #F5F7FB;
        --gris-borde: #DDE3EE;
        --texto: #263238;
        --verde: #198754;
        --rojo: #DC3545;
    }

    body { background-color: var(--gris-fondo); }

    .ia-container { padding: 25px; }

    .encabezado-ia {
        background: linear-gradient(135deg, var(--azul-rey), var(--azul-rey-oscuro));
        color: var(--blanco);
        padding: 25px 30px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(16, 53, 125, 0.18);
    }

    .encabezado-ia h2 { margin: 0; font-size: 28px; font-weight: 700; }
    .encabezado-ia p { margin: 8px 0 0; opacity: 0.9; font-size: 15px; }

    .btn-volver {
        background-color: var(--blanco);
        color: var(--azul-rey);
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }
    .btn-volver:hover { background-color: var(--amarillo-girasol); color: #000; transform: translateY(-1px); }

    .linea-siafe {
        height: 5px; width: 100%;
        background: linear-gradient(90deg, var(--azul-rey) 0%, var(--azul-rey) 65%, var(--amarillo-girasol) 65%, var(--amarillo-girasol) 100%);
        border-radius: 10px; margin-bottom: 20px;
    }

    .seccion-ia {
        background-color: var(--blanco);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    }

    .titulo-seccion { color: var(--azul-rey); font-size: 21px; font-weight: 700; margin-bottom: 5px; }
    .subtitulo-seccion { color: #6c757d; font-size: 14px; margin-bottom: 20px; }

    .seccion-investigacion {
        border: 2px solid var(--azul-claro);
        background: linear-gradient(135deg, #FFFFFF, #F8FAFF);
    }
    .icono-investigacion {
        width: 45px; height: 45px; border-radius: 10px;
        background-color: var(--azul-claro);
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 22px; margin-right: 10px;
    }
    .buscador-ia .form-control { height: 48px; border: 1px solid var(--gris-borde); border-radius: 9px 0 0 9px; }
    .buscador-ia .form-control:focus { border-color: var(--azul-rey); box-shadow: 0 0 0 3px rgba(23, 70, 162, 0.12); }
    .btn-buscar-ia {
        background-color: var(--azul-rey); color: var(--blanco); border: none;
        font-weight: 700; padding: 0 22px; border-radius: 0 9px 9px 0; transition: all 0.2s ease;
    }
    .btn-buscar-ia:hover { background-color: var(--azul-rey-oscuro); color: var(--blanco); }
    .producto-consultado {
        background-color: var(--azul-claro); border: none; border-left: 5px solid var(--azul-rey);
        color: var(--texto); border-radius: 8px;
    }
    .titulo-resultados { color: var(--azul-rey); font-weight: 700; margin-bottom: 20px; }
    .resultado-producto { height: 100%; border: 1px solid var(--gris-borde); border-radius: 12px; background-color: var(--blanco); transition: all 0.2s ease; }
    .resultado-producto:hover { border-color: var(--azul-rey); box-shadow: 0 5px 15px rgba(23, 70, 162, 0.10); transform: translateY(-2px); }
    .resultado-producto h5 { color: var(--azul-rey); font-weight: 700; margin-bottom: 15px; }
    .dato-resultado { color: var(--texto); margin-bottom: 10px; font-size: 14px; }
    .precio-normal { background-color: var(--azul-claro); color: var(--azul-rey); padding: 6px 10px; border-radius: 7px; font-weight: 700; }
    .precio-promocion { background-color: #D1F7E3; color: #137333; padding: 6px 10px; border-radius: 7px; font-weight: 700; }
    .btn-ver-producto {
        background-color: var(--azul-rey); color: var(--blanco); border: none; border-radius: 8px;
        padding: 8px 15px; font-size: 13px; font-weight: 600; text-decoration: none; display: inline-block;
        margin-top: 8px; transition: all 0.2s ease;
    }
    .btn-ver-producto:hover { background-color: var(--amarillo-girasol); color: #000; }
    .alerta-sin-resultados { border-radius: 9px; border: none; }

    .tarjeta-resumen {
        background-color: var(--blanco); border-radius: 14px; padding: 22px; height: 100%;
        border: 1px solid var(--gris-borde); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease; position: relative; overflow: hidden;
    }
    .tarjeta-resumen:hover { transform: translateY(-2px); box-shadow: 0 7px 18px rgba(23, 70, 162, 0.10); }
    .tarjeta-resumen::before { content: ""; position: absolute; left: 0; top: 0; width: 5px; height: 100%; background-color: var(--azul-rey); }
    .tarjeta-resumen:nth-child(2)::before { background-color: var(--amarillo-girasol); }
    .tarjeta-resumen:nth-child(3)::before { background-color: var(--azul-rey-oscuro); }
    .icono-resumen { font-size: 25px; margin-bottom: 10px; }
    .tarjeta-resumen h6 { color: #6c757d; font-size: 13px; font-weight: 600; margin-bottom: 7px; }
    .tarjeta-resumen h2 { color: var(--azul-rey); font-size: 27px; font-weight: 700; margin: 0; }

    .producto-movimiento { border-left: 5px solid var(--amarillo-girasol); }
    .producto-movimiento h3 { color: var(--azul-rey); font-weight: 700; margin-bottom: 10px; }
    .cantidad-producto { background-color: var(--azul-claro); color: var(--azul-rey); padding: 6px 12px; border-radius: 20px; font-weight: 700; }

    .recomendacion-ia {
        background: linear-gradient(135deg, #FFFFFF, #FFFDF2);
        border: 2px solid var(--amarillo-girasol); border-radius: 15px; padding: 25px;
        box-shadow: 0 4px 14px rgba(217, 169, 0, 0.10);
    }
    .recomendacion-ia h4 { color: var(--azul-rey); font-weight: 700; }
    .recomendacion-contenido {
        background-color: var(--blanco); border-left: 5px solid var(--amarillo-girasol);
        border-radius: 8px; padding: 18px; color: var(--texto); line-height: 1.6; margin-bottom: 12px;
    }

    /* ===== NUEVO: SALUD FINANCIERA / SEMÁFORO ===== */
    .salud-card {
        display: flex; align-items: center; gap: 20px;
        border-radius: 15px; padding: 25px;
    }
    .salud-verde   { background: linear-gradient(135deg, #E8F8EE, #FFFFFF); border: 2px solid var(--verde); }
    .salud-amarillo { background: linear-gradient(135deg, #FFF9E6, #FFFFFF); border: 2px solid var(--amarillo-girasol); }
    .salud-rojo    { background: linear-gradient(135deg, #FDEAEC, #FFFFFF); border: 2px solid var(--rojo); }
    .salud-score {
        font-size: 42px; font-weight: 800; min-width: 110px; text-align: center;
        border-radius: 14px; padding: 12px 0; color: var(--blanco);
    }
    .salud-score.verde { background-color: var(--verde); }
    .salud-score.amarillo { background-color: var(--amarillo-oscuro); }
    .salud-score.rojo { background-color: var(--rojo); }
    .salud-factores { margin: 10px 0 0; padding-left: 18px; }
    .salud-factores li { margin-bottom: 4px; font-size: 14px; }

    /* ===== NUEVO: TENDENCIA ===== */
    .tendencia-badge {
        display: inline-block; padding: 6px 14px; border-radius: 20px; font-weight: 700; font-size: 13px;
    }
    .tendencia-creciente { background-color: #D1F7E3; color: #137333; }
    .tendencia-decreciente { background-color: #FDEAEC; color: var(--rojo); }
    .tendencia-estable { background-color: var(--azul-claro); color: var(--azul-rey); }

    /* ===== NUEVO: ALERTAS ===== */
    .alerta-item {
        display: flex; gap: 12px; align-items: flex-start;
        padding: 14px 16px; border-radius: 10px; margin-bottom: 10px; font-size: 14px;
    }
    .alerta-critica { background-color: #FDEAEC; border-left: 4px solid var(--rojo); }
    .alerta-advertencia { background-color: #FFF9E6; border-left: 4px solid var(--amarillo-oscuro); }
    .alerta-info { background-color: var(--azul-claro); border-left: 4px solid var(--azul-rey); }

    /* ===== NUEVO: ANOMALÍAS ===== */
    .tabla-anomalias { width: 100%; font-size: 14px; }
    .tabla-anomalias th { color: #6c757d; font-weight: 600; padding: 8px; text-align: left; border-bottom: 2px solid var(--gris-borde); }
    .tabla-anomalias td { padding: 10px 8px; border-bottom: 1px solid var(--gris-borde); }
    .badge-zscore { background-color: #FDEAEC; color: var(--rojo); padding: 3px 9px; border-radius: 12px; font-weight: 700; font-size: 12px; }

    /* ===== NUEVO: PRESUPUESTO VS REAL ===== */
    .barra-presupuesto { background-color: var(--gris-borde); border-radius: 8px; height: 10px; overflow: hidden; margin-top: 6px; }
    .barra-presupuesto-fill { height: 100%; border-radius: 8px; }

    @media (max-width: 768px) {
        .ia-container { padding: 15px; }
        .encabezado-ia { padding: 20px; }
        .encabezado-ia h2 { font-size: 23px; }
        .seccion-ia { padding: 20px; }
        .buscador-ia .form-control { border-radius: 9px; margin-bottom: 8px; }
        .btn-buscar-ia { width: 100%; height: 45px; border-radius: 9px; }
        .tarjeta-resumen { margin-bottom: 15px; }
        .btn-ver-producto { width: 100%; text-align: center; }
        .salud-card { flex-direction: column; text-align: center; }
    }

</style>


<div class="container-fluid ia-container">

    <!-- ENCABEZADO -->
    <div class="encabezado-ia">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2>🤖 Análisis Inteligente</h2>
                <p>Proyecciones, alertas y recomendaciones generadas a partir del comportamiento financiero real de la empresa.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="index.php?page=dashboard" class="btn-volver">← Volver al Dashboard</a>
            </div>
        </div>
    </div>

    <div class="linea-siafe"></div>

    <!-- ==========================================
         RESUMEN EJECUTIVO
    ========================================== -->
    <div class="seccion-ia">
        <h4 class="titulo-seccion">📝 Resumen ejecutivo</h4>
        <p class="subtitulo-seccion">Síntesis del estado financiero actual.</p>
        <hr>
        <p class="fs-5 mb-0"><?= htmlspecialchars($analisis["resumen_ejecutivo"]) ?></p>
    </div>

    <!-- ==========================================
         SALUD FINANCIERA
    ========================================== -->
    <div class="seccion-ia">
        <h4 class="titulo-seccion">🩺 Salud financiera</h4>
        <p class="subtitulo-seccion">Score compuesto a partir de liquidez, rentabilidad, tendencia y desviaciones detectadas.</p>
        <hr>

        <div class="salud-card salud-<?= $salud["semaforo"] ?>">
            <div class="salud-score <?= $salud["semaforo"] ?>"><?= $salud["score"] ?></div>
            <div>
                <h5 class="mb-2">
                    Liquidez: <?= $salud["liquidez"] ?> &nbsp;|&nbsp;
                    Rentabilidad: <?= $salud["rentabilidad"] ?>%
                </h5>
                <?php if (!empty($salud["factores"])): ?>
                    <ul class="salud-factores">
                        <?php foreach ($salud["factores"] as $factor): ?>
                            <li><?= htmlspecialchars($factor) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="mb-0 text-muted">Sin factores de riesgo detectados.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ==========================================
         TENDENCIA Y PROYECCIÓN
    ========================================== -->
    <div class="seccion-ia">
        <h4 class="titulo-seccion">📈 Tendencia y proyección</h4>
        <p class="subtitulo-seccion">Basado en regresión lineal sobre la utilidad de los últimos meses.</p>
        <hr>

        <?php if ($tendencia["disponible"]): ?>
            <span class="tendencia-badge tendencia-<?= $tendencia["direccion"] ?>">
                <?= ucfirst($tendencia["direccion"]) ?>
                (<?= $tendencia["variacion_relativa_pct"] ?>% respecto al promedio mensual)
            </span>
            <p class="mt-3 mb-0">
                Proyección de utilidad para el próximo mes:
                <strong>$<?= number_format($tendencia["proyeccion_proximo_mes"], 0, ",", ".") ?></strong>
            </p>
        <?php else: ?>
            <p class="text-muted mb-0"><?= htmlspecialchars($tendencia["mensaje"]) ?></p>
        <?php endif; ?>
    </div>

    <!-- ==========================================
         PRESUPUESTO VS REAL
    ========================================== -->
    <?php if ($presupuesto["disponible"]): ?>
        <div class="seccion-ia">
            <h4 class="titulo-seccion">📊 Presupuesto vs. real (mes actual)</h4>
            <hr>
            <div class="row g-4">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Gastos:</strong>
                        $<?= number_format($presupuesto["gastos_reales"], 0, ",", ".") ?>
                        de $<?= number_format($presupuesto["gastos_estimados"], 0, ",", ".") ?> presupuestados
                        (<?= $presupuesto["desviacion_gastos_pct"] >= 0 ? "+" : "" ?><?= $presupuesto["desviacion_gastos_pct"] ?>%)
                    </p>
                    <div class="barra-presupuesto">
                        <div class="barra-presupuesto-fill"
                             style="width: <?= min(100, max(0, $presupuesto["gastos_estimados"] > 0 ? ($presupuesto["gastos_reales"] / $presupuesto["gastos_estimados"]) * 100 : 0)) ?>%;
                                    background-color: <?= $presupuesto["excede_presupuesto"] ? "var(--rojo)" : "var(--verde)" ?>;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Ingresos:</strong>
                        $<?= number_format($presupuesto["ingresos_reales"], 0, ",", ".") ?>
                        de $<?= number_format($presupuesto["ingresos_estimados"], 0, ",", ".") ?> presupuestados
                        (<?= $presupuesto["desviacion_ingresos_pct"] >= 0 ? "+" : "" ?><?= $presupuesto["desviacion_ingresos_pct"] ?>%)
                    </p>
                    <div class="barra-presupuesto">
                        <div class="barra-presupuesto-fill"
                             style="width: <?= min(100, max(0, $presupuesto["ingresos_estimados"] > 0 ? ($presupuesto["ingresos_reales"] / $presupuesto["ingresos_estimados"]) * 100 : 0)) ?>%;
                                    background-color: var(--azul-rey);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- ==========================================
         ALERTAS
    ========================================== -->
    <div class="seccion-ia">
        <h4 class="titulo-seccion">🚨 Alertas</h4>
        <hr>
        <?php foreach ($alertas as $alerta): ?>
            <div class="alerta-item alerta-<?= $alerta["nivel"] ?>">
                <span>
                    <?= $alerta["nivel"] === "critica" ? "🔴" : ($alerta["nivel"] === "advertencia" ? "🟡" : "🔵") ?>
                </span>
                <span><?= htmlspecialchars($alerta["mensaje"]) ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ==========================================
         ANOMALÍAS EN GASTOS
    ========================================== -->
    <?php if (!empty($anomalias)): ?>
        <div class="seccion-ia">
            <h4 class="titulo-seccion">🔍 Gastos atípicos detectados</h4>
            <p class="subtitulo-seccion">Gastos que se alejan significativamente del promedio histórico (posible error o caso a revisar).</p>
            <hr>
            <table class="tabla-anomalias">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Valor</th>
                        <th>Promedio habitual</th>
                        <th>Desviación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anomalias as $a): ?>
                        <tr>
                            <td><?= htmlspecialchars($a["fecha"]) ?></td>
                            <td><?= htmlspecialchars($a["descripcion"]) ?></td>
                            <td>$<?= number_format($a["valor"], 0, ",", ".") ?></td>
                            <td>$<?= number_format($a["promedio_categoria"], 0, ",", ".") ?></td>
                            <td><span class="badge-zscore">z = <?= $a["zscore"] ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- ==========================================
         INVESTIGACIÓN DE MERCADO (se mantiene igual)
    ========================================== -->
    <div class="seccion-ia seccion-investigacion">
        <div class="d-flex align-items-center mb-2">
            <div class="icono-investigacion">🌐</div>
            <div>
                <h4 class="titulo-seccion mb-0">Investigación de mercado</h4>
                <p class="subtitulo-seccion mb-0">Consulta precios, descuentos y ofertas de productos disponibles en Internet.</p>
            </div>
        </div>

        <form method="GET" action="index.php" class="buscador-ia mt-4">
            <input type="hidden" name="page" value="ia_buscar">
            <div class="input-group">
                <input type="text" name="producto" class="form-control" placeholder="Ejemplo: Arroz Blanco 1kg" required>
                <button type="submit" class="btn-buscar-ia">🔎 Buscar en Internet</button>
            </div>
        </form>

        <?php if (isset($_SESSION["producto_busqueda_ia"])): ?>
            <div class="alert producto-consultado mt-4">
                🔎 Producto consultado:
                <strong><?= htmlspecialchars($_SESSION["producto_busqueda_ia"]) ?></strong>
            </div>

            <?php $resultadosInternet = $_SESSION["resultados_busqueda_ia"] ?? []; ?>

            <?php if (!empty($resultadosInternet)): ?>
                <div class="mt-4">
                    <h5 class="titulo-resultados">🌐 Resultados encontrados en Internet</h5>
                    <div class="row g-3">
                        <?php foreach ($resultadosInternet as $resultado): ?>
                            <div class="col-md-6">
                                <div class="resultado-producto">
                                    <div class="card-body">
                                        <h5>📦 <?= htmlspecialchars($resultado["producto"]) ?></h5>
                                        <p class="dato-resultado"><strong>🏪 Tienda:</strong> <?= htmlspecialchars($resultado["tienda"]) ?></p>
                                        <p class="dato-resultado">
                                            <strong>💰 Precio normal:</strong>
                                            <?php if (!empty($resultado["precio_normal"])): ?>
                                                <span class="precio-normal"><?= htmlspecialchars($resultado["precio_normal"]) ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">No disponible</span>
                                            <?php endif; ?>
                                        </p>
                                        <p class="dato-resultado">
                                            <strong>🏷️ Precio de promoción:</strong>
                                            <?php if (!empty($resultado["precio_promocion"])): ?>
                                                <span class="precio-promocion"><?= htmlspecialchars($resultado["precio_promocion"]) ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">No disponible</span>
                                            <?php endif; ?>
                                        </p>
                                        <a href="<?= htmlspecialchars($resultado["url"]) ?>" target="_blank" rel="noopener noreferrer" class="btn-ver-producto">🔗 Ver producto</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning alerta-sin-resultados mt-4">⚠️ No se encontraron resultados en Internet.</div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- ==========================================
         RESUMEN DE VENTAS
    ========================================== -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="tarjeta-resumen">
                <div class="icono-resumen">🧾</div>
                <h6>Ventas realizadas</h6>
                <h2><?= $ventas["cantidad_ventas"] ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tarjeta-resumen">
                <div class="icono-resumen">💰</div>
                <h6>Total vendido</h6>
                <h2>$<?= number_format($ventas["total_vendido"], 0, ",", ".") ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tarjeta-resumen">
                <div class="icono-resumen">📊</div>
                <h6>Promedio por venta</h6>
                <h2>$<?= number_format($ventas["promedio_venta"], 0, ",", ".") ?></h2>
            </div>
        </div>
    </div>

    <!-- ==========================================
         TOP PRODUCTOS
    ========================================== -->
    <div class="seccion-ia producto-movimiento">
        <h4 class="titulo-seccion">📦 Productos con mayor movimiento</h4>
        <p class="subtitulo-seccion">Top 3 productos por unidades vendidas.</p>
        <hr>
        <?php if (!empty($ventas["top_productos"])): ?>
            <?php foreach ($ventas["top_productos"] as $i => $p): ?>
                <p class="mb-2">
                    <?= $i + 1 ?>. <strong><?= htmlspecialchars($p["nombre_producto"]) ?></strong>
                    — <span class="cantidad-producto"><?= $p["cantidad_vendida"] ?> unidades</span>
                </p>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted mb-0">Sin datos de ventas aún.</p>
        <?php endif; ?>
    </div>

    <!-- ==========================================
         RECOMENDACIONES (ahora varias, no solo una)
    ========================================== -->
    <div class="recomendacion-ia">
        <h4>💡 Recomendaciones</h4>
        <p class="text-muted">Generadas a partir del análisis de ventas, gastos, presupuesto y tendencias.</p>
        <hr>
        <?php foreach ($recomendaciones as $rec): ?>
            <div class="recomendacion-contenido">
                <p class="mb-0"><?= htmlspecialchars($rec) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</div>


<?php

require_once "app/views/layouts/footer.php";

?>
