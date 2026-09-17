<?php

require_once "app/models/Reporte.php";

class ReporteController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Reporte();
    }


    // ==========================================
    // LISTAR REPORTES
    // ==========================================

    public function index()
    {
        $reportes = $this->modelo->obtenerTodos();

        require_once "app/views/reportes/index.php";
    }


    // ==========================================
    // CREAR REPORTE - FORMULARIO
    // ==========================================

    public function crear()
    {
        require_once "app/models/Empresa.php";

        $empresaModelo = new Empresa();

        $empresas = $empresaModelo->obtenerTodos();

        require_once "app/views/reportes/crear.php";
    }


    // ==========================================
    // GUARDAR REPORTE
    // ==========================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=reportes");
            exit;
        }

        $idEmpresa = $_POST["id_empresa"] ?? null;
        $tipoReporte = $_POST["tipo_reporte"] ?? "General";
        $anio = $_POST["periodo_anio"] ?? null;
        $mes = $_POST["periodo_mes"] ?? null;

    if ($mes === "") {
        $mes = null;
    }

        $totalIngresos =
            $_POST["total_ingresos"] ?? 0;

        $totalGastos =
            $_POST["total_gastos"] ?? 0;

        $descripcion =
            $_POST["descripcion_reporte"] ?? null;

        $estado =
            $_POST["estado_reporte"] ?? "Generado";


        // ==========================================
        // CALCULAR UTILIDAD
        // ==========================================

        $utilidad =
            (float)$totalIngresos
            - (float)$totalGastos;


        $resultado = $this->modelo->crear(
            $idEmpresa,
            $tipoReporte,
            $anio,
            $mes,
            $totalIngresos,
            $totalGastos,
            $utilidad,
            $descripcion,
            $estado
        );


        if ($resultado) {

            header("Location: index.php?page=reportes");
            exit;

        } else {

            echo "Error al guardar el reporte.";
        }
    }


    // ==========================================
    // EDITAR REPORTE
    // ==========================================

    public function editar()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            header("Location: index.php?page=reportes");
            exit;
        }


        $datos = $this->modelo->obtenerPorId($id);

        if (!$datos) {
            echo "Reporte no encontrado.";
            exit;
        }


        require_once "app/models/Empresa.php";

        $empresaModelo = new Empresa();

        $empresas = $empresaModelo->obtenerTodos();


        require_once "app/views/reportes/editar.php";
    }


    // ==========================================
    // ACTUALIZAR REPORTE
    // ==========================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=reportes");
            exit;
        }


        $idReporte =
            $_POST["id_reporte"] ?? null;

        $idEmpresa =
            $_POST["id_empresa"] ?? null;

        $tipoReporte =
            $_POST["tipo_reporte"] ?? "General";

        $anio =
            $_POST["periodo_anio"] ?? null;

        $mes =
            $_POST["periodo_mes"] ?? null;

        $totalIngresos =
            $_POST["total_ingresos"] ?? 0;

        $totalGastos =
            $_POST["total_gastos"] ?? 0;

        $descripcion =
            $_POST["descripcion_reporte"] ?? null;

        $estado =
            $_POST["estado_reporte"] ?? "Generado";


        // ==========================================
        // RECALCULAR UTILIDAD
        // ==========================================

        $utilidad =
            (float)$totalIngresos
            - (float)$totalGastos;


        $resultado = $this->modelo->actualizar(
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
        );


        if ($resultado) {

            header("Location: index.php?page=reportes");
            exit;

        } else {

            echo "Error al actualizar el reporte.";
        }
    }


    // ==========================================
    // ELIMINAR REPORTE
    // ==========================================

    public function eliminar()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            header("Location: index.php?page=reportes");
            exit;
        }


        $resultado =
            $this->modelo->eliminar($id);


        if ($resultado) {

            header("Location: index.php?page=reportes");
            exit;

        } else {

            echo "Error al eliminar el reporte.";
        }
    }
}