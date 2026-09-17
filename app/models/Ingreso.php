<?php

require_once "app/config/database.php";

class Ingreso
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }


    // ==========================================
    // LISTAR INGRESOS
    // ==========================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    i.id_ingreso,
                    i.id_empresa,
                    i.id_categoria_ingreso,
                    i.valor_ingreso,
                    i.descripcion_ingreso,
                    i.comprobante_ingreso,
                    i.metodo_pago_ingreso,
                    i.observacion_ingreso,
                    i.fecha_ingreso,
                    i.estado_ingreso,
                    e.razon_social_empresa,
                    c.nombre_categoria_ingreso

                FROM ingresos i

                INNER JOIN empresas e
                    ON i.id_empresa = e.id_empresa

                INNER JOIN categorias_ingresos c
                    ON i.id_categoria_ingreso = c.id_categoria_ingreso

                ORDER BY i.id_ingreso DESC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER INGRESO POR ID
    // ==========================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM ingresos
                WHERE id_ingreso = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

// ==========================================
// OBTENER EMPRESAS
// ==========================================

public function obtenerEmpresas()
{
    $sql = "SELECT
                id_empresa,
                razon_social_empresa
            FROM empresas
            WHERE estado_empresa = 'Activo'
            ORDER BY razon_social_empresa ASC";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // ==========================================
    // OBTENER CATEGORÍAS DE INGRESOS
    // ==========================================

    public function obtenerCategorias()
    {
        $sql = "SELECT
                    id_categoria_ingreso,
                    nombre_categoria_ingreso
                FROM categorias_ingresos
                WHERE estado_categoria_ingreso = 'Activo'
                ORDER BY nombre_categoria_ingreso ASC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ==========================================
    // CREAR INGRESO
    // ==========================================

    public function crear(
        $idEmpresa,
        $idCategoriaIngreso,
        $valorIngreso,
        $descripcionIngreso,
        $comprobanteIngreso,
        $metodoPagoIngreso,
        $observacionIngreso,
        $fechaIngreso,
        $estadoIngreso
    ) {

        $sql = "INSERT INTO ingresos
                (
                    id_empresa,
                    id_categoria_ingreso,
                    valor_ingreso,
                    descripcion_ingreso,
                    comprobante_ingreso,
                    metodo_pago_ingreso,
                    observacion_ingreso,
                    fecha_ingreso,
                    estado_ingreso
                )
                VALUES
                (
                    :id_empresa,
                    :id_categoria_ingreso,
                    :valor_ingreso,
                    :descripcion_ingreso,
                    :comprobante_ingreso,
                    :metodo_pago_ingreso,
                    :observacion_ingreso,
                    :fecha_ingreso,
                    :estado_ingreso
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":id_categoria_ingreso" => $idCategoriaIngreso,
            ":valor_ingreso" => $valorIngreso,
            ":descripcion_ingreso" => $descripcionIngreso,
            ":comprobante_ingreso" => $comprobanteIngreso,
            ":metodo_pago_ingreso" => $metodoPagoIngreso,
            ":observacion_ingreso" => $observacionIngreso,
            ":fecha_ingreso" => $fechaIngreso,
            ":estado_ingreso" => $estadoIngreso
        ]);
    }


    // ==========================================
    // ACTUALIZAR INGRESO
    // ==========================================

    public function actualizar(
        $idIngreso,
        $idEmpresa,
        $idCategoriaIngreso,
        $valorIngreso,
        $descripcionIngreso,
        $comprobanteIngreso,
        $metodoPagoIngreso,
        $observacionIngreso,
        $fechaIngreso,
        $estadoIngreso
    ) {

        $sql = "UPDATE ingresos
                SET
                    id_empresa = :id_empresa,
                    id_categoria_ingreso = :id_categoria_ingreso,
                    valor_ingreso = :valor_ingreso,
                    descripcion_ingreso = :descripcion_ingreso,
                    comprobante_ingreso = :comprobante_ingreso,
                    metodo_pago_ingreso = :metodo_pago_ingreso,
                    observacion_ingreso = :observacion_ingreso,
                    fecha_ingreso = :fecha_ingreso,
                    estado_ingreso = :estado_ingreso,
                    fecha_actualizacion_ingreso = NOW()

                WHERE id_ingreso = :id_ingreso";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_ingreso" => $idIngreso,
            ":id_empresa" => $idEmpresa,
            ":id_categoria_ingreso" => $idCategoriaIngreso,
            ":valor_ingreso" => $valorIngreso,
            ":descripcion_ingreso" => $descripcionIngreso,
            ":comprobante_ingreso" => $comprobanteIngreso,
            ":metodo_pago_ingreso" => $metodoPagoIngreso,
            ":observacion_ingreso" => $observacionIngreso,
            ":fecha_ingreso" => $fechaIngreso,
            ":estado_ingreso" => $estadoIngreso
        ]);
    }


    // ==========================================
    // ELIMINAR INGRESO
    // ==========================================

    public function eliminar($idIngreso)
    {
        $sql = "DELETE FROM ingresos
                WHERE id_ingreso = :id_ingreso";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_ingreso" => $idIngreso
        ]);
    }
}