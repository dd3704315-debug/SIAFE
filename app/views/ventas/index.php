<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<style>

/* =========================================================
   COLORES SIAFE
   ========================================================= */

:root {
    --azul-rey: #1746A2;
    --azul-rey-oscuro: #10357D;
    --azul-claro: #EAF1FF;
    --amarillo-girasol: #F9C80E;
    --amarillo-oscuro: #D9A900;
    --blanco: #FFFFFF;
    --gris-fondo: #F5F7FB;
    --gris-borde: #DDE3EE;
    --texto: #263238;
}


/* =========================================================
   FONDO GENERAL
   ========================================================= */

body {
    background-color: var(--gris-fondo);
}


/* =========================================================
   CONTENEDOR
   ========================================================= */

.ventas-container {
    padding: 25px;
}


/* =========================================================
   ENCABEZADO PRINCIPAL
   ========================================================= */

.encabezado-ventas {

    background: linear-gradient(
        135deg,
        var(--azul-rey),
        var(--azul-rey-oscuro)
    );

    color: var(--blanco);

    border-radius: 15px;

    padding: 25px 30px;

    margin-bottom: 25px;

    box-shadow:
        0 8px 20px rgba(23, 70, 162, 0.20);
}


.encabezado-ventas h2 {

    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}


.encabezado-ventas p {

    margin-top: 6px;

    margin-bottom: 0;

    color: #E5ECFF;
}


/* =========================================================
   BOTÓN VOLVER
   ========================================================= */

.btn-volver {

    background-color: var(--blanco);

    color: var(--azul-rey);

    border: none;

    font-weight: 600;

    border-radius: 9px;

    padding: 10px 18px;

    transition: 0.2s;
}


.btn-volver:hover {

    background-color: var(--amarillo-girasol);

    color: #000;

    transform: translateY(-2px);
}


/* =========================================================
   BOTÓN NUEVA VENTA
   ========================================================= */

.btn-nueva-venta {

    background-color: var(--amarillo-girasol);

    color: #171717;

    border: 2px solid var(--amarillo-girasol);

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 18px;

    transition: all 0.2s ease;
}


.btn-nueva-venta:hover {

    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow:
        0 5px 12px rgba(23, 70, 162, 0.25);
}


/* =========================================================
   ALERTAS
   ========================================================= */

.alert {

    border-radius: 10px;
}


/* =========================================================
   SECCIÓN VENTAS
   ========================================================= */

.seccion-ventas {

    background-color: var(--blanco);

    border-radius: 15px;

    padding: 20px;

    margin-top: 25px;

    box-shadow:
        0 5px 18px rgba(0, 0, 0, 0.07);
}


.seccion-ventas h4 {

    color: var(--azul-rey);

    font-weight: 700;

    margin: 0;
}


/* =========================================================
   TABLA
   ========================================================= */

.tabla-ventas {

    border-collapse: separate;

    border-spacing: 0;

    overflow: hidden;

    border-radius: 12px;

    margin-bottom: 0;
}


/* =========================================================
   ENCABEZADO TABLA
   ========================================================= */

.tabla-ventas thead th {

    background: var(--azul-rey);

    color: var(--blanco);

    border: none;

    padding: 14px 10px;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

    vertical-align: middle;
}


.tabla-ventas thead th:first-child {

    border-top-left-radius: 10px;
}


.tabla-ventas thead th:last-child {

    border-top-right-radius: 10px;
}


/* =========================================================
   FILAS
   ========================================================= */

.tabla-ventas tbody tr {

    transition: all 0.2s ease;

    background-color: var(--blanco);
}


.tabla-ventas tbody tr:hover {

    background-color: var(--azul-claro);

    transform: scale(1.001);
}


.tabla-ventas tbody td {

    vertical-align: middle;

    padding: 12px 10px;

    border-color: var(--gris-borde);

    color: var(--texto);

    font-size: 14px;
}


/* =========================================================
   ID
   ========================================================= */

.columna-id {

    color: var(--azul-rey);

    font-weight: 700;
}


/* =========================================================
   FACTURA
   ========================================================= */

.numero-factura {

    font-weight: 700;

    color: var(--azul-rey);
}


/* =========================================================
   TOTAL
   ========================================================= */

.total-venta {

    font-weight: 700;

    color: var(--azul-rey);

    white-space: nowrap;
}


