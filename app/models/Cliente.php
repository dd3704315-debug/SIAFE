<?php

require_once "app/config/database.php";

class Cliente
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // ==========================================
    // LISTAR CLIENTES
    // ==========================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    c.id_cliente,
                    c.id_empresa,
                    c.tipo_documento_cliente,
                    c.documento_cliente,
                    c.nombres_cliente,
                    c.apellidos_cliente,
                    c.correo_cliente,
                    c.telefono_cliente,
                    c.direccion_cliente,
                    c.ciudad_cliente,
                    c.estado_cliente,
                    c.fecha_registro_cliente,
                    c.fecha_actualizacion_cliente,
                    c.observacion_cliente,
                    e.razon_social_empresa
                FROM clientes c
                INNER JOIN empresas e
                    ON c.id_empresa = e.id_empresa
                ORDER BY c.id_cliente ASC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER CLIENTE POR ID
    // ==========================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM clientes
                WHERE id_cliente = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // VERIFICAR DOCUMENTO
    // ==========================================

    public function existeDocumento($documento)
    {
        $sql = "SELECT COUNT(*)
                FROM clientes
                WHERE documento_cliente = :documento";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":documento" => $documento
        ]);

        return $stmt->fetchColumn() > 0;
    }


    // ==========================================
    // CREAR CLIENTE
    // ==========================================

    public function crear(
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
    ) {

        $sql = "INSERT INTO clientes
                (
                    id_empresa,
                    tipo_documento_cliente,
                    documento_cliente,
                    nombres_cliente,
                    apellidos_cliente,
                    correo_cliente,
                    telefono_cliente,
                    direccion_cliente,
                    ciudad_cliente,
                    estado_cliente,
                    observacion_cliente
                )
                VALUES
                (
                    :id_empresa,
                    :tipo_documento,
                    :documento,
                    :nombres,
                    :apellidos,
                    :correo,
                    :telefono,
                    :direccion,
                    :ciudad,
                    :estado,
                    :observacion
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":tipo_documento" => $tipoDocumento,
            ":documento" => $documento,
            ":nombres" => $nombres,
            ":apellidos" => $apellidos,
            ":correo" => $correo,
            ":telefono" => $telefono,
            ":direccion" => $direccion,
            ":ciudad" => $ciudad,
            ":estado" => $estado,
            ":observacion" => $observacion
        ]);
    }


    // ==========================================
    // ACTUALIZAR CLIENTE
    // ==========================================

    public function actualizar(
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
    ) {

        $sql = "UPDATE clientes
                SET
                    id_empresa = :id_empresa,
                    tipo_documento_cliente = :tipo_documento,
                    documento_cliente = :documento,
                    nombres_cliente = :nombres,
                    apellidos_cliente = :apellidos,
                    correo_cliente = :correo,
                    telefono_cliente = :telefono,
                    direccion_cliente = :direccion,
                    ciudad_cliente = :ciudad,
                    estado_cliente = :estado,
                    observacion_cliente = :observacion,
                    fecha_actualizacion_cliente = NOW()
                WHERE id_cliente = :id_cliente";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_cliente" => $idCliente,
            ":id_empresa" => $idEmpresa,
            ":tipo_documento" => $tipoDocumento,
            ":documento" => $documento,
            ":nombres" => $nombres,
            ":apellidos" => $apellidos,
            ":correo" => $correo,
            ":telefono" => $telefono,
            ":direccion" => $direccion,
            ":ciudad" => $ciudad,
            ":estado" => $estado,
            ":observacion" => $observacion
        ]);
    }


    // ==========================================
    // ELIMINAR CLIENTE
    // ==========================================

    public function eliminar($idCliente)
    {
        $sql = "DELETE FROM clientes
                WHERE id_cliente = :id_cliente";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_cliente" => $idCliente
        ]);
    }
}