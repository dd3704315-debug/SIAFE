<?php

require_once "app/models/Empresa.php";
require_once "app/models/Usuario.php";

class EmpresaController
{
    // ==========================================
    // LISTAR EMPRESAS
    // ==========================================

    public function index()
    {
        $empresa = new Empresa();

        $empresas = $empresa->obtenerTodos();

        require_once "app/views/empresas/index.php";
    }


    // ==========================================
    // MOSTRAR FORMULARIO CREAR
    // ==========================================

    public function crear()
    {
        $usuario = new Usuario();

        $usuarios = $usuario->obtenerTodos();

        require_once "app/views/empresas/crear.php";
    }


    // ==========================================
    // GUARDAR EMPRESA
    // ==========================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=empresas");
            exit;
        }

        $empresa = new Empresa();

        $idUsuario = $_POST["id_usuario"] ?? "";
        $nit = trim($_POST["nit_empresa"] ?? "");
        $razonSocial = trim($_POST["razon_social_empresa"] ?? "");
        $nombreComercial = trim($_POST["nombre_comercial_empresa"] ?? "");
        $correo = trim($_POST["correo_empresa"] ?? "");
        $telefono = trim($_POST["telefono_empresa"] ?? "");
        $direccion = trim($_POST["direccion_empresa"] ?? "");
        $ciudad = trim($_POST["ciudad_empresa"] ?? "");
        $departamento = trim($_POST["departamento_empresa"] ?? "");
        $sectorEconomico = trim($_POST["sector_economico_empresa"] ?? "");
        $representanteLegal = trim($_POST["representante_legal_empresa"] ?? "");
        $estado = $_POST["estado_empresa"] ?? "Activo";


        // ==========================================
        // VALIDAR NIT
        // ==========================================

        if ($empresa->existeNit($nit)) {

            $error = "El NIT ingresado ya está registrado.";

            $usuario = new Usuario();
            $usuarios = $usuario->obtenerTodos();

            require_once "app/views/empresas/crear.php";
            return;
        }


        // ==========================================
        // CREAR EMPRESA
        // ==========================================

        $empresa->crear(
            $idUsuario,
            $nit,
            $razonSocial,
            $nombreComercial,
            $correo,
            $telefono,
            $direccion,
            $ciudad,
            $departamento,
            $sectorEconomico,
            $representanteLegal,
            $estado
        );


        header("Location: index.php?page=empresas");
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
            header("Location: index.php?page=empresas");
            exit;
        }


        $empresa = new Empresa();

        $datos = $empresa->obtenerPorId($id);


        if (!$datos) {
            header("Location: index.php?page=empresas");
            exit;
        }


        $usuario = new Usuario();

        $usuarios = $usuario->obtenerTodos();


        require_once "app/views/empresas/editar.php";
    }


    // ==========================================
    // ACTUALIZAR EMPRESA
    // ==========================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=empresas");
            exit;
        }


        $empresa = new Empresa();

        $idEmpresa = filter_input(
            INPUT_POST,
            "id_empresa",
            FILTER_VALIDATE_INT
        );

        $idUsuario = $_POST["id_usuario"] ?? "";
        $nit = trim($_POST["nit_empresa"] ?? "");
        $razonSocial = trim($_POST["razon_social_empresa"] ?? "");
        $nombreComercial = trim($_POST["nombre_comercial_empresa"] ?? "");
        $correo = trim($_POST["correo_empresa"] ?? "");
        $telefono = trim($_POST["telefono_empresa"] ?? "");
        $direccion = trim($_POST["direccion_empresa"] ?? "");
        $ciudad = trim($_POST["ciudad_empresa"] ?? "");
        $departamento = trim($_POST["departamento_empresa"] ?? "");
        $sectorEconomico = trim($_POST["sector_economico_empresa"] ?? "");
        $representanteLegal = trim($_POST["representante_legal_empresa"] ?? "");
        $estado = $_POST["estado_empresa"] ?? "Activo";


        if (!$idEmpresa) {
            header("Location: index.php?page=empresas");
            exit;
        }


        $empresa->actualizar(
            $idEmpresa,
            $idUsuario,
            $nit,
            $razonSocial,
            $nombreComercial,
            $correo,
            $telefono,
            $direccion,
            $ciudad,
            $departamento,
            $sectorEconomico,
            $representanteLegal,
            $estado
        );


        header("Location: index.php?page=empresas");
        exit;
    }


    // ==========================================
    // ELIMINAR EMPRESA
    // ==========================================

    public function eliminar()
    {
        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id) {
            header("Location: index.php?page=empresas");
            exit;
        }


        $empresa = new Empresa();

        $empresa->eliminar($id);


        header("Location: index.php?page=empresas");
        exit;
    }
}