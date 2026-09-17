<?php

require_once "app/config/database.php";

class Venta
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // ==========================================================
    // LISTAR VENTAS
    // ==========================================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    v.id_venta,
                    v.id_empresa,
                    v.id_cliente,
                    v.id_usuario,
                    v.numero_factura_venta,
                    v.subtotal_venta,
                    v.impuesto_venta,
                    v.descuento_venta,
                    v.fecha_venta,
                    v.total_venta,
                    v.metodo_pago_venta,
                    v.observacion_venta,
                    v.estado_venta,
                    CONCAT(
                        COALESCE(c.nombres_cliente, ''),
                        ' ',
                        COALESCE(c.apellidos_cliente, '')
                    ) AS nombre_cliente
                FROM ventas v
                INNER JOIN clientes c
                    ON v.id_cliente = c.id_cliente
                ORDER BY v.id_venta DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================================
    // OBTENER UNA VENTA POR ID
    // ==========================================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT
                    v.*,
                    CONCAT(
                        COALESCE(c.nombres_cliente, ''),
                        ' ',
                        COALESCE(c.apellidos_cliente, '')
                    ) AS nombre_cliente,
                    c.documento_cliente,
                    c.telefono_cliente,
                    c.correo_cliente
                FROM ventas v
                INNER JOIN clientes c
                    ON v.id_cliente = c.id_cliente
                WHERE v.id_venta = ?";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================================
    // OBTENER DETALLES DE UNA VENTA
    // ==========================================================

    public function obtenerDetalles($idVenta)
    {
        $sql = "SELECT
                    d.id_detalle_venta,
                    d.id_venta,
                    d.id_producto,
                    p.codigo_producto,
                    p.nombre_producto,
                    d.cantidad_producto_venta,
                    d.precio_unitario_producto_venta,
                    d.descuento_producto_venta,
                    d.impuesto_producto_venta,
                    d.subtotal_producto_venta,
                    d.observacion_producto_venta
                FROM detalle_ventas d
                INNER JOIN productos p
                    ON d.id_producto = p.id_producto
                WHERE d.id_venta = ?
                ORDER BY d.id_detalle_venta ASC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$idVenta]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================================
    // CREAR VENTA COMPLETA
    // ==========================================================

    public function crear(
        $idEmpresa,
        $idCliente,
        $idUsuario,
        $numeroFactura,
        $subtotal,
        $impuesto,
        $descuento,
        $total,
        $metodoPago,
        $observacion,
        $detalles,
        $estado = "Pendiente"
    ) {
        try {

            // Iniciar transacción
            $this->conexion->beginTransaction();


            // ==================================================
            // INSERTAR CABECERA DE LA VENTA
            // ==================================================

            $sql = "INSERT INTO ventas (
                        id_empresa,
                        id_cliente,
                        id_usuario,
                        numero_factura_venta,
                        subtotal_venta,
                        impuesto_venta,
                        descuento_venta,
                        total_venta,
                        metodo_pago_venta,
                        observacion_venta,
                        estado_venta
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                $idEmpresa,
                $idCliente,
                $idUsuario,
                $numeroFactura,
                $subtotal,
                $impuesto,
                $descuento,
                $total,
                $metodoPago,
                $observacion,
                $estado
            ]);


            // Obtener ID generado
            $idVenta = $this->conexion->lastInsertId();


            // ==================================================
            // INSERTAR PRODUCTOS DE LA VENTA
            // ==================================================

            foreach ($detalles as $detalle) {

                $idProducto = $detalle['id_producto'];
                $cantidad = (int) $detalle['cantidad'];
                $precio = (float) $detalle['precio_unitario'];
                $descuentoDetalle = (float) $detalle['descuento'];
                $impuestoDetalle = (float) $detalle['impuesto'];


                // ----------------------------------------------
                // VERIFICAR STOCK
                // ----------------------------------------------

                $sqlStock = "SELECT
                                stock_producto
                             FROM productos
                             WHERE id_producto = ?
                             FOR UPDATE";

                $stmtStock = $this->conexion->prepare($sqlStock);
                $stmtStock->execute([$idProducto]);

                $producto = $stmtStock->fetch(PDO::FETCH_ASSOC);


                if (!$producto) {

                    throw new Exception(
                        "El producto con ID {$idProducto} no existe."
                    );
                }


                if ((int) $producto['stock_producto'] < $cantidad) {

                    throw new Exception(
                        "Stock insuficiente para el producto con ID {$idProducto}."
                    );
                }


                // ----------------------------------------------
                // CALCULAR SUBTOTAL DEL PRODUCTO
                // ----------------------------------------------

                $subtotalProducto =
                    ($cantidad * $precio)
                    - $descuentoDetalle
                    + $impuestoDetalle;


                // ----------------------------------------------
                // INSERTAR DETALLE
                // ----------------------------------------------

                $sqlDetalle = "INSERT INTO detalle_ventas (
                                    id_venta,
                                    id_producto,
                                    cantidad_producto_venta,
                                    precio_unitario_producto_venta,
                                    descuento_producto_venta,
                                    impuesto_producto_venta,
                                    subtotal_producto_venta,
                                    observacion_producto_venta
                                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $stmtDetalle = $this->conexion->prepare($sqlDetalle);

                $stmtDetalle->execute([
                    $idVenta,
                    $idProducto,
                    $cantidad,
                    $precio,
                    $descuentoDetalle,
                    $impuestoDetalle,
                    $subtotalProducto,
                    $detalle['observacion'] ?? null
                ]);


                // ----------------------------------------------
                // DESCONTAR STOCK
                // ----------------------------------------------

                $sqlActualizarStock = "UPDATE productos
                                       SET stock_producto =
                                           stock_producto - ?
                                       WHERE id_producto = ?";

                $stmtActualizarStock =
                    $this->conexion->prepare($sqlActualizarStock);

                $stmtActualizarStock->execute([
                    $cantidad,
                    $idProducto
                ]);
            }


            // ==================================================
            // CONFIRMAR TRANSACCIÓN
            // ==================================================

            $this->conexion->commit();

            return $idVenta;


        } catch (Exception $e) {

            // Si algo falla, deshacer todo
            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            throw $e;
        }
    }


    // ==========================================================
    // AGREGAR DETALLE DE VENTA
    // ==========================================================

    public function agregarDetalle(
        $idVenta,
        $idProducto,
        $cantidad,
        $precioUnitario,
        $descuento,
        $impuesto,
        $subtotal,
        $observacion = null
    ) {
        $sql = "INSERT INTO detalle_ventas (
                    id_venta,
                    id_producto,
                    cantidad_producto_venta,
                    precio_unitario_producto_venta,
                    descuento_producto_venta,
                    impuesto_producto_venta,
                    subtotal_producto_venta,
                    observacion_producto_venta
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $idVenta,
            $idProducto,
            $cantidad,
            $precioUnitario,
            $descuento,
            $impuesto,
            $subtotal,
            $observacion
        ]);
    }


    // ==========================================================
    // ELIMINAR VENTA COMPLETA
    // ==========================================================

    public function eliminar($id)
    {
        try {

            $this->conexion->beginTransaction();


            // Obtener productos vendidos
            $detalles = $this->obtenerDetalles($id);


            // ==================================================
            // DEVOLVER STOCK
            // ==================================================

            foreach ($detalles as $detalle) {

                $sqlStock = "UPDATE productos
                             SET stock_producto =
                                 stock_producto + ?
                             WHERE id_producto = ?";

                $stmtStock = $this->conexion->prepare($sqlStock);

                $stmtStock->execute([
                    $detalle['cantidad_producto_venta'],
                    $detalle['id_producto']
                ]);
            }


            // ==================================================
            // ELIMINAR DETALLES
            // ==================================================

            $sqlDetalle = "DELETE FROM detalle_ventas
                           WHERE id_venta = ?";

            $stmtDetalle = $this->conexion->prepare($sqlDetalle);

            $stmtDetalle->execute([$id]);


            // ==================================================
            // ELIMINAR VENTA
            // ==================================================

            $sqlVenta = "DELETE FROM ventas
                         WHERE id_venta = ?";

            $stmtVenta = $this->conexion->prepare($sqlVenta);

            $stmtVenta->execute([$id]);


            // Confirmar
            $this->conexion->commit();

            return true;


        } catch (Exception $e) {

            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            throw $e;
        }
    }


    // ==========================================================
    // ELIMINAR DETALLE
    // ==========================================================

    public function eliminarDetalle($idDetalle)
    {
        try {

            $this->conexion->beginTransaction();


            // Obtener información del detalle
            $sql = "SELECT
                        id_producto,
                        cantidad_producto_venta
                    FROM detalle_ventas
                    WHERE id_detalle_venta = ?";

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([$idDetalle]);

            $detalle = $stmt->fetch(PDO::FETCH_ASSOC);


            if (!$detalle) {
                throw new Exception(
                    "El detalle de venta no existe."
                );
            }


            // Devolver stock
            $sqlStock = "UPDATE productos
                         SET stock_producto =
                             stock_producto + ?
                         WHERE id_producto = ?";

            $stmtStock = $this->conexion->prepare($sqlStock);

            $stmtStock->execute([
                $detalle['cantidad_producto_venta'],
                $detalle['id_producto']
            ]);


            // Eliminar detalle
            $sqlEliminar = "DELETE FROM detalle_ventas
                            WHERE id_detalle_venta = ?";

            $stmtEliminar = $this->conexion->prepare($sqlEliminar);

            $stmtEliminar->execute([$idDetalle]);


            $this->conexion->commit();

            return true;


        } catch (Exception $e) {

            if ($this->conexion->inTransaction()) {
                $this->conexion->rollBack();
            }

            throw $e;
        }
    }


    // ==========================================================
    // ACTUALIZAR ESTADO DE VENTA
    // ==========================================================
