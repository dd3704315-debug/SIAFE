<?php

require_once "app/models/Usuario.php";
require_once "app/models/Rol.php";

class UsuarioController
{
    // ==========================================
    // LISTAR USUARIOS
    // ==========================================

    public function index()
    {
        $usuario = new Usuario();

        $usuarios = $usuario->obtenerTodos();

        require_once "app/views/usuarios/index.php";
    }


    // ==========================================
    // MOSTRAR FORMULARIO DE CREAR
    // ==========================================

    public function crear()
    {
        $rol = new Rol();

        $roles = $rol->obtenerTodos();

        require_once "app/views/usuarios/crear.php";
    }
    // ==========================================
// MOSTRAR FORMULARIO DE EDITAR
// ==========================================

public function editar()
{
    $id = filter_input(
        INPUT_GET,
        "id",
        FILTER_VALIDATE_INT
    );

    if (!$id) {
        header("Location: index.php?page=usuarios");
        exit;
    }

    $usuario = new Usuario();

    $datos = $usuario->obtenerPorId($id);

    if (!$datos) {
        die("El usuario no existe.");
    }

    $rol = new Rol();

    $roles = $rol->obtenerTodos();

    require_once "app/views/usuarios/editar.php";
}

    // ==========================================
    // ACTUALIZAR USUARIO
    // ==========================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header("Location: index.php?page=usuarios");
            exit;
        }


        // ------------------------------------------
        // RECIBIR DATOS
        // ------------------------------------------

        $idUsuario = filter_input(
            INPUT_POST,
            "id_usuario",
            FILTER_VALIDATE_INT
        );

        $idRol = filter_input(
            INPUT_POST,
            "id_rol",
            FILTER_VALIDATE_INT
        );

        $nombre = trim(
            $_POST["nombre_usuario"] ?? ""
        );

        $apellido = trim(
            $_POST["apellido_usuario"] ?? ""
        );

        $tipoDocumento = trim(
            $_POST["tipo_documento_usuario"] ?? ""
        );

        $numeroDocumento = trim(
            $_POST["numero_documento_usuario"] ?? ""
        );

        $correo = trim(
            $_POST["correo_usuario"] ?? ""
        );

        $telefono = trim(
            $_POST["telefono_usuario"] ?? ""
        );

        $direccion = trim(
            $_POST["direccion_usuario"] ?? ""
        );

        $observaciones = trim(
            $_POST["observaciones"] ?? ""
        );

        $usuarioNombre = trim(
            $_POST["usuario"] ?? ""
        );

        $estado = $_POST["estado_usuario"] ?? "";


        // ------------------------------------------
        // VALIDACIONES
        // ------------------------------------------

        if (!$idUsuario) {
            die("ID de usuario inválido.");
        }

        if (!$idRol) {
            die("Debe seleccionar un rol.");
        }

        if ($nombre === "") {
            die("El nombre es obligatorio.");
        }

        if ($apellido === "") {
            die("El apellido es obligatorio.");
        }

        if ($tipoDocumento === "") {
            die("El tipo de documento es obligatorio.");
        }

        if ($numeroDocumento === "") {
            die("El número de documento es obligatorio.");
        }

        if ($correo === "") {
            die("El correo es obligatorio.");
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            die("El correo electrónico no es válido.");
        }

        if ($usuarioNombre === "") {
            die("El nombre de usuario es obligatorio.");
        }

        if (!in_array($estado, ["Activo", "Inactivo"])) {
            die("El estado seleccionado no es válido.");
        }


        // ------------------------------------------
        // MODELO
        // ------------------------------------------

        $usuario = new Usuario();


        // ------------------------------------------
        // ACTUALIZAR
        // ------------------------------------------

        $resultado = $usuario->actualizar(
            $idUsuario,
            $idRol,
            $nombre,
            $apellido,
            $tipoDocumento,
            $numeroDocumento,
            $correo,
            $telefono,
            $direccion,
            $observaciones,
            $usuarioNombre,
            $estado
        );


        // ------------------------------------------
        // RESULTADO
        // ------------------------------------------

        if ($resultado) {

            header(
                "Location: index.php?page=usuarios"
            );

            exit;
        }

        die("No fue posible actualizar el usuario.");
    }


    // ==========================================
    // GUARDAR USUARIO
    // ==========================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header("Location: index.php?page=usuarios");
            exit;
        }


        // ------------------------------------------
        // RECIBIR DATOS
        // ------------------------------------------

        $idRol = filter_input(
            INPUT_POST,
            "id_rol",
            FILTER_VALIDATE_INT
        );

        $nombre = trim(
            $_POST["nombre_usuario"] ?? ""
        );

        $apellido = trim(
            $_POST["apellido_usuario"] ?? ""
        );

        $tipoDocumento = trim(
            $_POST["tipo_documento_usuario"] ?? ""
        );

        $numeroDocumento = trim(
            $_POST["numero_documento_usuario"] ?? ""
        );

        $correo = trim(
            $_POST["correo_usuario"] ?? ""
        );

        $telefono = trim(
            $_POST["telefono_usuario"] ?? ""
        );

        $direccion = trim(
            $_POST["direccion_usuario"] ?? ""
        );

        $observaciones = trim(
            $_POST["observaciones"] ?? ""
        );

        $usuarioNombre = trim(
            $_POST["usuario"] ?? ""
        );

        $password = $_POST["password"] ?? "";

        $estado = $_POST["estado_usuario"] ?? "";


        // ------------------------------------------
        // VALIDACIONES
        // ------------------------------------------

        if (!$idRol) {
            die("Debe seleccionar un rol.");
        }

        if ($nombre === "") {
            die("El nombre es obligatorio.");
        }

        if ($apellido === "") {
            die("El apellido es obligatorio.");
        }

        if ($tipoDocumento === "") {
            die("Debe seleccionar el tipo de documento.");
        }

        if ($numeroDocumento === "") {
            die("El número de documento es obligatorio.");
        }

        if ($correo === "") {
            die("El correo es obligatorio.");
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            die("El correo electrónico no es válido.");
        }

        if ($usuarioNombre === "") {
            die("El nombre de usuario es obligatorio.");
        }

        if ($password === "") {
            die("La contraseña es obligatoria.");
        }

        if (strlen($password) < 6) {
            die("La contraseña debe tener mínimo 6 caracteres.");
        }

        if (!in_array($estado, ["Activo", "Inactivo"])) {
            die("El estado seleccionado no es válido.");
        }


        // ------------------------------------------
        // CREAR OBJETO USUARIO
        // ------------------------------------------

        $usuario = new Usuario();


        // ------------------------------------------
        // COMPROBAR DOCUMENTO
        // ------------------------------------------

        if ($usuario->existeDocumento($numeroDocumento)) {

            die(
                "Ya existe un usuario con ese número de documento."
            );
        }


        // ------------------------------------------
        // COMPROBAR CORREO
        // ------------------------------------------

        if ($usuario->existeCorreo($correo)) {

            die(
                "Ya existe un usuario con ese correo."
            );
        }


        // ------------------------------------------
        // COMPROBAR NOMBRE DE USUARIO
        // ------------------------------------------

        if ($usuario->existeUsuario($usuarioNombre)) {

            die(
                "Ese nombre de usuario ya está registrado."
            );
        }


        // ------------------------------------------
        // ENCRIPTAR CONTRASEÑA
        // ------------------------------------------

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        // ------------------------------------------
        // CREAR USUARIO EN BASE DE DATOS
        // ------------------------------------------

        $resultado = $usuario->crear(
            $idRol,
            $nombre,
            $apellido,
            $tipoDocumento,
            $numeroDocumento,
            $correo,
            $telefono,
            $direccion,
            $observaciones,
            $usuarioNombre,
            $passwordHash,
            $estado
        );


        // ------------------------------------------
        // RESULTADO
        // ------------------------------------------

        if ($resultado) {

            header(
                "Location: index.php?page=usuarios"
            );

            exit;
        }


        die(
            "No fue posible guardar el usuario."
        );
    }
        // ==========================================
    // ELIMINAR USUARIO
    // ==========================================

   public function eliminar()
{
    $id = filter_input(
        INPUT_GET,
        "id",
        FILTER_VALIDATE_INT
    );

    if (!$id) {
        header("Location: index.php?page=usuarios");
        exit;
    }

    // ==========================================
    // IMPEDIR AUTOELIMINACIÓN
    // ==========================================

    if (
        isset($_SESSION["id_usuario"]) &&
        (int)$_SESSION["id_usuario"] === (int)$id
    ) {
        $_SESSION["error_usuario"] =
            "No puedes eliminar tu propio usuario.";

        header("Location: index.php?page=usuarios");
        exit;
    }

    $usuario = new Usuario();

    $resultado = $usuario->eliminar($id);

    if ($resultado) {

        $_SESSION["mensaje_usuario"] =
            "Usuario eliminado correctamente.";

        header("Location: index.php?page=usuarios");
        exit;
    }

    $_SESSION["error_usuario"] =
        "No tienes permiso para eliminar este usuario.";

    header("Location: index.php?page=usuarios");
    exit;
}
}