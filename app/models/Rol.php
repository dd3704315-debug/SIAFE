<?php

require_once "app/config/database.php";

class Rol
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // Obtener todos los roles
    public function obtenerTodos()
    {
        $sql = "SELECT *
                FROM roles
                ORDER BY id_rol ASC";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un rol por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM roles
                WHERE id_rol = :id
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar si existe un nombre de rol
    public function existeNombre($nombre, $id = null)
    {
        if ($id === null) {

            $sql = "SELECT COUNT(*)
                    FROM roles
                    WHERE LOWER(nombre_rol) = LOWER(:nombre)";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ":nombre" => $nombre
            ]);

        } else {

            $sql = "SELECT COUNT(*)
                    FROM roles
                    WHERE LOWER(nombre_rol) = LOWER(:nombre)
                    AND id_rol != :id";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ":nombre" => $nombre,
                ":id" => $id
            ]);
        }

        return $stmt->fetchColumn() > 0;
    }

    // Crear rol
    public function crear($nombre, $descripcion, $estado)
    {
        $sql = "INSERT INTO roles
                (
                    nombre_rol,
                    descripcion_rol,
                    estado_rol
                )
                VALUES
                (
                    :nombre,
                    :descripcion,
                    :estado
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":nombre" => $nombre,
            ":descripcion" => $descripcion,
            ":estado" => $estado
        ]);
    }

    // Actualizar rol
    public function actualizar($id, $nombre, $descripcion, $estado)
    {
        $sql = "UPDATE roles
                SET
                    nombre_rol = :nombre,
                    descripcion_rol = :descripcion,
                    estado_rol = :estado
                WHERE id_rol = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":nombre" => $nombre,
            ":descripcion" => $descripcion,
            ":estado" => $estado
        ]);
    }

    // Verificar si un rol está siendo utilizado
    public function tieneUsuarios($id)
    {
        $sql = "SELECT COUNT(*)
                FROM usuarios
                WHERE id_rol = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetchColumn() > 0;
    }

    // Eliminar rol
    public function eliminar($id)
    {
        $sql = "DELETE FROM roles
                WHERE id_rol = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}