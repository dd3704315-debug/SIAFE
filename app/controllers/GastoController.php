<?php

require_once "app/models/Gasto.php";

class GastoController
{
    // ==========================================
    // LISTAR GASTOS
    // ==========================================

    public function index()
    {
        $gasto = new Gasto();

        $gastos = $gasto->obtenerTodos();

        require_once "app/views/gastos/index.php";
    }


    // ==========================================
    // MOSTRAR FORMULARIO CREAR
    // ==========================================

    public function crear()
    {
        $gasto = new Gasto();

        $empresas = $gasto->obtenerEmpresas();

        $categorias = $gasto->obtenerCategorias();

        require_once "app/views/gastos/crear.php";
    }


    // ==========================================
    // GUARDAR GASTO
    // ==========================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $gasto = new Gasto();

            $resultado = $gasto->crear(
                $_POST["id_empresa"],
                $_POST["id_categoria_gasto"],
                $_POST["valor_gasto"],
                $_POST["descripcion_gasto"],
                $_POST["comprobante_gasto"] ?? null,
                $_POST["metodo_pago_gasto"],
                $_POST["observacion_gasto"] ?? null,
                $_POST["fecha_gasto"] ?? null,
                $_POST["estado_gasto"]
            );

            if ($resultado) {

                header("Location: index.php?page=gastos");
                exit;

            } else {

                echo "Error al guardar el gasto.";
            }
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

            header("Location: index.php?page=gastos");
            exit;
        }

        $gasto = new Gasto();

        $datos = $gasto->obtenerPorId($id);

        if (!$datos) {

            header("Location: index.php?page=gastos");
            exit;
        }

        $empresas = $gasto->obtenerEmpresas();

        $categorias = $gasto->obtenerCategorias();

        require_once "app/views/gastos/editar.php";
    }


    // ==========================================
    // ACTUALIZAR GASTO
    // ==========================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $gasto = new Gasto();

            $resultado = $gasto->actualizar(
                $_POST["id_gasto"],
                $_POST["id_empresa"],
                $_POST["id_categoria_gasto"],
                $_POST["valor_gasto"],
                $_POST["descripcion_gasto"],
                $_POST["comprobante_gasto"] ?? null,
                $_POST["metodo_pago_gasto"],
                $_POST["observacion_gasto"] ?? null,
                $_POST["fecha_gasto"] ?? null,
                $_POST["estado_gasto"]
            );

            if ($resultado) {

                header("Location: index.php?page=gastos");
                exit;

            } else {

                echo "Error al actualizar el gasto.";
            }
        }
    }


    // ==========================================
    // ELIMINAR GASTO
    // ==========================================

    public function eliminar()
    {
        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id) {

            header("Location: index.php?page=gastos");
            exit;
        }

        $gasto = new Gasto();

        $resultado = $gasto->eliminar($id);

        if ($resultado) {

            header("Location: index.php?page=gastos");
            exit;

        } else {

            echo "Error al eliminar el gasto.";
        }
    }
}