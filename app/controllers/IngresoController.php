<?php

require_once "app/models/Ingreso.php";

class IngresoController
{
    // ==========================================
    // LISTAR INGRESOS
    // ==========================================

    public function index()
    {
        $ingreso = new Ingreso();

        $ingresos = $ingreso->obtenerTodos();

        require_once "app/views/ingresos/index.php";
    }


    // ==========================================
    // MOSTRAR FORMULARIO CREAR
    // ==========================================

        public function crear()
    {
        $ingreso = new Ingreso();

        $empresas = $ingreso->obtenerEmpresas();

        $categorias = $ingreso->obtenerCategorias();

        require_once "app/views/ingresos/crear.php";
    }

    // ==========================================
    // GUARDAR INGRESO
    // ==========================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $ingreso = new Ingreso();

            $ingreso->crear(
                $_POST["id_empresa"],
                $_POST["id_categoria_ingreso"],
                $_POST["valor_ingreso"],
                $_POST["descripcion_ingreso"],
                $_POST["comprobante_ingreso"] ?? null,
                $_POST["metodo_pago_ingreso"],
                $_POST["observacion_ingreso"] ?? null,
                $_POST["fecha_ingreso"] ?? null,
                $_POST["estado_ingreso"]
            );

            header("Location: index.php?page=ingresos");
            exit;
        }
    }


    // ==========================================
    // MOSTRAR FORMULARIO EDITAR
    // ==========================================

    public function editar()
    {
        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id) {

            header("Location: index.php?page=ingresos");
            exit;
        }

        $ingreso = new Ingreso();

        $datos = $ingreso->obtenerPorId($id);

        if (!$datos) {

            header("Location: index.php?page=ingresos");
            exit;
        }

        // Obtener empresas activas
        $empresas = $ingreso->obtenerEmpresas();

        // Obtener categorías activas
        $categorias = $ingreso->obtenerCategorias();

        require_once "app/views/ingresos/editar.php";
    }

    // ==========================================
    // ACTUALIZAR INGRESO
    // ==========================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $ingreso = new Ingreso();

            $ingreso->actualizar(
                $_POST["id_ingreso"],
                $_POST["id_empresa"],
                $_POST["id_categoria_ingreso"],
                $_POST["valor_ingreso"],
                $_POST["descripcion_ingreso"],
                $_POST["comprobante_ingreso"] ?? null,
                $_POST["metodo_pago_ingreso"],
                $_POST["observacion_ingreso"] ?? null,
                $_POST["fecha_ingreso"] ?? null,
                $_POST["estado_ingreso"]
            );

            header("Location: index.php?page=ingresos");
            exit;
        }
    }


        // ==========================================
    // ELIMINAR INGRESO
    // ==========================================

    public function eliminar()
    {
        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id) {

            header("Location: index.php?page=ingresos");
            exit;
        }

        $ingreso = new Ingreso();

        $resultado = $ingreso->eliminar($id);

        if ($resultado) {

            header("Location: index.php?page=ingresos");
            exit;

        } else {

            echo "Error al eliminar el ingreso.";
        }
    }
}