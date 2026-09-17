<?php

require_once "app/models/Usuario.php";
require_once "app/models/Empresa.php";

class LoginController
{
    // ==========================================
    // MOSTRAR LOGIN
    // ==========================================
    public function index()
    {
        require_once "app/views/auth/login.php";
    }

    // ==========================================
    // AUTENTICAR
    // ==========================================
    public function autenticar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=login");
            exit;
        }

        $correo = trim($_POST["correo"] ?? "");
        $password = $_POST["password"] ?? "";

        if ($correo === "" || $password === "") {
            $error = "Debe ingresar correo y contraseña.";
            require_once "app/views/auth/login.php";
            return;
        }

        $usuario = new Usuario();

        $datos = $usuario->iniciarSesion(
            $correo,
            $password
        );

        if ($datos) {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION["id_usuario"] = $datos["id_usuario"];
            $_SESSION["nombre"] = $datos["nombre_usuario"];
            $_SESSION["apellido"] = $datos["apellido_usuario"];
            $_SESSION["rol"] = $datos["id_rol"];
            $_SESSION["nombre_rol"] = $datos["nombre_rol"];

            $empresaModel = new Empresa();
            $empresa = $empresaModel->obtenerPorUsuario($datos["id_usuario"]);

            if ($empresa) {
                $_SESSION["id_empresa"] = $empresa["id_empresa"];
            }

            header("Location: index.php?page=dashboard");
            exit;
        }

        $error = "Correo o contraseña incorrectos.";

        require_once "app/views/auth/login.php";
    }

    // ==========================================
    // MOSTRAR RECUPERACIÓN DE CONTRASEÑA
    // ==========================================
    public function recuperarPassword()
    {
        require_once "app/views/auth/recuperar_password.php";
    }

    // ==========================================
    // PROCESAR RECUPERACIÓN
    // ==========================================
    public function procesarRecuperacion()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=recuperarPassword");
            exit;
        }

        $correo = trim($_POST["correo"] ?? "");

        if ($correo === "") {

            $error = "Debe ingresar su correo electrónico.";

            require_once "app/views/auth/recuperar_password.php";

            return;
        }

        $usuario = new Usuario();

        $datos = $usuario->buscarPorCorreo($correo);

        if (!$datos) {

            $error = "No encontramos un usuario registrado con ese correo.";

            require_once "app/views/auth/recuperar_password.php";

            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["recuperacion_id_usuario"] = $datos["id_usuario"];

        header("Location: index.php?page=nuevaPassword");
        exit;
    }

    // ==========================================
// MOSTRAR NUEVA CONTRASEÑA
// ==========================================
public function nuevaPassword()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["recuperacion_id_usuario"])) {
        header("Location: index.php?page=recuperarPassword");
        exit;
    }

    require_once "app/views/auth/nueva_password.php";
}

// ==========================================
// GUARDAR NUEVA CONTRASEÑA
// ==========================================
public function guardarNuevaPassword()
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: index.php?page=recuperarPassword");
        exit;
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["recuperacion_id_usuario"])) {
        header("Location: index.php?page=recuperarPassword");
        exit;
    }

    $idUsuario = $_SESSION["recuperacion_id_usuario"];

    $password = $_POST["password"] ?? "";
    $confirmarPassword = $_POST["confirmar_password"] ?? "";

    if ($password === "" || $confirmarPassword === "") {

        $error = "Debe ingresar y confirmar la nueva contraseña.";

        require_once "app/views/auth/nueva_password.php";

        return;
    }

    if (strlen($password) < 6) {

        $error = "La contraseña debe tener mínimo 6 caracteres.";

        require_once "app/views/auth/nueva_password.php";

        return;
    }

    if ($password !== $confirmarPassword) {

        $error = "Las contraseñas no coinciden.";

        require_once "app/views/auth/nueva_password.php";

        return;
    }

    $usuario = new Usuario();

    $actualizado = $usuario->actualizarPassword(
        $idUsuario,
        $password
    );

    if (!$actualizado) {

        $error = "No fue posible actualizar la contraseña.";

        require_once "app/views/auth/nueva_password.php";

        return;
    }

    unset($_SESSION["recuperacion_id_usuario"]);

    $_SESSION["mensaje_login"] = "Contraseña actualizada correctamente. Ya puedes iniciar sesión.";

    header("Location: index.php?page=login");
    exit;
}

    // ==========================================
    // CERRAR SESIÓN
    // ==========================================
    public function cerrarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        header("Location: index.php?page=login");
        exit;
    }
}