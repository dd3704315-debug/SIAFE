<?php

require_once "app/config/database.php";

class Presupuesto
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // ==========================================
    // LISTAR PRESUPUESTOS
    // ==========================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    p.id_presupuesto,
                    p.id_empresa,
                    p.anio_presupuesto,
                    p.mes_presupuesto,
                    p.presupuesto_ingresos_estimado,
                    p.presupuesto_gastos_estimado,
                    p.presupuesto_utilidad_estimada,
                    p.presupuesto_descripcion,
                    p.estado_presupuesto,
                    p.fecha_creacion_presupuesto,
                    p.fecha_actualizacion_presupuesto,
                    e.razon_social_empresa
                FROM presupuestos p
                INNER JOIN empresas e
                    ON p.id_empresa = e.id_empresa
                ORDER BY p.id_presupuesto DESC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER PRESUPUESTO POR ID
    // ==========================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM presupuestos
                WHERE id_presupuesto = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // CREAR PRESUPUESTO
    // ==========================================

    public function crear(
        $idEmpresa,
        $anio,
        $mes,
        $ingresosEstimados,
        $gastosEstimados,
        $utilidadEstimada,
        $descripcion,
        $estado
    ) {

        $sql = "INSERT INTO presupuestos
                (
                    id_empresa,
                    anio_presupuesto,
                    mes_presupuesto,
                    presupuesto_ingresos_estimado,
                    presupuesto_gastos_estimado,
                    presupuesto_utilidad_estimada,
                    presupuesto_descripcion,
                    estado_presupuesto
                )
                VALUES
                (
                    :id_empresa,
                    :anio,
                    :mes,
                    :ingresos,
                    :gastos,
                    :utilidad,
                    :descripcion,
                    :estado
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":anio" => $anio,
            ":mes" => $mes,
            ":ingresos" => $ingresosEstimados,
            ":gastos" => $gastosEstimados,
            ":utilidad" => $utilidadEstimada,
            ":descripcion" => $descripcion,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ACTUALIZAR PRESUPUESTO
    // ==========================================

    public function actualizar(
        $idPresupuesto,
        $idEmpresa,
        $anio,
        $mes,
        $ingresosEstimados,
        $gastosEstimados,
        $utilidadEstimada,
        $descripcion,
        $estado
    ) {

        $sql = "UPDATE presupuestos
                SET
                    id_empresa = :id_empresa,
                    anio_presupuesto = :anio,
                    mes_presupuesto = :mes,
                    presupuesto_ingresos_estimado = :ingresos,
                    presupuesto_gastos_estimado = :gastos,
                    presupuesto_utilidad_estimada = :utilidad,
                    presupuesto_descripcion = :descripcion,
                    estado_presupuesto = :estado,
                    fecha_actualizacion_presupuesto = NOW()
                WHERE id_presupuesto = :id_presupuesto";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_presupuesto" => $idPresupuesto,
            ":id_empresa" => $idEmpresa,
            ":anio" => $anio,
            ":mes" => $mes,
            ":ingresos" => $ingresosEstimados,
            ":gastos" => $gastosEstimados,
            ":utilidad" => $utilidadEstimada,
            ":descripcion" => $descripcion,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ELIMINAR PRESUPUESTO
    // ==========================================

    public function eliminar($idPresupuesto)
    {
        $sql = "DELETE FROM presupuestos
                WHERE id_presupuesto = :id_presupuesto";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_presupuesto" => $idPresupuesto
        ]);
    }
}