/* =========================================================
   BADGES
   ========================================================= */

.badge {

    padding: 7px 10px;

    border-radius: 20px;

    font-size: 12px;
}


/* =========================================================
   BOTÓN VER
   ========================================================= */

.btn-ver-venta {

    background-color: var(--azul-rey);

    border: 1px solid var(--azul-rey);

    color: var(--blanco);

    font-weight: 600;

    border-radius: 7px;
}


.btn-ver-venta:hover {

    background-color: var(--azul-rey-oscuro);

    border-color: var(--azul-rey-oscuro);

    color: var(--blanco);
}


/* =========================================================
   BOTÓN ANULAR
   ========================================================= */

.btn-anular-venta {

    background-color: var(--amarillo-girasol);

    border: 1px solid var(--amarillo-girasol);

    color: #161616;

    font-weight: 600;

    border-radius: 7px;
}


.btn-anular-venta:hover {

    background-color: var(--amarillo-oscuro);

    border-color: var(--amarillo-oscuro);

    color: #000;
}


/* =========================================================
   BOTÓN ELIMINAR
   ========================================================= */

.btn-eliminar-venta {

    background-color: #DC3545;

    border: 1px solid #DC3545;

    color: var(--blanco);

    font-weight: 600;

    border-radius: 7px;
}


.btn-eliminar-venta:hover {

    background-color: #B02A37;

    border-color: #B02A37;

    color: var(--blanco);
}


/* =========================================================
   MENSAJE SIN VENTAS
   ========================================================= */

.alert-sin-ventas {

    background-color: var(--azul-claro);

    border-left: 6px solid var(--azul-rey);

    color: var(--texto);

    border-radius: 10px;

    padding: 20px;
}


.alert-sin-ventas h5 {

    color: var(--azul-rey);

    font-weight: 700;
}


/* =========================================================
   LÍNEA DECORATIVA
   ========================================================= */

.linea-siafe {

    height: 5px;

    width: 100%;

    background: linear-gradient(
        90deg,
        var(--azul-rey) 0%,
        var(--azul-rey) 65%,
        var(--amarillo-girasol) 65%,
        var(--amarillo-girasol) 100%
    );

    border-radius: 10px;

    margin-bottom: 20px;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .ventas-container {

        padding: 15px;
    }

    .encabezado-ventas {

        padding: 20px;
    }

    .encabezado-ventas h2 {

        font-size: 22px;
    }

    .btn-volver {

        margin-top: 15px;

        width: 100%;
    }

    .seccion-ventas {

        padding: 12px;
    }

}

</style>


