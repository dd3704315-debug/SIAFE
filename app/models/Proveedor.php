<?php

require_once __DIR__ . "/../config/database.php";

class Proveedor
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    // ==========================================
    // LISTAR PROVEEDORES
    // ==========================================
    public function obtenerTodos()
    {
        $sql = "SELECT *
                FROM proveedores
                ORDER BY id_proveedor DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // ==========================================
    // OBTENER PROVEEDOR POR ID
    // ==========================================
    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM proveedores
                WHERE id_proveedor = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(
            ":id",
            $id,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetch();
    }

    // ==========================================
    // CREAR PROVEEDOR
    // ==========================================
    public function crear($datos)
    {
        $sql = "INSERT INTO proveedores (
                    nombre_proveedor,
                    nit_proveedor,
                    telefono_proveedor,
                    correo_proveedor,
                    direccion_proveedor,
                    ciudad_proveedor,
                    categoria_proveedor,
                    estado_proveedor
                ) VALUES (
                    :nombre_proveedor,
                    :nit_proveedor,
                    :telefono_proveedor,
                    :correo_proveedor,
                    :direccion_proveedor,
                    :ciudad_proveedor,
                    :categoria_proveedor,
                    :estado_proveedor
                )";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(
            ":nombre_proveedor",
            $datos["nombre_proveedor"]
        );

        $stmt->bindParam(
            ":nit_proveedor",
            $datos["nit_proveedor"]
        );

        $stmt->bindParam(
            ":telefono_proveedor",
            $datos["telefono_proveedor"]
        );

        $stmt->bindParam(
            ":correo_proveedor",
            $datos["correo_proveedor"]
        );

        $stmt->bindParam(
            ":direccion_proveedor",
            $datos["direccion_proveedor"]
        );

        $stmt->bindParam(
            ":ciudad_proveedor",
            $datos["ciudad_proveedor"]
        );

        $stmt->bindParam(
            ":categoria_proveedor",
            $datos["categoria_proveedor"]
        );

        $stmt->bindParam(
            ":estado_proveedor",
            $datos["estado_proveedor"]
        );

        return $stmt->execute();
    }

    // ==========================================
    // ACTUALIZAR PROVEEDOR
    // ==========================================
    public function actualizar($datos)
    {
        $sql = "UPDATE proveedores SET
                    nombre_proveedor = :nombre_proveedor,
                    nit_proveedor = :nit_proveedor,
                    telefono_proveedor = :telefono_proveedor,
                    correo_proveedor = :correo_proveedor,
                    direccion_proveedor = :direccion_proveedor,
                    ciudad_proveedor = :ciudad_proveedor,
                    categoria_proveedor = :categoria_proveedor,
                    estado_proveedor = :estado_proveedor
                WHERE id_proveedor = :id_proveedor";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(
            ":id_proveedor",
            $datos["id_proveedor"],
            PDO::PARAM_INT
        );

        $stmt->bindParam(
            ":nombre_proveedor",
            $datos["nombre_proveedor"]
        );

        $stmt->bindParam(
            ":nit_proveedor",
            $datos["nit_proveedor"]
        );

        $stmt->bindParam(
            ":telefono_proveedor",
            $datos["telefono_proveedor"]
        );

        $stmt->bindParam(
            ":correo_proveedor",
            $datos["correo_proveedor"]
        );

        $stmt->bindParam(
            ":direccion_proveedor",
            $datos["direccion_proveedor"]
        );

        $stmt->bindParam(
            ":ciudad_proveedor",
            $datos["ciudad_proveedor"]
        );

        $stmt->bindParam(
            ":categoria_proveedor",
            $datos["categoria_proveedor"]
        );

        $stmt->bindParam(
            ":estado_proveedor",
            $datos["estado_proveedor"]
        );

        return $stmt->execute();
    }

    // ==========================================
    // ELIMINAR PROVEEDOR
    // ==========================================
    public function eliminar($id)
    {
        $sql = "DELETE FROM proveedores
                WHERE id_proveedor = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(
            ":id",
            $id,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }
}