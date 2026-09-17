<?php

require_once "app/config/database.php";

class Plan
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }


    // ==========================================
    // OBTENER PLANES ACTIVOS (para landing y registro)
    // ==========================================

    public function obtenerActivos()
    {
        $sql = "SELECT *
                FROM planes
                WHERE estado_plan = 'Activo'
                ORDER BY id_plan ASC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER PLAN POR ID
    // ==========================================

    public function obtenerPorId($idPlan)
    {
        $sql = "SELECT *
                FROM planes
                WHERE id_plan = :id_plan
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id_plan" => $idPlan
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
