<?php

require_once "app/models/Dashboard.php";
require_once "app/models/Indicador.php";

class DashboardController
{
    private $dashboard;
    private $indicador;

    public function __construct()
    {
        $this->dashboard = new Dashboard();
        $this->indicador = new Indicador();
    }

    // ==========================================
    // MOSTRAR DASHBOARD
    // ==========================================
    public function index()
    {
        // Datos generales
        $empresas = $this->dashboard->contarEmpresas();
        $productos = $this->dashboard->contarProductos();
        $ventas = $this->dashboard->contarVentas();
        $gastos = $this->dashboard->contarGastos();

        // Datos financieros
        $totalIngresos = $this->dashboard->totalIngresos();
        $totalGastos = $this->dashboard->totalGastos();
        $utilidad = $this->dashboard->utilidad();

        // Indicadores financieros
        $indicadores = $this->indicador->obtenerUltimos();

        // Valores generales de indicadores
        $rentabilidad = 0;
        $liquidez = 0;

        if (!empty($indicadores)) {
            $rentabilidad = $indicadores[0]["rentabilidad"] ?? 0;
            $liquidez = $indicadores[0]["liquidez"] ?? 0;
        }

        require_once "app/views/dashboard/index.php";
    }
}