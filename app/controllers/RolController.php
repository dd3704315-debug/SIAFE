<?php

require_once "app/models/Rol.php";
require_once "app/helpers/csrf.php";

class RolController
{
    // LISTAR
    public function index()
    {
        $rol = new Rol();

        $roles = $rol->obtenerTodos();

        require_once "app/views/roles/index.php";
    }


    // CREAR
    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=roles");
            exit;
        }

        $nombre = trim($_POST["nombre_rol"] ?? "");
        $descripcion = trim($_POST["descripcion_rol"] ?? "");
        $estado = $_POST["estado_rol"] ?? "";

        // Validar nombre
        if ($nombre === "") {

            $this->mensaje(
                "error",
                "El nombre del rol es obligatorio."
            );
        }

        // Validar longitud
        if (strlen($nombre) > 50) {

            $this->mensaje(
                "error",
                "El nombre del rol no puede superar los 50 caracteres."
            );
        }

        // Validar estado
        if (!in_array($estado, ["Activo", "Inactivo"])) {

            $this->mensaje(
                "error",
                "El estado seleccionado no es válido."
            );
        }

        $rol = new Rol();

        // Evitar duplicados
        if ($rol->existeNombre($nombre)) {

            $this->mensaje(
                "error",
                "Ya existe un rol con ese nombre."
            );
        }

        // Crear
        if ($rol->crear($nombre, $descripcion, $estado)) {

            $this->mensaje(
                "success",
                "Rol creado correctamente."
            );
        }

        $this->mensaje(
            "error",
            "No fue posible crear el rol."
        );
    }


    // EDITAR
    public function editar()
    {
        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id) {

            $this->mensaje(
                "error",
                "ID de rol inválido."
            );
        }

        $rol = new Rol();

        $datos = $rol->obtenerPorId($id);

        if (!$datos) {

            $this->mensaje(
                "error",
                "El rol no existe."
            );
        }

        require_once "app/views/roles/editar.php";
    }


    // ACTUALIZAR
    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header("Location: index.php?page=roles");
            exit;
        }

        $id = filter_input(
            INPUT_POST,
            "id_rol",
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST["nombre_rol"] ?? "");
        $descripcion = trim($_POST["descripcion_rol"] ?? "");
        $estado = $_POST["estado_rol"] ?? "";

        if (!$id) {

            $this->mensaje(
                "error",
                "ID de rol inválido."
            );
        }

        if ($nombre === "") {

            $this->mensaje(
                "error",
                "El nombre del rol es obligatorio."
            );
        }

        if (strlen($nombre) > 50) {

            $this->mensaje(
                "error",
                "El nombre del rol no puede superar los 50 caracteres."
            );
        }

        if (!in_array($estado, ["Activo", "Inactivo"])) {

            $this->mensaje(
                "error",
                "El estado seleccionado no es válido."
            );
        }

        $rol = new Rol();

        // Evitar duplicados al editar
        if ($rol->existeNombre($nombre, $id)) {

            $this->mensaje(
                "error",
                "Ya existe otro rol con ese nombre."
            );
        }

        if ($rol->actualizar(
            $id,
            $nombre,
            $descripcion,
            $estado
        )) {

            $this->mensaje(
                "success",
                "Rol actualizado correctamente."
            );
        }

        $this->mensaje(
            "error",
            "No fue posible actualizar el rol."
        );
    }


    // ELIMINAR
    public function eliminar()
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {

        $this->mensaje(
            "error",
            "Solicitud no válida."
        );
    }

    $token = $_POST["csrf_token"] ?? "";

    if (!validarTokenCSRF($token)) {

        $this->mensaje(
            "error",
            "Token de seguridad inválido."
        );
    }

    $id = filter_input(
        INPUT_POST,
        "id_rol",
        FILTER_VALIDATE_INT
    );

    if (!$id) {

        $this->mensaje(
            "error",
            "ID de rol inválido."
        );
    }

    $rol = new Rol();

    $datos = $rol->obtenerPorId($id);

    if (!$datos) {

        $this->mensaje(
            "error",
            "El rol no existe."
        );
    }

    if ($rol->tieneUsuarios($id)) {

        $this->mensaje(
            "error",
            "No se puede eliminar este rol porque está asignado a uno o más usuarios."
        );
    }

    if ($rol->eliminar($id)) {

        $this->mensaje(
            "success",
            "Rol eliminado correctamente."
        );
    }

    $this->mensaje(
        "error",
        "No fue posible eliminar el rol."
    );
}


    // MENSAJES
    private function mensaje($tipo, $texto)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["mensaje"] = $texto;
        $_SESSION["tipo_mensaje"] = $tipo;

        header("Location: index.php?page=roles");
        exit;
    }
}