public function actualizarEstado($id, $estado)
{
    try {

        // Iniciar transacción
        $this->conexion->beginTransaction();

        // ==================================================
        // OBTENER ESTADO ACTUAL DE LA VENTA
        // ==================================================

        $sqlVenta = "SELECT estado_venta
                     FROM ventas
                     WHERE id_venta = ?
                     FOR UPDATE";

        $stmtVenta = $this->conexion->prepare($sqlVenta);
        $stmtVenta->execute([$id]);

        $venta = $stmtVenta->fetch(PDO::FETCH_ASSOC);

        if (!$venta) {
            throw new Exception(
                "La venta no existe."
            );
        }

        // ==================================================
        // SI SE ANULA LA VENTA
        // ==================================================

        if (
            $estado === "Anulada"
            && $venta['estado_venta'] !== "Anulada"
        ) {

            // Obtener productos vendidos
            $sqlDetalles = "SELECT
                                id_producto,
                                cantidad_producto_venta
                            FROM detalle_ventas
                            WHERE id_venta = ?";

            $stmtDetalles =
                $this->conexion->prepare($sqlDetalles);

            $stmtDetalles->execute([$id]);

            $detalles =
                $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);


            // ==================================================
            // DEVOLVER STOCK
            // ==================================================

            foreach ($detalles as $detalle) {

                $sqlStock = "UPDATE productos
                             SET stock_producto =
                                 stock_producto + ?
                             WHERE id_producto = ?";

                $stmtStock =
                    $this->conexion->prepare($sqlStock);

                $stmtStock->execute([
                    $detalle['cantidad_producto_venta'],
                    $detalle['id_producto']
                ]);
            }
        }

        // ==================================================
        // ACTUALIZAR ESTADO
        // ==================================================

        $sql = "UPDATE ventas
                SET estado_venta = ?
                WHERE id_venta = ?";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            $estado,
            $id
        ]);

        // ==================================================
        // CONFIRMAR
        // ==================================================

        $this->conexion->commit();

        return true;

    } catch (Exception $e) {

        if ($this->conexion->inTransaction()) {
            $this->conexion->rollBack();
        }

        throw $e;
    }
}

    // ==========================================================
    // OBTENER CLIENTES
    // ==========================================================

    public function obtenerClientes($idEmpresa = null)
    {
        if ($idEmpresa !== null) {

            $sql = "SELECT
                        id_cliente,
                        nombres_cliente,
                        apellidos_cliente,
                        documento_cliente
                    FROM clientes
                    WHERE id_empresa = ?
                    AND estado_cliente = 'Activo'
                    ORDER BY nombres_cliente ASC";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([$idEmpresa]);

        } else {

            $sql = "SELECT
                        id_cliente,
                        nombres_cliente,
                        apellidos_cliente,
                        documento_cliente
                    FROM clientes
                    WHERE estado_cliente = 'Activo'
                    ORDER BY nombres_cliente ASC";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================================
    // OBTENER PRODUCTOS
    // ==========================================================

    public function obtenerProductos($idEmpresa = null)
    {
        if ($idEmpresa !== null) {

            $sql = "SELECT
                        id_producto,
                        codigo_producto,
                        nombre_producto,
                        stock_producto,
                        precio_venta_producto
                    FROM productos
                    WHERE id_empresa = ?
                    AND estado_producto = 'Activo'
                    ORDER BY nombre_producto ASC";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([$idEmpresa]);

        } else {

            $sql = "SELECT
                        id_producto,
                        codigo_producto,
                        nombre_producto,
                        stock_producto,
                        precio_venta_producto
                    FROM productos
                    WHERE estado_producto = 'Activo'
                    ORDER BY nombre_producto ASC";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ==========================================================
// OBTENER EMPRESA DEL USUARIO
// ==========================================================

public function obtenerEmpresaPorUsuario($idUsuario)
{
    $sql = "SELECT
                id_empresa,
                id_usuario,
                razon_social_empresa,
                nombre_comercial_empresa
            FROM empresas
            WHERE id_usuario = ?
            AND estado_empresa = 'Activo'
            LIMIT 1";

    $stmt = $this->conexion->prepare($sql);

    $stmt->execute([
        $idUsuario
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}