<?php

require_once "app/config/database.php";

class Indicador
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function obtenerEmpresas()
    {
        $sql = "SELECT
                    id_empresa,
                    razon_social_empresa
                FROM empresas
                WHERE estado_empresa = 'Activo'
                ORDER BY razon_social_empresa ASC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calcular($idEmpresa)
    {
        $sql = "SELECT
                    COALESCE((
                        SELECT SUM(valor_ingreso)
                        FROM ingresos
                        WHERE id_empresa = :id_empresa
                        AND estado_ingreso = 'Activo'
                    ), 0) AS total_ingresos,

                    COALESCE((
                        SELECT SUM(valor_gasto)
                        FROM gastos
                        WHERE id_empresa = :id_empresa
                        AND estado_gasto = 'Activo'
                    ), 0) AS total_gastos";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id_empresa" => $idEmpresa
        ]);

        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        $ingresos = (float) $datos["total_ingresos"];
        $gastos = (float) $datos["total_gastos"];

        $utilidad = $ingresos - $gastos;

        $liquidez = $gastos > 0
            ? $ingresos / $gastos
            : 0;

        $rentabilidad = $ingresos > 0
            ? ($utilidad / $ingresos) * 100
            : 0;

        return [
            "total_ingresos" => $ingresos,
            "total_gastos" => $gastos,
            "utilidad" => $utilidad,
            "liquidez" => $liquidez,
            "rentabilidad" => $rentabilidad
        ];
    }

    public function guardar($idEmpresa, $liquidez, $rentabilidad)
    {
        $sql = "INSERT INTO indicadores
                (
                    id_empresa,
                    liquidez,
                    rentabilidad,
                    fecha_calculo
                )
                VALUES
                (
                    :id_empresa,
                    :liquidez,
                    :rentabilidad,
                    CURDATE()
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":liquidez" => $liquidez,
            ":rentabilidad" => $rentabilidad
        ]);
    }

    public function obtenerUltimos()
    {
        $sql = "SELECT
                    i.id_indicador,
                    i.id_empresa,
                    i.liquidez,
                    i.rentabilidad,
                    i.fecha_calculo,
                    e.razon_social_empresa
                FROM indicadores i
                INNER JOIN empresas e
                    ON i.id_empresa = e.id_empresa
                ORDER BY i.id_indicador DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
