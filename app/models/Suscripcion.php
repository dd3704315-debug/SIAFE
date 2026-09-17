<?php

require_once "app/config/database.php";

class Suscripcion
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // ==========================================
    // CREAR SUSCRIPCIÓN
    // ==========================================
    public function crear(
        $idUsuario,
        $idEmpresa,
        $idPlan,
        $cicloFacturacion,
        $precioPagado,
        $fechaInicio,
        $fechaFin
    ) {
        /*
         * La tabla suscripciones actual de SIAFE
         * utiliza estas columnas:
         *
         * id_usuario
         * id_empresa
         * id_plan
         * fecha_inicio_suscripcion
         * fecha_fin_suscripcion
         * estado_suscripcion
         *
         * cicloFacturacion y precioPagado se reciben
         * para mantener compatible el controlador,
         * pero actualmente no se almacenan porque
         * esas columnas no existen en la tabla.
         */

        $sql = "INSERT INTO suscripciones
                (
                    id_usuario,
                    id_empresa,
                    id_plan,
                    fecha_inicio_suscripcion,
                    fecha_fin_suscripcion,
                    estado_suscripcion
                )
                VALUES
                (
                    :id_usuario,
                    :id_empresa,
                    :id_plan,
                    :fecha_inicio,
                    :fecha_fin,
                    'Activa'
                )";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id_usuario" => $idUsuario,
            ":id_empresa" => $idEmpresa,
            ":id_plan" => $idPlan,
            ":fecha_inicio" => $fechaInicio,
            ":fecha_fin" => $fechaFin
        ]);

        return $this->conexion->lastInsertId();
    }

    // ==========================================
    // OBTENER SUSCRIPCIÓN ACTUAL DE UNA EMPRESA
    // ==========================================
    public function obtenerActualPorEmpresa($idEmpresa)
    {
        $sql = "SELECT
                    s.*,
                    p.nombre_plan,
                    p.descripcion_plan,
                    p.precio_plan,
                    p.periodo_plan
                FROM suscripciones s
                INNER JOIN planes p
                    ON p.id_plan = s.id_plan
                WHERE s.id_empresa = :id_empresa
                ORDER BY s.id_suscripcion DESC
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id_empresa" => $idEmpresa
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}