<?php

require_once "app/models/Venta.php";

class VentaController
{
    private $venta;

    public function __construct()
    {
        $this->venta = new Venta();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    // ==========================================================
    // LISTAR VENTAS
    // ==========================================================

    public function index()
    {
        $ventas = $this->venta->obtenerTodos();

        require_once "app/views/ventas/index.php";
    }


    // ==========================================================
    // MOSTRAR FORMULARIO NUEVA VENTA
    // ==========================================================

    public function crear()
    {
        $idUsuario = $_SESSION['id_usuario'] ?? null;

        if (!$idUsuario) {
            header("Location: index.php?page=login");
            exit;
        }

        // Obtener empresa del usuario
        $empresa = $this->venta->obtenerEmpresaPorUsuario($idUsuario);

        if (!$empresa) {

            $_SESSION['error_venta'] =
                "El usuario no tiene una empresa activa asociada.";

            header("Location: index.php?page=ventas");
            exit;
        }

        // Guardar empresa en sesión
        $_SESSION['id_empresa'] = $empresa['id_empresa'];

        $idEmpresa = $empresa['id_empresa'];

        // Obtener clientes y productos de la empresa
        $clientes = $this->venta->obtenerClientes($idEmpresa);

        $productos = $this->venta->obtenerProductos($idEmpresa);

        // Enviar empresa a la vista
        $empresas = [$empresa];

        require_once "app/views/ventas/crear.php";
    }


    // ==========================================================
    // GUARDAR NUEVA VENTA
    // ==========================================================

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=ventas");
            exit;
        }

        try {

            // ==================================================
            // DATOS PRINCIPALES
            // ==================================================

            $idEmpresa = $_POST['id_empresa']
                ?? ($_SESSION['id_empresa'] ?? null);

            $idCliente = $_POST['id_cliente'] ?? null;

            $idUsuario = $_POST['id_usuario']
                ?? ($_SESSION['id_usuario'] ?? null);

            $numeroFactura = trim(
                $_POST['numero_factura_venta'] ?? ''
            );

            $metodoPago = $_POST['metodo_pago_venta']
                ?? 'Efectivo';

            $observacion = trim(
                $_POST['observacion_venta'] ?? ''
            );

            $estado = $_POST['estado_venta']
                ?? 'Pendiente';


            // ==================================================
            // VALIDAR DATOS PRINCIPALES
            // ==================================================

            if (!$idEmpresa) {
                throw new Exception(
                    "No se encontró la empresa de la venta."
                );
            }

            if (!$idCliente) {
                throw new Exception(
                    "Debe seleccionar un cliente."
                );
            }

            if (!$idUsuario) {
                throw new Exception(
                    "No se encontró el usuario que registra la venta."
                );
            }

            if ($numeroFactura === '') {
                throw new Exception(
                    "Debe ingresar el número de factura."
                );
            }


            // ==================================================
            // PRODUCTOS
            // ==================================================

            $productos = $_POST['productos'] ?? [];

            if (empty($productos)) {
                throw new Exception(
                    "Debe agregar al menos un producto."
                );
            }


            // ==================================================
            // PREPARAR DETALLES
            // ==================================================

            $detalles = [];

            $subtotalVenta = 0;
            $impuestoVenta = 0;
            $descuentoVenta = 0;


            foreach ($productos as $producto) {

                $idProducto = (int) (
                    $producto['id_producto'] ?? 0
                );

                $cantidad = (int) (
                    $producto['cantidad'] ?? 0
                );

                $precioUnitario = (float) (
                    $producto['precio_unitario'] ?? 0
                );

                $descuento = (float) (
                    $producto['descuento'] ?? 0
                );

                $impuesto = (float) (
                    $producto['impuesto'] ?? 0
                );

                $observacionProducto =
                    $producto['observacion'] ?? null;


                // ----------------------------------------------
                // VALIDACIONES
                // ----------------------------------------------

                if ($idProducto <= 0) {
                    throw new Exception(
                        "Se encontró un producto inválido."
                    );
                }

                if ($cantidad <= 0) {
                    throw new Exception(
                        "La cantidad del producto debe ser mayor que cero."
                    );
                }

                if ($precioUnitario < 0) {
                    throw new Exception(
                        "El precio del producto no puede ser negativo."
                    );
                }


                // ----------------------------------------------
                // VALIDAR STOCK
                // ----------------------------------------------

                $productosDisponibles =
                    $this->venta->obtenerProductos($idEmpresa);

                $stockDisponible = null;

                foreach ($productosDisponibles as $productoDisponible) {

                    if (
                        (int) $productoDisponible['id_producto']
                        === $idProducto
                    ) {
                        $stockDisponible =
                            (int) $productoDisponible['stock_producto'];

                        break;
                    }
                }

                if ($stockDisponible === null) {
                    throw new Exception(
                        "El producto seleccionado no pertenece a la empresa."
                    );
                }

                if ($cantidad > $stockDisponible) {
                    throw new Exception(
                        "La cantidad solicitada supera el stock disponible."
                    );
                }


                // ----------------------------------------------
                // CALCULAR SUBTOTAL
                // ----------------------------------------------

                $subtotalProducto =
                    ($cantidad * $precioUnitario)
                    - $descuento
                    + $impuesto;


                if ($subtotalProducto < 0) {
                    throw new Exception(
                        "El subtotal de un producto no puede ser negativo."
                    );
                }


                // ----------------------------------------------
                // AGREGAR DETALLE
                // ----------------------------------------------

                $detalles[] = [
                    'id_producto'     => $idProducto,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $precioUnitario,
                    'descuento'       => $descuento,
                    'impuesto'        => $impuesto,
                    'observacion'     => $observacionProducto
                ];


                // ----------------------------------------------
                // ACUMULAR TOTALES
                // ----------------------------------------------

                $subtotalVenta +=
                    $cantidad * $precioUnitario;

                $descuentoVenta += $descuento;

                $impuestoVenta += $impuesto;
            }


            // ==================================================
            // CALCULAR TOTAL
            // ==================================================

            $totalVenta =
                $subtotalVenta
                - $descuentoVenta
                + $impuestoVenta;


            // ==================================================
            // CREAR VENTA
            // ==================================================

            $idVenta = $this->venta->crear(
                $idEmpresa,
                $idCliente,
                $idUsuario,
                $numeroFactura,
                $subtotalVenta,
                $impuestoVenta,
                $descuentoVenta,
                $totalVenta,
                $metodoPago,
                $observacion,
                $detalles,
                $estado
            );

// ==================================================
// MENSAJE DE VENTA
// ==================================================

$_SESSION['mensaje_venta'] =
    "Venta registrada correctamente.";

// ==================================================
// REDIRECCIÓN
// ==================================================

header(
    "Location: index.php?page=verVenta&id=" . $idVenta
);
exit;


        } catch (Exception $e) {

            $_SESSION['error_venta'] =
                $e->getMessage();

            header(
                "Location: index.php?page=crearVenta"
            );

            exit;
        }
    }


    // ==========================================================
    // VER VENTA
    // ==========================================================

    public function ver()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?page=ventas");
            exit;
        }

        $venta = $this->venta->obtenerPorId($id);

        if (!$venta) {

            $_SESSION['error_venta'] =
                "La venta no existe.";

            header("Location: index.php?page=ventas");
            exit;
        }

        $detalles = $this->venta->obtenerDetalles($id);

        require_once "app/views/ventas/ver.php";
    }


        // ==========================================================