<div class="container-fluid ventas-container">


    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-ventas">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    💰 Gestión de Ventas
                </h2>

                <p>
                    Administración y seguimiento de las ventas registradas.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <div class="d-flex justify-content-md-end gap-2">

                    <a
                        href="index.php?page=dashboard"
                        class="btn btn-volver"
                    >
                        ← Volver al Menú
                    </a>

                    <a
                        href="index.php?page=crearVenta"
                        class="btn btn-nueva-venta"
                    >
                        ＋ Nueva Venta
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         MENSAJES
         ===================================================== -->

    <?php if (!empty($_SESSION['mensaje_venta'])): ?>

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <?= htmlspecialchars($_SESSION['mensaje_venta']); ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar"
            ></button>

        </div>

        <?php unset($_SESSION['mensaje_venta']); ?>

    <?php endif; ?>


    <?php if (!empty($_SESSION['error_venta'])): ?>

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <?= htmlspecialchars($_SESSION['error_venta']); ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar"
            ></button>

        </div>

        <?php unset($_SESSION['error_venta']); ?>

    <?php endif; ?>


    <script>

        setTimeout(function () {

            const alertas = document.querySelectorAll('.alert');

            alertas.forEach(function (alerta) {

                alerta.style.transition = "opacity 0.5s";

                alerta.style.opacity = "0";

                setTimeout(function () {

                    alerta.remove();

                }, 500);

            });

        }, 3000);

    </script>


    <!-- =====================================================
         LÍNEA SIAFE
         ===================================================== -->

    <div class="linea-siafe"></div>


    <!-- =====================================================
         SECCIÓN VENTAS
         ===================================================== -->

    <div class="seccion-ventas">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4>
                    📋 Ventas registradas
                </h4>

                <small class="text-muted">
                    Listado de ventas realizadas en SIAFE
                </small>

            </div>

        </div>


        <?php if (!empty($ventas)): ?>

            <div class="table-responsive">

                <table class="table tabla-ventas table-hover">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Factura</th>

                            <th>Cliente</th>

                            <th>Fecha</th>

                            <th>Subtotal</th>

                            <th>Descuento</th>

                            <th>Impuesto</th>

                            <th>Total</th>

                            <th>Método de pago</th>

                            <th>Estado</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($ventas as $venta): ?>

                            <tr>


                                <!-- ID -->

                                <td class="columna-id">

                                    <?= htmlspecialchars(
                                        $venta["id_venta"]
                                    ); ?>

                                </td>


                                <!-- FACTURA -->

                                <td class="numero-factura">

                                    <?= htmlspecialchars(
                                        $venta["numero_factura_venta"]
                                    ); ?>

                                </td>


                                <!-- CLIENTE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $venta["nombre_cliente"]
                                    ); ?>

                                </td>


                                <!-- FECHA -->

                                <td>

                                    <?= !empty($venta["fecha_venta"])

                                        ? date(
                                            "d/m/Y H:i",
                                            strtotime(
                                                $venta["fecha_venta"]
                                            )
                                        )

                                        : "Sin fecha";
                                    ?>

                                </td>


                                <!-- SUBTOTAL -->

                                <td>

                                    $<?= number_format(
                                        (float) $venta["subtotal_venta"],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- DESCUENTO -->

                                <td>

                                    $<?= number_format(
                                        (float) $venta["descuento_venta"],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- IMPUESTO -->

                                <td>

                                    $<?= number_format(
                                        (float) $venta["impuesto_venta"],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- TOTAL -->

                                <td class="total-venta">

                                    $<?= number_format(
                                        (float) $venta["total_venta"],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- MÉTODO DE PAGO -->

                                <td>

                                    <?= htmlspecialchars(
                                        $venta["metodo_pago_venta"]
                                    ); ?>

                                </td>


                                <!-- ESTADO -->

                                <td>

                                    <?php

                                    $estado =
                                        $venta["estado_venta"];

                                    if ($estado === "Pagada") {

                                        $clase = "success";

                                    } elseif ($estado === "Anulada") {

                                        $clase = "danger";

                                    } else {

                                        $clase = "warning";

                                    }

                                    ?>

                                    <span
                                        class="badge bg-<?= $clase; ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $estado
                                        ); ?>

                                    </span>

                                </td>


                                <!-- ACCIONES -->

                                <td>

                                    <div class="btn-group">

                                        <!-- VER -->

                                        <a
                                            href="index.php?page=verVenta&id=<?= $venta["id_venta"]; ?>"
                                            class="btn btn-sm btn-ver-venta"
                                            title="Ver venta"
                                        >
                                            👁️
                                        </a>


                                        <!-- ANULAR -->

                                        <?php if ($estado !== "Anulada"): ?>

                                            <a
                                                href="index.php?page=anularVenta&id=<?= $venta["id_venta"]; ?>"
                                                class="btn btn-sm btn-anular-venta"
                                                onclick="return confirm('¿Desea anular esta venta?');"
                                                title="Anular venta"
                                            >
                                                ⚠️
                                            </a>

                                        <?php endif; ?>


                                        <!-- ELIMINAR -->

                                        <a
                                            href="index.php?page=eliminarVenta&id=<?= $venta["id_venta"]; ?>"
                                            class="btn btn-sm btn-eliminar-venta"
                                            onclick="return confirm('¿Está seguro de eliminar esta venta?');"
                                            title="Eliminar venta"
                                        >
                                            🗑️
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>


        <?php else: ?>


            <!-- =================================================
                 SIN VENTAS
                 ================================================= -->

            <div class="alert-sin-ventas text-center">

                <h5>
                    📭 No hay ventas registradas
                </h5>

                <p class="mb-3">

                    Todavía no se ha registrado ninguna venta.

                </p>


                <a
                    href="index.php?page=crearVenta"
                    class="btn btn-nueva-venta"
                >
                    ＋ Registrar primera venta
                </a>

            </div>


        <?php endif; ?>

    </div>

</div>


<?php

require_once "app/views/layouts/footer.php";

?>