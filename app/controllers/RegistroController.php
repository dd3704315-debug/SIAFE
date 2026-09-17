<?php

require_once "app/models/Plan.php";
require_once "app/models/Empresa.php";
require_once "app/models/Usuario.php";
require_once "app/models/Suscripcion.php";

class RegistroController
{
    private $planModel;
    private $empresaModel;
    private $usuarioModel;
    private $suscripcionModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->planModel = new Plan();
        $this->empresaModel = new Empresa();
        $this->usuarioModel = new Usuario();
        $this->suscripcionModel = new Suscripcion();

        if (!isset($_SESSION["registro"])) {
            $_SESSION["registro"] = ["paso" => 1];
        }
    }


    // ==========================================
    // MOSTRAR EL PASO ACTUAL DEL ASISTENTE
    // ==========================================

    public function index()
    {
        $maximoAlcanzado = $_SESSION["registro"]["paso"];

        // Permite volver a un paso anterior con ?paso=N, nunca saltar hacia adelante.
        $pasoSolicitado = isset($_GET["paso"]) ? (int) $_GET["paso"] : $maximoAlcanzado;

        if ($pasoSolicitado < 1 || $pasoSolicitado > $maximoAlcanzado) {
            $pasoSolicitado = $maximoAlcanzado;
        }

        $paso = $pasoSolicitado;
        $datos = $_SESSION["registro"];

        switch ($paso) {

            case 1:
                $planes = $this->planModel->obtenerActivos();
                require "app/views/registro/paso1_plan.php";
                break;

            case 2:
                $planes = $this->planModel->obtenerActivos();
                require "app/views/registro/paso2_empresa.php";
                break;

            case 3:
                require "app/views/registro/paso3_usuario.php";
                break;

            case 4:
                $plan = $this->planModel->obtenerPorId($datos["id_plan"]);
                require "app/views/registro/paso4_confirmar.php";
                break;

            default:
                header("Location: index.php?page=registro");
                exit;
        }
    }


    // ==========================================
    // PASO 1: GUARDAR PLAN ELEGIDO
    // ==========================================

    // ==========================================
