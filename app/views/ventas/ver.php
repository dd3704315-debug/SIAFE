<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<div class="container-fluid mt-4">

<?php if (isset($_SESSION['mensaje_venta'])): ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <?= htmlspecialchars($_SESSION['mensaje_venta']) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Cerrar"
        ></button>

    </div>

    <?php unset($_SESSION['mensaje_venta']); ?>

<?php endif; ?>


<?php if (isset($_SESSION['error_venta'])): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <?= htmlspecialchars($_SESSION['error_venta']) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Cerrar"
        ></button>

    </div>

    <?php unset($_SESSION['error_venta']); ?>

<?php endif; ?>
    <!-- ENCABEZADO -->

    <div class="d-flex justify-content-between align-items-center">

    <h2>Detalle de Venta</h2>

    <a
        href="index.php?page=ventas"
        class="btn btn-secondary"
    >
        ← Volver al Menú
    </a>

</div>

<hr>
        <a
            href="index.php?page=ventas"
            class="btn btn-secondary"
        >
            ← Volver a ventas
        </a>

    </div>


    <!-- INFORMACIÓN DE LA VENTA -->

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                📋 Información de la venta
            </h5>

        </div>


        <div class="card-body">

            <div class="row g-3">

                <!-- ID -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">
                        ID Venta
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $venta['id_venta'] ?? ''
                        ); ?>"
                        readonly
                    >

                </div>


                <!-- FACTURA -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">
                        Número de factura
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $venta['numero_factura_venta'] ?? ''
                        ); ?>"
                        readonly
                    >

                </div>


                <!-- CLIENTE -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">
                        Cliente
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $venta['nombre_cliente'] ?? ''
                        ); ?>"
                        readonly
                    >

                </div>


                <!-- FECHA -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">
                        Fecha
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= !empty($venta['fecha_venta'])
                            ? date(
                                'd/m/Y H:i',
                                strtotime($venta['fecha_venta'])
                            )
                            : 'Sin fecha';
                        ?>"
                        readonly
                    >

                </div>


                <!-- MÉTODO DE PAGO -->

                <div class="col-md-4">

                    <label class="form-label fw-bold">
                        Método de pago
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $venta['metodo_pago_venta'] ?? ''
                        ); ?>"
                        readonly
                    >

                </div>


                <!-- ESTADO -->

                <div class="col-md-4">

                    <label class="form-label fw-bold">
                        Estado
                    </label>

                    <?php

                    $estado =
                        $venta['estado_venta'] ?? 'Pendiente';

                    if ($estado === 'Pagada') {

                        $clase = 'success';

                    } elseif ($estado === 'Anulada') {

                        $clase = 'danger';

                    } else {

                        $clase = 'warning';

                    }

                    ?>

                    <div class="form-control">

                        <span class="badge bg-<?= $clase; ?>">

                            <?= htmlspecialchars($estado); ?>

                        </span>

                    </div>

                </div>


                <!-- OBSERVACIÓN -->

                <div class="col-md-4">

                    <label class="form-label fw-bold">
                        Observación
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $venta['observacion_venta'] ?? ''
                        ); ?>"
                        readonly
                    >

                </div>

            </div>

        </div>

    </div>


    <!-- PRODUCTOS -->

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                📦 Productos vendidos
            </h5>

        </div>


        <div class="card-body">

            <?php if (!empty($detalles)): ?>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>Producto</th>

                                <th>Cantidad</th>

                                <th>Precio unitario</th>

                                <th>Descuento</th>

                                <th>Impuesto</th>

                                <th>Subtotal</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($detalles as $detalle): ?>

                                <tr>

                                    <td>
                                        <?= htmlspecialchars(
                                            $detalle['nombre_producto'] ?? ''
                                        ); ?>
                                    </td>


                                    <td>
                                        <?= htmlspecialchars(
                                            $detalle['cantidad'] ?? 0
                                        ); ?>
                                    </td>


                                    <td>

                                        $
                                        <?= number_format(
                                            (float)($detalle['precio_unitario'] ?? 0),
                                            2,
                                            ',',
                                            '.'
                                        ); ?>

                                    </td>


                                    <td>

                                        $
                                        <?= number_format(
                                            (float)($detalle['descuento'] ?? 0),
                                            2,
                                            ',',
                                            '.'
                                        ); ?>

                                    </td>


                                    <td>

                                        $
                                        <?= number_format(
                                            (float)($detalle['impuesto'] ?? 0),
                                            2,
                                            ',',
                                            '.'
                                        ); ?>

                                    </td>


                                    <td>

                                        <strong>

                                            $
                                            <?= number_format(
                                                (
                                                    (
                                                        (float)($detalle['cantidad'] ?? 0)
                                                        *
                                                        (float)($detalle['precio_unitario'] ?? 0)
                                                    )
                                                    -
                                                    (float)($detalle['descuento'] ?? 0)
                                                    +
                                                    (float)($detalle['impuesto'] ?? 0)
                                                ),
                                                2,
                                                ',',
                                                '.'
                                            ); ?>

                                        </strong>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="alert alert-info text-center">

                    📭 No hay productos asociados a esta venta.

                </div>

            <?php endif; ?>

        </div>

    </div>


    <!-- RESUMEN -->

    <div class="row justify-content-end">

        <div class="col-md-5">

            <div class="card shadow-sm">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">
                        💰 Resumen
                    </h5>

                </div>


                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Subtotal:
                        </span>

                        <strong>

                            $
                            <?= number_format(
                                (float)($venta['subtotal_venta'] ?? 0),
                                2,
                                ',',
                                '.'
                            ); ?>

                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Descuento:
                        </span>

                        <strong>

                            $
                            <?= number_format(
                                (float)($venta['descuento_venta'] ?? 0),
                                2,
                                ',',
                                '.'
                            ); ?>

                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Impuesto:
                        </span>

                        <strong>

                            $
                            <?= number_format(
                                (float)($venta['impuesto_venta'] ?? 0),
                                2,
                                ',',
                                '.'
                            ); ?>

                        </strong>

                    </div>


                    <hr>


                    <div class="d-flex justify-content-between">

                        <span class="fw-bold fs-5">
                            TOTAL:
                        </span>

                        <strong class="fw-bold fs-5 text-success">

                            $
                            <?= number_format(
                                (float)($venta['total_venta'] ?? 0),
                                2,
                                ',',
                                '.'
                            ); ?>

                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- BOTONES -->

    <div class="d-flex justify-content-end gap-2 mt-4">

        <a
            href="index.php?page=ventas"
            class="btn btn-secondary"
        >
            ← Volver
        </a>

    </div>

</div>


<?php

require_once "app/views/layouts/footer.php";

?>