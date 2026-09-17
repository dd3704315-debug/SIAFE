<?php

require_once "app/models/Presupuesto.php";

class PresupuestoController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Presupuesto();
    }


    // ==========================================
    // LISTAR PRESUPUESTOS
    // ==========================================

    public function index()
    {
        $presupuestos = $this->modelo->obtenerTodos();

        require_once "app/views/presupuestos/index.php";
    }


    // ==========================================
    // CREAR PRESUPUESTO - FORMULARIO
    // ==========================================

    public function crear()
    {
        require_once "app/models/Empresa.php";

        $empresaModelo = new Empresa();

        $empresas = $empresaModelo->obtenerTodos();

        require_once "app/views/presupuestos/crear.php";
    }


    // ==========================================
    // GUARDAR PRESUPUESTO
    // ==========================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=presupuestos");
            exit;
        }

        $idEmpresa = $_POST["id_empresa"] ?? null;
        $anio = $_POST["anio_presupuesto"] ?? null;
        $mes = $_POST["mes_presupuesto"] ?? null;

        $ingresosEstimados =
            $_POST["presupuesto_ingresos_estimado"] ?? 0;

        $gastosEstimados =
            $_POST["presupuesto_gastos_estimado"] ?? 0;

        $descripcion =
            $_POST["presupuesto_descripcion"] ?? null;

        $estado =
            $_POST["estado_presupuesto"] ?? "Activo";


        // ==========================================
        // CALCULAR UTILIDAD ESTIMADA
        // ==========================================

        $utilidadEstimada =
            (float)$ingresosEstimados
            - (float)$gastosEstimados;


        $resultado = $this->modelo->crear(
            $idEmpresa,
            $anio,
            $mes,
            $ingresosEstimados,
            $gastosEstimados,
            $utilidadEstimada,
            $descripcion,
            $estado
        );


        if ($resultado) {

            header("Location: index.php?page=presupuestos");
            exit;

        } else {

            echo "Error al guardar el presupuesto.";
        }
    }


    // ==========================================
    // EDITAR PRESUPUESTO
    // ==========================================

    public function editar()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            header("Location: index.php?page=presupuestos");
            exit;
        }


        $datos = $this->modelo->obtenerPorId($id);

        if (!$datos) {
            echo "Presupuesto no encontrado.";
            exit;
        }


        require_once "app/models/Empresa.php";

        $empresaModelo = new Empresa();

        $empresas = $empresaModelo->obtenerTodos();


        require_once "app/views/presupuestos/editar.php";
    }


    // ==========================================
    // ACTUALIZAR PRESUPUESTO
    // ==========================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=presupuestos");
            exit;
        }


        $idPresupuesto =
            $_POST["id_presupuesto"] ?? null;

        $idEmpresa =
            $_POST["id_empresa"] ?? null;

        $anio =
            $_POST["anio_presupuesto"] ?? null;

        $mes =
            $_POST["mes_presupuesto"] ?? null;

        $ingresosEstimados =
            $_POST["presupuesto_ingresos_estimado"] ?? 0;

        $gastosEstimados =
            $_POST["presupuesto_gastos_estimado"] ?? 0;

        $descripcion =
            $_POST["presupuesto_descripcion"] ?? null;

        $estado =
            $_POST["estado_presupuesto"] ?? "Activo";


        // ==========================================
        // RECALCULAR UTILIDAD
        // ==========================================

        $utilidadEstimada =
            (float)$ingresosEstimados
            - (float)$gastosEstimados;


        $resultado = $this->modelo->actualizar(
            $idPresupuesto,
            $idEmpresa,
            $anio,
            $mes,
            $ingresosEstimados,
            $gastosEstimados,
            $utilidadEstimada,
            $descripcion,
            $estado
        );


        if ($resultado) {

            header("Location: index.php?page=presupuestos");
            exit;

        } else {

            echo "Error al actualizar el presupuesto.";
        }
    }


    // ==========================================
    // ELIMINAR PRESUPUESTO
    // ==========================================

    public function eliminar()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            header("Location: index.php?page=presupuestos");
            exit;
        }


        $resultado =
            $this->modelo->eliminar($id);


        if ($resultado) {

            header("Location: index.php?page=presupuestos");
            exit;

        } else {

            echo "Error al eliminar el presupuesto.";
        }
    }
}