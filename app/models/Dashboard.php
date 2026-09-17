<?php

require_once "app/config/database.php";

class Dashboard
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // ==========================================
    // CONTAR EMPRESAS
    // ==========================================

    public function contarEmpresas()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM empresas";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }


    // ==========================================
    // CONTAR PRODUCTOS
    // ==========================================

    public function contarProductos()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM productos";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }


    // ==========================================
    // CONTAR VENTAS
    // ==========================================

    public function contarVentas()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM ventas";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }


    // ==========================================
    // CONTAR GASTOS
    // ==========================================

    public function contarGastos()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM gastos";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }

    // ==========================================
    // TOTAL DE INGRESOS
    // ==========================================

    public function totalIngresos()
    {
        $sql = "SELECT COALESCE(SUM(valor_ingreso), 0) AS total
                FROM ingresos";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }


    // ==========================================
    // TOTAL DE GASTOS
    // ==========================================

    public function totalGastos()
    {
        $sql = "SELECT COALESCE(SUM(valor_gasto), 0) AS total
                FROM gastos";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }


    // ==========================================
    // UTILIDAD
    // ==========================================

    public function utilidad()
    {
        $ingresos = $this->totalIngresos();

        $gastos = $this->totalGastos();

        return $ingresos - $gastos;
    }

}