// PASO 1: GUARDAR PLAN ELEGIDO
// ==========================================
public function guardarPlan()
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: index.php?page=registro");
        exit;
    }

    $idPlan = (int) ($_POST["id_plan"] ?? 0);

    $plan = $this->planModel->obtenerPorId($idPlan);

    if (!$plan || $plan["estado_plan"] !== "Activo") {
        $_SESSION["registro_error"] = "Selecciona un plan válido.";
        header("Location: index.php?page=registro&paso=1");
        exit;
    }

    /*
     * Los planes actuales de SIAFE tienen un único precio
     * y un periodo definido directamente en la tabla planes.
     *
     * Ejemplo:
     * Básico       → $0       → Gratis
     * Empresarial  → $29.900  → Mensual
     * Inteligente  → $49.900  → Mensual
     */

    $periodo = $plan["periodo_plan"];

    $_SESSION["registro"]["id_plan"] = $idPlan;
    $_SESSION["registro"]["ciclo"] = $periodo;
    $_SESSION["registro"]["precio"] = (float) $plan["precio_plan"];
    $_SESSION["registro"]["paso"] = max($_SESSION["registro"]["paso"], 2);

    header("Location: index.php?page=registro&paso=2");
    exit;
}
    // ==========================================
    // PASO 2: GUARDAR DATOS DE LA EMPRESA
    // ==========================================

    public function guardarEmpresa()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=registro");
            exit;
        }

        $nit = trim($_POST["nit"] ?? "");
        $razonSocial = trim($_POST["razon_social"] ?? "");
        $nombreComercial = trim($_POST["nombre_comercial"] ?? "");
        $correoEmpresa = trim($_POST["correo_empresa"] ?? "");
        $telefonoEmpresa = trim($_POST["telefono_empresa"] ?? "");
        $direccionEmpresa = trim($_POST["direccion_empresa"] ?? "");
        $ciudadEmpresa = trim($_POST["ciudad_empresa"] ?? "");
        $departamentoEmpresa = trim($_POST["departamento_empresa"] ?? "");
        $sectorEconomico = trim($_POST["sector_economico"] ?? "");
        $representanteLegal = trim($_POST["representante_legal"] ?? "");

        if ($nit === "" || $razonSocial === "") {
            $_SESSION["registro_error"] = "El NIT y la razón social son obligatorios.";
            header("Location: index.php?page=registro&paso=2");
            exit;
        }

        if ($this->empresaModel->existeNit($nit)) {
            $_SESSION["registro_error"] = "Ya existe una empresa registrada con ese NIT.";
            header("Location: index.php?page=registro&paso=2");
            exit;
        }

        $_SESSION["registro"]["empresa"] = [
            "nit" => $nit,
            "razon_social" => $razonSocial,
            "nombre_comercial" => $nombreComercial !== "" ? $nombreComercial : $razonSocial,
            "correo_empresa" => $correoEmpresa,
            "telefono_empresa" => $telefonoEmpresa,
            "direccion_empresa" => $direccionEmpresa,
            "ciudad_empresa" => $ciudadEmpresa,
            "departamento_empresa" => $departamentoEmpresa,
            "sector_economico" => $sectorEconomico,
            "representante_legal" => $representanteLegal
        ];

        $_SESSION["registro"]["paso"] = max($_SESSION["registro"]["paso"], 3);

        header("Location: index.php?page=registro&paso=3");
        exit;
    }


    // ==========================================
    // PASO 3: GUARDAR DATOS DEL USUARIO ADMINISTRADOR
    // ==========================================

    public function guardarUsuario()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=registro");
            exit;
        }

        $nombre = trim($_POST["nombre"] ?? "");
        $apellido = trim($_POST["apellido"] ?? "");
        $tipoDocumento = trim($_POST["tipo_documento"] ?? "");
        $numeroDocumento = trim($_POST["numero_documento"] ?? "");
        $correo = trim($_POST["correo"] ?? "");
        $telefono = trim($_POST["telefono"] ?? "");
        $direccion = trim($_POST["direccion"] ?? "");
        $usuario = trim($_POST["usuario"] ?? "");
        $password = $_POST["password"] ?? "";
        $passwordConfirmar = $_POST["password_confirmar"] ?? "";

        if ($nombre === "" || $apellido === "" || $numeroDocumento === "" || $correo === "" || $usuario === "" || $password === "") {
            $_SESSION["registro_error"] = "Completa todos los campos obligatorios.";
            header("Location: index.php?page=registro&paso=3");
            exit;
        }

        if ($this->usuarioModel->existeDocumento($numeroDocumento)) {
            $_SESSION["registro_error"] = "Ya existe una cuenta registrada con ese número de documento.";
            header("Location: index.php?page=registro&paso=3");
            exit;
        }

        if ($password !== $passwordConfirmar) {
            $_SESSION["registro_error"] = "Las contraseñas no coinciden.";
            header("Location: index.php?page=registro&paso=3");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION["registro_error"] = "La contraseña debe tener al menos 6 caracteres.";
            header("Location: index.php?page=registro&paso=3");
            exit;
        }

        if ($this->usuarioModel->existeCorreo($correo)) {
            $_SESSION["registro_error"] = "Ya existe una cuenta con ese correo.";
            header("Location: index.php?page=registro&paso=3");
            exit;
        }

        if ($this->usuarioModel->existeUsuario($usuario)) {
            $_SESSION["registro_error"] = "Ese nombre de usuario ya está en uso.";
            header("Location: index.php?page=registro&paso=3");
            exit;
        }

        // La contraseña se guarda en sesión solo temporalmente, mientras
        // el usuario termina el asistente; se usa una vez y se descarta.
        $_SESSION["registro"]["usuario"] = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "tipo_documento" => $tipoDocumento !== "" ? $tipoDocumento : "CC",
            "numero_documento" => $numeroDocumento,
            "correo" => $correo,
            "telefono" => $telefono,
            "direccion" => $direccion,
            "usuario" => $usuario,
            "password" => $password
        ];

        $_SESSION["registro"]["paso"] = max($_SESSION["registro"]["paso"], 4);

        header("Location: index.php?page=registro&paso=4");
        exit;
    }


    // ==========================================
    // PASO 4: CONFIRMAR Y ACTIVAR LA CUENTA
    // (aquí se simula el pago; para cobrar de verdad
    //  se conectaría una pasarela como Wompi, PayU, etc.)
    // ==========================================

    public function confirmar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=registro");
            exit;
        }

        $registro = $_SESSION["registro"];

        if (
            empty($registro["id_plan"]) ||
            empty($registro["empresa"]) ||
            empty($registro["usuario"])
        ) {
            $_SESSION["registro_error"] = "Faltan datos del registro. Empecemos de nuevo.";
            unset($_SESSION["registro"]);
            header("Location: index.php?page=registro");
            exit;
        }

        $u = $registro["usuario"];
        $e = $registro["empresa"];

        // --------------------------------------
        // 1) Crear el usuario (rol 2 = administrador,
        //    porque va a administrar su propia empresa)
        // --------------------------------------

        $this->usuarioModel->crear(
            2,
            $u["nombre"],
            $u["apellido"],
            $u["tipo_documento"],
            $u["numero_documento"],
            $u["correo"],
            $u["telefono"],
            $u["direccion"],
            "Cuenta creada desde el registro en línea.",
            $u["usuario"],
            $u["password"],
            "Activo"
        );

        $usuarioCreado = $this->usuarioModel->buscarPorCorreo($u["correo"]);

        if (!$usuarioCreado) {
            $_SESSION["registro_error"] = "No se pudo crear el usuario. Intenta de nuevo.";
            header("Location: index.php?page=registro&paso=3");
            exit;
        }

        $idUsuario = $usuarioCreado["id_usuario"];

        // --------------------------------------
        // 2) Crear la empresa, ligada a ese usuario
        // --------------------------------------

        $this->empresaModel->crear(
            $idUsuario,
            $e["nit"],
            $e["razon_social"],
            $e["nombre_comercial"],
            $e["correo_empresa"],
            $e["telefono_empresa"],
            $e["direccion_empresa"],
            $e["ciudad_empresa"],
            $e["departamento_empresa"],
            $e["sector_economico"],
            $e["representante_legal"],
            "Activo"
        );

        $empresaCreada = $this->empresaModel->obtenerPorUsuario($idUsuario);
        $idEmpresa = $empresaCreada["id_empresa"];

        // --------------------------------------
        // 3) Crear la suscripción por el tiempo elegido
        // --------------------------------------

        $fechaInicio = date("Y-m-d");
        $fechaFin = $registro["ciclo"] === "Anual"
            ? date("Y-m-d", strtotime("+1 year"))
            : date("Y-m-d", strtotime("+1 month"));

        $this->suscripcionModel->crear(
    $idUsuario,
    $idEmpresa,
    $registro["id_plan"],
    $registro["ciclo"],
    $registro["precio"],
    $fechaInicio,
    $fechaFin
);

        // --------------------------------------
        // 4) Iniciar sesión automáticamente y limpiar el asistente
        // --------------------------------------

        unset($_SESSION["registro"]);

        $_SESSION["id_usuario"] = $idUsuario;
        $_SESSION["nombre"] = $u["nombre"];
        $_SESSION["apellido"] = $u["apellido"];
        $_SESSION["rol"] = 2;
        $_SESSION["nombre_rol"] = "administrador";
        $_SESSION["id_empresa"] = $idEmpresa;
        $_SESSION["bienvenida"] = true;

        header("Location: index.php?page=dashboard");
        exit;
    }
}
