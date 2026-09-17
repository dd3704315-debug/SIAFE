<?php

require_once "app/models/Cliente.php";

class ClienteController
{
    // ==========================================
    // LISTAR CLIENTES
    // ==========================================

    public function index()
    {
        $cliente = new Cliente();

        $clientes = $cliente->obtenerTodos();

        require_once "app/views/clientes/index.php";
    }


    // ==========================================
    // MOSTRAR FORMULARIO CREAR
    // ==========================================

    public function crear()
    {
        require_once "app/views/clientes/crear.php";
    }


    // ==========================================
    // GUARDAR CLIENTE
    // ==========================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=clientes");
            exit;
        }

        $idEmpresa = $_POST["id_empresa"] ?? "";
        $tipoDocumento = $_POST["tipo_documento_cliente"] ?? "";
        $documento = trim($_POST["documento_cliente"] ?? "");
        $nombres = trim($_POST["nombres_cliente"] ?? "");
        $apellidos = trim($_POST["apellidos_cliente"] ?? "");
        $correo = trim($_POST["correo_cliente"] ?? "");
        $telefono = trim($_POST["telefono_cliente"] ?? "");
        $direccion = trim($_POST["direccion_cliente"] ?? "");
        $ciudad = trim($_POST["ciudad_cliente"] ?? "");
        $estado = $_POST["estado_cliente"] ?? "Activo";
        $observacion = trim($_POST["observacion_cliente"] ?? "");


        // ==========================================
        // VALIDAR CAMPOS OBLIGATORIOS
        // ==========================================

        if (
            empty($idEmpresa) ||
            empty($tipoDocumento) ||
            empty($documento)
        ) {
            echo "Los campos obligatorios no fueron completados.";
            exit;
        }


        // ==========================================
        // VERIFICAR DOCUMENTO
        // ==========================================

        $cliente = new Cliente();

        if ($cliente->existeDocumento($documento)) {

            echo "Ya existe un cliente con ese documento.";
            exit;
        }


        // ==========================================
        // CREAR CLIENTE
        // ==========================================

        $cliente->crear(
            $idEmpresa,
            $tipoDocumento,
            $documento,
            $nombres,
            $apellidos,
            $correo,
            $telefono,
            $direccion,
            $ciudad,
            $estado,
            $observacion
        );


        // ==========================================
        // REGRESAR A CLIENTES
        // ==========================================

        header("Location: index.php?page=clientes");
        exit;
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
            header("Location: index.php?page=clientes");
            exit;
        }


        $cliente = new Cliente();

        $datos = $cliente->obtenerPorId($id);


        if (!$datos) {
            echo "Cliente no encontrado.";
            exit;
        }


        require_once "app/views/clientes/editar.php";
    }


    // ==========================================
    // ACTUALIZAR CLIENTE
    // ==========================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=clientes");
            exit;
        }


        $idCliente = filter_input(
            INPUT_POST,
            "id_cliente",
            FILTER_VALIDATE_INT
        );

        $idEmpresa = $_POST["id_empresa"] ?? "";
        $tipoDocumento = $_POST["tipo_documento_cliente"] ?? "";
        $documento = trim($_POST["documento_cliente"] ?? "");
        $nombres = trim($_POST["nombres_cliente"] ?? "");
        $apellidos = trim($_POST["apellidos_cliente"] ?? "");
        $correo = trim($_POST["correo_cliente"] ?? "");
        $telefono = trim($_POST["telefono_cliente"] ?? "");
        $direccion = trim($_POST["direccion_cliente"] ?? "");
        $ciudad = trim($_POST["ciudad_cliente"] ?? "");
        $estado = $_POST["estado_cliente"] ?? "Activo";
        $observacion = trim($_POST["observacion_cliente"] ?? "");


        if (!$idCliente) {
            header("Location: index.php?page=clientes");
            exit;
        }


        // ==========================================
        // ACTUALIZAR
        // ==========================================

        $cliente = new Cliente();

        $cliente->actualizar(
            $idCliente,
            $idEmpresa,
            $tipoDocumento,
            $documento,
            $nombres,
            $apellidos,
            $correo,
            $telefono,
            $direccion,
            $ciudad,
            $estado,
            $observacion
        );


        header("Location: index.php?page=clientes");
        exit;
    }


    // ==========================================
    // ELIMINAR CLIENTE
    // ==========================================

    public function eliminar()
    {
        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            header("Location: index.php?page=clientes");
            exit;
        }


        $cliente = new Cliente();

        $cliente->eliminar($id);


        header("Location: index.php?page=clientes");
        exit;
    }
}