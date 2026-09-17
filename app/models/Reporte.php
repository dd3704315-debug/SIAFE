<?php

require_once "app/config/database.php";

class Reporte
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // ==========================================
    // LISTAR REPORTES
    // ==========================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    r.id_reporte,
                    r.id_empresa,
                    r.tipo_reporte,
                    r.periodo_anio,
                    r.periodo_mes,
                    r.total_ingresos,
                    r.total_gastos,
                    r.utilidad,
                    r.descripcion_reporte,
                    r.estado_reporte,
                    r.fecha_generacion,
                    r.fecha_actualizacion,
                    e.razon_social_empresa
                FROM reportes r
                INNER JOIN empresas e
                    ON r.id_empresa = e.id_empresa
                ORDER BY r.id_reporte DESC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER REPORTE POR ID
    // ==========================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT
                    r.*,
                    e.razon_social_empresa
                FROM reportes r
                INNER JOIN empresas e
                    ON r.id_empresa = e.id_empresa
                WHERE r.id_reporte = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // CREAR REPORTE
    // ==========================================

    public function crear(
        $idEmpresa,
        $tipoReporte,
        $anio,
        $mes,
        $totalIngresos,
        $totalGastos,
        $utilidad,
        $descripcion,
        $estado
    ) {

        $sql = "INSERT INTO reportes
                (
                    id_empresa,
                    tipo_reporte,
                    periodo_anio,
                    periodo_mes,
                    total_ingresos,
                    total_gastos,
                    utilidad,
                    descripcion_reporte,
                    estado_reporte
                )
                VALUES
                (
                    :id_empresa,
                    :tipo_reporte,
                    :anio,
                    :mes,
                    :total_ingresos,
                    :total_gastos,
                    :utilidad,
                    :descripcion,
                    :estado
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":tipo_reporte" => $tipoReporte,
            ":anio" => $anio,
            ":mes" => $mes,
            ":total_ingresos" => $totalIngresos,
            ":total_gastos" => $totalGastos,
            ":utilidad" => $utilidad,
            ":descripcion" => $descripcion,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ACTUALIZAR REPORTE
    // ==========================================

    public function actualizar(
        $idReporte,
        $idEmpresa,
        $tipoReporte,
        $anio,
        $mes,
        $totalIngresos,
        $totalGastos,
        $utilidad,
        $descripcion,
        $estado
    ) {

        $sql = "UPDATE reportes
                SET
                    id_empresa = :id_empresa,
                    tipo_reporte = :tipo_reporte,
                    periodo_anio = :anio,
                    periodo_mes = :mes,
                    total_ingresos = :total_ingresos,
                    total_gastos = :total_gastos,
                    utilidad = :utilidad,
                    descripcion_reporte = :descripcion,
                    estado_reporte = :estado,
                    fecha_actualizacion = NOW()
                WHERE id_reporte = :id_reporte";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_reporte" => $idReporte,
            ":id_empresa" => $idEmpresa,
            ":tipo_reporte" => $tipoReporte,
            ":anio" => $anio,
            ":mes" => $mes,
            ":total_ingresos" => $totalIngresos,
            ":total_gastos" => $totalGastos,
            ":utilidad" => $utilidad,
            ":descripcion" => $descripcion,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ELIMINAR REPORTE
    // ==========================================

    public function eliminar($idReporte)
    {
        $sql = "DELETE FROM reportes
                WHERE id_reporte = :id_reporte";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_reporte" => $idReporte
        ]);
    }
}