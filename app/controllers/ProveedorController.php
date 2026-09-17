<?php

require_once "app/models/Proveedor.php";

class ProveedorController
{
    private $proveedor;

    public function __construct()
    {
        $this->proveedor = new Proveedor();
    }

    /**
     * Mostrar proveedores
     */
    public function index()
    {
        $proveedores = $this->proveedor->obtenerTodos();

        require "app/views/proveedores/index.php";
    }

    /**
     * Mostrar formulario crear
     */
    public function crear()
    {
        require "app/views/proveedores/crear.php";
    }

    /**
     * Guardar proveedor
     */
    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=proveedores");
            exit;
        }

        $datos = [
            "nombre_proveedor"    => trim($_POST["nombre_proveedor"] ?? ""),
            "nit_proveedor"       => trim($_POST["nit_proveedor"] ?? ""),
            "telefono_proveedor"  => trim($_POST["telefono_proveedor"] ?? ""),
            "correo_proveedor"    => trim($_POST["correo_proveedor"] ?? ""),
            "direccion_proveedor" => trim($_POST["direccion_proveedor"] ?? ""),
            "ciudad_proveedor"    => trim($_POST["ciudad_proveedor"] ?? ""),
            "categoria_proveedor" => trim($_POST["categoria_proveedor"] ?? ""),
            "estado_proveedor"    => $_POST["estado_proveedor"] ?? "Activo"
        ];

        if ($datos["nombre_proveedor"] === "") {
            $_SESSION["mensaje_proveedor"] = "El nombre del proveedor es obligatorio.";
            $_SESSION["tipo_mensaje_proveedor"] = "danger";

            header("Location: index.php?page=crearProveedor");
            exit;
        }

        try {

            $this->proveedor->crear($datos);

            $_SESSION["mensaje_proveedor"] = "Proveedor registrado correctamente.";
            $_SESSION["tipo_mensaje_proveedor"] = "success";

            header("Location: index.php?page=proveedores");
            exit;

        } catch (PDOException $e) {

            $_SESSION["mensaje_proveedor"] = "No fue posible registrar el proveedor.";
            $_SESSION["tipo_mensaje_proveedor"] = "danger";

            header("Location: index.php?page=crearProveedor");
            exit;
        }
    }

    /**
     * Mostrar formulario editar
     */
    public function editar()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            header("Location: index.php?page=proveedores");
            exit;
        }

        $proveedor = $this->proveedor->obtenerPorId($id);

        if (!$proveedor) {
            $_SESSION["mensaje_proveedor"] = "Proveedor no encontrado.";
            $_SESSION["tipo_mensaje_proveedor"] = "danger";

            header("Location: index.php?page=proveedores");
            exit;
        }

        require "app/views/proveedores/editar.php";
    }

    /**
     * Actualizar proveedor
     */
    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=proveedores");
            exit;
        }

        $datos = [
            "id_proveedor"        => $_POST["id_proveedor"] ?? null,
            "nombre_proveedor"    => trim($_POST["nombre_proveedor"] ?? ""),
            "nit_proveedor"       => trim($_POST["nit_proveedor"] ?? ""),
            "telefono_proveedor"  => trim($_POST["telefono_proveedor"] ?? ""),
            "correo_proveedor"    => trim($_POST["correo_proveedor"] ?? ""),
            "direccion_proveedor" => trim($_POST["direccion_proveedor"] ?? ""),
            "ciudad_proveedor"    => trim($_POST["ciudad_proveedor"] ?? ""),
            "categoria_proveedor" => trim($_POST["categoria_proveedor"] ?? ""),
            "estado_proveedor"    => $_POST["estado_proveedor"] ?? "Activo"
        ];

        if (!$datos["id_proveedor"] || $datos["nombre_proveedor"] === "") {

            $_SESSION["mensaje_proveedor"] = "Los datos obligatorios no fueron completados.";
            $_SESSION["tipo_mensaje_proveedor"] = "danger";

            header("Location: index.php?page=proveedores");
            exit;
        }

        try {

            $this->proveedor->actualizar($datos);

            $_SESSION["mensaje_proveedor"] = "Proveedor actualizado correctamente.";
            $_SESSION["tipo_mensaje_proveedor"] = "success";

            header("Location: index.php?page=proveedores");
            exit;

        } catch (PDOException $e) {

            $_SESSION["mensaje_proveedor"] = "No fue posible actualizar el proveedor.";
            $_SESSION["tipo_mensaje_proveedor"] = "danger";

            header("Location: index.php?page=editarProveedor&id=" . $datos["id_proveedor"]);
            exit;
        }
    }

    /**
     * Eliminar proveedor
     */
    public function eliminar()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            header("Location: index.php?page=proveedores");
            exit;
        }

        try {

            $this->proveedor->eliminar($id);

            $_SESSION["mensaje_proveedor"] = "Proveedor eliminado correctamente.";
            $_SESSION["tipo_mensaje_proveedor"] = "success";

        } catch (PDOException $e) {

            $_SESSION["mensaje_proveedor"] =
                "No se puede eliminar este proveedor porque tiene compras relacionadas.";

            $_SESSION["tipo_mensaje_proveedor"] = "danger";
        }

        header("Location: index.php?page=proveedores");
        exit;
    }
}