<?php

require_once "app/config/database.php";

class Gasto
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }


    // ==========================================
    // LISTAR GASTOS
    // ==========================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    g.id_gasto,
                    g.id_empresa,
                    g.id_categoria_gasto,
                    g.valor_gasto,
                    g.descripcion_gasto,
                    g.comprobante_gasto,
                    g.metodo_pago_gasto,
                    g.observacion_gasto,
                    g.fecha_gasto,
                    g.estado_gasto,
                    e.razon_social_empresa,
                    c.nombre_categoria_gasto
                FROM gastos g

                INNER JOIN empresas e
                    ON g.id_empresa = e.id_empresa

                INNER JOIN categorias_gastos c
                    ON g.id_categoria_gasto = c.id_categoria_gasto

                ORDER BY g.id_gasto ASC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER GASTO POR ID
    // ==========================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM gastos
                WHERE id_gasto = :id";

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
    // OBTENER CATEGORÍAS DE GASTOS
    // ==========================================

    public function obtenerCategorias()
    {
        $sql = "SELECT
                    id_categoria_gasto,
                    nombre_categoria_gasto
                FROM categorias_gastos
                WHERE estado_categoria_gasto = 'Activo'
                ORDER BY nombre_categoria_gasto ASC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // CREAR GASTO
    // ==========================================

    public function crear(
        $idEmpresa,
        $idCategoriaGasto,
        $valorGasto,
        $descripcionGasto,
        $comprobanteGasto,
        $metodoPagoGasto,
        $observacionGasto,
        $fechaGasto,
        $estadoGasto
    ) {

        $sql = "INSERT INTO gastos
                (
                    id_empresa,
                    id_categoria_gasto,
                    valor_gasto,
                    descripcion_gasto,
                    comprobante_gasto,
                    metodo_pago_gasto,
                    observacion_gasto,
                    fecha_gasto,
                    estado_gasto
                )
                VALUES
                (
                    :id_empresa,
                    :id_categoria_gasto,
                    :valor_gasto,
                    :descripcion_gasto,
                    :comprobante_gasto,
                    :metodo_pago_gasto,
                    :observacion_gasto,
                    :fecha_gasto,
                    :estado_gasto
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":id_categoria_gasto" => $idCategoriaGasto,
            ":valor_gasto" => $valorGasto,
            ":descripcion_gasto" => $descripcionGasto,
            ":comprobante_gasto" => $comprobanteGasto,
            ":metodo_pago_gasto" => $metodoPagoGasto,
            ":observacion_gasto" => $observacionGasto,
            ":fecha_gasto" => $fechaGasto,
            ":estado_gasto" => $estadoGasto
        ]);
    }


    // ==========================================
    // ACTUALIZAR GASTO
    // ==========================================

    public function actualizar(
        $idGasto,
        $idEmpresa,
        $idCategoriaGasto,
        $valorGasto,
        $descripcionGasto,
        $comprobanteGasto,
        $metodoPagoGasto,
        $observacionGasto,
        $fechaGasto,
        $estadoGasto
    ) {

        $sql = "UPDATE gastos
                SET
                    id_empresa = :id_empresa,
                    id_categoria_gasto = :id_categoria_gasto,
                    valor_gasto = :valor_gasto,
                    descripcion_gasto = :descripcion_gasto,
                    comprobante_gasto = :comprobante_gasto,
                    metodo_pago_gasto = :metodo_pago_gasto,
                    observacion_gasto = :observacion_gasto,
                    fecha_gasto = :fecha_gasto,
                    estado_gasto = :estado_gasto,
                    fecha_actualizacion_gasto = NOW()

                WHERE id_gasto = :id_gasto";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_gasto" => $idGasto,
            ":id_empresa" => $idEmpresa,
            ":id_categoria_gasto" => $idCategoriaGasto,
            ":valor_gasto" => $valorGasto,
            ":descripcion_gasto" => $descripcionGasto,
            ":comprobante_gasto" => $comprobanteGasto,
            ":metodo_pago_gasto" => $metodoPagoGasto,
            ":observacion_gasto" => $observacionGasto,
            ":fecha_gasto" => $fechaGasto,
            ":estado_gasto" => $estadoGasto
        ]);
    }


    // ==========================================
    // ELIMINAR GASTO
    // ==========================================

    public function eliminar($idGasto)
    {
        $sql = "DELETE FROM gastos
                WHERE id_gasto = :id_gasto";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_gasto" => $idGasto
        ]);
    }
}