// ANULAR VENTA
// ==========================================================

public function anular()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {

        $_SESSION['error_venta'] =
            "No se encontró la venta.";

        header("Location: index.php?page=ventas");
        exit;
    }

    try {

        $this->venta->actualizarEstado(
            $id,
            "Anulada"
        );

        $_SESSION['mensaje_venta'] =
            "La venta fue anulada correctamente.";

    } catch (Exception $e) {

        $_SESSION['error_venta'] =
            $e->getMessage();
    }

    header("Location: index.php?page=ventas");
    exit;
}

    // ==========================================================
    // ELIMINAR VENTA
    // ==========================================================

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?page=ventas");
            exit;
        }

        try {

            $this->venta->eliminar($id);

            $_SESSION['mensaje_venta'] =
                "La venta fue eliminada correctamente.";

        } catch (Exception $e) {

            $_SESSION['error_venta'] =
                $e->getMessage();
        }

        header("Location: index.php?page=ventas");
        exit;
    }


    // ==========================================================
    // ACTUALIZAR ESTADO
    // ==========================================================

    public function actualizarEstado()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=ventas");
            exit;
        }

        $id = $_POST['id_venta'] ?? null;

        $estado = $_POST['estado_venta'] ?? null;

        $estadosPermitidos = [
            'Pendiente',
            'Pagada',
            'Anulada'
        ];

        if (
            !$id ||
            !in_array($estado, $estadosPermitidos, true)
        ) {

            $_SESSION['error_venta'] =
                "Datos inválidos para actualizar el estado.";

            header("Location: index.php?page=ventas");
            exit;
        }

        try {

            $this->venta->actualizarEstado(
                $id,
                $estado
            );

            $_SESSION['mensaje_venta'] =
                "Estado actualizado correctamente.";

        } catch (Exception $e) {

            $_SESSION['error_venta'] =
                $e->getMessage();
        }

        header(
            "Location: index.php?page=verVenta&id=" . $id
        );

        exit;
    }
}