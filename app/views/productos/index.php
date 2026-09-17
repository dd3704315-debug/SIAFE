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

.productos-container {
    padding: 25px;
}


/* =========================================================
   ENCABEZADO PRINCIPAL
   ========================================================= */

.encabezado-productos {
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


.encabezado-productos h2 {
    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}


.encabezado-productos p {
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
   ALERTAS
   ========================================================= */

.alert {
    border-radius: 10px;
}


/* =========================================================
   ALERTA DE INVENTARIO
   ========================================================= */

.alert-inventario {
    background-color: #FFF8D8;

    border-left: 6px solid var(--amarillo-girasol);

    color: #5F4A00;

    border-radius: 10px;

    padding: 18px 20px;

    box-shadow:
        0 4px 12px rgba(0, 0, 0, 0.05);
}


.alert-inventario h5 {
    color: #6B5200;
}


/* =========================================================
   SECCIÓN PRODUCTOS REGISTRADOS
   ========================================================= */

.seccion-productos {
    background-color: var(--blanco);

    border-radius: 15px;

    padding: 20px;

    margin-top: 25px;

    box-shadow:
        0 5px 18px rgba(0, 0, 0, 0.07);
}


.seccion-productos h4 {
    color: var(--azul-rey);

    font-weight: 700;

    margin: 0;
}


/* =========================================================
   BOTÓN NUEVO PRODUCTO
   ========================================================= */

.btn-nuevo-producto {
    background-color: var(--amarillo-girasol);

    color: #171717;

    border: 2px solid var(--amarillo-girasol);

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 18px;

    transition: all 0.2s ease;
}


.btn-nuevo-producto:hover {
    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow:
        0 5px 12px rgba(23, 70, 162, 0.25);
}


/* =========================================================
   TABLA
   ========================================================= */

.tabla-productos {
    border-collapse: separate;

    border-spacing: 0;

    overflow: hidden;

    border-radius: 12px;

    margin-bottom: 0;
}


/* =========================================================
   ENCABEZADO TABLA
   ========================================================= */

.tabla-productos thead th {

    background: var(--azul-rey);

    color: var(--blanco);

    border: none;

    padding: 14px 10px;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

    vertical-align: middle;
}


.tabla-productos thead th:first-child {
    border-top-left-radius: 10px;
}


.tabla-productos thead th:last-child {
    border-top-right-radius: 10px;
}


/* =========================================================
   FILAS
   ========================================================= */

.tabla-productos tbody tr {

    transition: all 0.2s ease;

    background-color: var(--blanco);
}


.tabla-productos tbody tr:hover {

    background-color: var(--azul-claro);

    transform: scale(1.001);
}


.tabla-productos tbody td {

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
   NOMBRE DEL PRODUCTO
   ========================================================= */

.nombre-producto {

    font-weight: 700;

    color: var(--azul-rey);
}


/* =========================================================
   IMAGEN PRODUCTO
   ========================================================= */

.imagen-producto {

    width: 70px;

    height: 70px;

    object-fit: cover;

    border-radius: 10px;

    border: 3px solid var(--azul-rey);

    background-color: var(--blanco);

    padding: 2px;

    transition: all 0.2s ease;
}


.imagen-producto:hover {

    transform: scale(1.08);

    border-color: var(--amarillo-girasol);

    box-shadow:
        0 4px 10px rgba(0, 0, 0, 0.15);
}


/* =========================================================
   PRECIO
   ========================================================= */

.precio-producto {

    font-weight: 700;

    color: var(--azul-rey);

    white-space: nowrap;
}


/* =========================================================
   STOCK
   ========================================================= */

.stock-producto {

    font-weight: 700;

    color: #333;
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
   BOTÓN EDITAR
   ========================================================= */

.btn-editar {

    background-color: var(--amarillo-girasol);

    border: 1px solid var(--amarillo-girasol);

    color: #161616;

    font-weight: 600;

    border-radius: 7px;

    margin-bottom: 4px;
}


.btn-editar:hover {

    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);
}


/* =========================================================
   BOTÓN ELIMINAR
   ========================================================= */

.btn-eliminar {

    background-color: #DC3545;

    border: 1px solid #DC3545;

    color: var(--blanco);

    font-weight: 600;

    border-radius: 7px;
}


.btn-eliminar:hover {

    background-color: #B02A37;

    border-color: #B02A37;

    color: var(--blanco);
}


/* =========================================================
   SIN IMAGEN
   ========================================================= */

.sin-imagen {

    display: inline-block;

    background-color: var(--azul-claro);

    color: var(--azul-rey);

    padding: 10px;

    border-radius: 8px;

    font-size: 12px;

    font-weight: 600;
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

    .productos-container {
        padding: 15px;
    }

    .encabezado-productos {
        padding: 20px;
    }

    .encabezado-productos h2 {
        font-size: 22px;
    }

    .btn-volver {
        margin-top: 15px;

        width: 100%;
    }

    .seccion-productos {
        padding: 12px;
    }

}

</style>


<div class="container-fluid productos-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-productos">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    📦 Gestión de Productos
                </h2>

                <p>
                    Administra los productos, precios, inventario e imágenes de tu empresa.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=dashboard"
                    class="btn btn-volver"
                >
                    ← Volver al Menú
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         MENSAJE ÉXITO
         ===================================================== -->

    <?php if (isset($_SESSION["mensaje_producto"])): ?>

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <strong>✓ Éxito:</strong>

            <?= htmlspecialchars($_SESSION["mensaje_producto"]) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar"
            ></button>

        </div>

        <?php unset($_SESSION["mensaje_producto"]); ?>

    <?php endif; ?>


    <!-- =====================================================
         MENSAJE ERROR
         ===================================================== -->

    <?php if (isset($_SESSION["error_producto"])): ?>

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <strong>⚠ Error:</strong>

            <?= htmlspecialchars($_SESSION["error_producto"]) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar"
            ></button>

        </div>

        <?php unset($_SESSION["error_producto"]); ?>

    <?php endif; ?>


    <!-- =====================================================
         LÍNEA SIAFE
         ===================================================== -->

    <div class="linea-siafe"></div>


    <?php

    $productosStockBajo = 0;
    $productosAgotados = 0;

    if (!empty($productos)) {

        foreach ($productos as $producto) {

            $stock = (float)($producto["stock_producto"] ?? 0);

            $stockMinimo =
                (float)($producto["stock_minimo_producto"] ?? 0);

            if ($stock <= 0) {

                $productosAgotados++;

            } elseif ($stock <= $stockMinimo) {

                $productosStockBajo++;
            }
        }
    }

    ?>


    <!-- =====================================================
         ALERTA DE INVENTARIO
         ===================================================== -->

    <?php if ($productosAgotados > 0 || $productosStockBajo > 0): ?>

        <div class="alert-inventario mb-4">

            <h5 class="fw-bold mb-2">
                ⚠️ Alerta de inventario
            </h5>


            <?php if ($productosAgotados > 0): ?>

                <div>
                    🔴 Hay
                    <strong><?= $productosAgotados; ?></strong>
                    producto(s) agotado(s).
                </div>

            <?php endif; ?>


            <?php if ($productosStockBajo > 0): ?>

                <div>
                    ⚠️ Hay
                    <strong><?= $productosStockBajo; ?></strong>
                    producto(s) con stock bajo.
                </div>

            <?php endif; ?>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         SECCIÓN PRODUCTOS
         ===================================================== -->

    <div class="seccion-productos">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4>
                    📋 Productos registrados
                </h4>

                <small class="text-muted">
                    Listado de productos disponibles en SIAFE
                </small>

            </div>


            <a
                href="index.php?page=crearProducto"
                class="btn btn-nuevo-producto"
            >
                ＋ Nuevo Producto
            </a>

        </div>


        <!-- =================================================
             TABLA
             ================================================= -->

        <div class="table-responsive">

            <table class="table tabla-productos table-hover">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Código</th>

                        <th>Producto</th>

                        <th>Imagen</th>

                        <th>Empresa</th>

                        <th>Marca</th>

                        <th>Unidad</th>

                        <th>Stock</th>

                        <th>Stock Mínimo</th>

                        <th>Estado de Stock</th>

                        <th>Precio Compra</th>

                        <th>Precio Venta</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                <?php if (!empty($productos)): ?>

                    <?php foreach ($productos as $producto): ?>

                        <?php

                        $stock =
                            (float)($producto["stock_producto"] ?? 0);

                        $stockMinimo =
                            (float)($producto["stock_minimo_producto"] ?? 0);

                        ?>


                        <tr>

                            <!-- ID -->

                            <td class="columna-id">

                                <?= htmlspecialchars(
                                    $producto["id_producto"]
                                ); ?>

                            </td>


                            <!-- CÓDIGO -->

                            <td>

                                <?= htmlspecialchars(
                                    $producto["codigo_producto"] ?? ""
                                ); ?>

                            </td>


                            <!-- PRODUCTO -->

                            <td class="nombre-producto">

                                <?= htmlspecialchars(
                                    $producto["nombre_producto"]
                                ); ?>

                            </td>


                            <!-- IMAGEN -->

                            <td class="text-center">

                                <?php if (!empty($producto["imagen_producto"])): ?>

                                    <img
                                        src="public/img/productos/<?= htmlspecialchars($producto["imagen_producto"]); ?>"
                                        alt="<?= htmlspecialchars($producto["nombre_producto"]); ?>"
                                        class="imagen-producto"
                                    >

                                <?php else: ?>

                                    <span class="sin-imagen">
                                        Sin imagen
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- EMPRESA -->

                            <td>

                                <?= htmlspecialchars(
                                    $producto["razon_social_empresa"] ?? ""
                                ); ?>

                            </td>


                            <!-- MARCA -->

                            <td>

                                <?= htmlspecialchars(
                                    $producto["marca_producto"] ?? ""
                                ); ?>

                            </td>


                            <!-- UNIDAD -->

                            <td>

                                <?= htmlspecialchars(
                                    $producto["unidad_medida_producto"] ?? ""
                                ); ?>

                            </td>


                            <!-- STOCK -->

                            <td class="stock-producto">

                                <?= htmlspecialchars($stock); ?>

                            </td>


                            <!-- STOCK MÍNIMO -->

                            <td>

                                <?= htmlspecialchars($stockMinimo); ?>

                            </td>


                            <!-- ESTADO STOCK -->

                            <td>

                                <?php if ($stock <= 0): ?>

                                    <span class="badge bg-danger">
                                        🔴 Agotado
                                    </span>

                                <?php elseif ($stock <= $stockMinimo): ?>

                                    <span class="badge bg-warning text-dark">
                                        ⚠️ Stock bajo
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-success">
                                        🟢 Stock disponible
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- PRECIO COMPRA -->

                            <td class="precio-producto">

                                $

                                <?= number_format(
                                    (float)(
                                        $producto["precio_compra_producto"]
                                        ?? 0
                                    ),
                                    2,
                                    ",",
                                    "."
                                ); ?>

                            </td>


                            <!-- PRECIO VENTA -->

                            <td class="precio-producto">

                                $

                                <?= number_format(
                                    (float)(
                                        $producto["precio_venta_producto"]
                                        ?? 0
                                    ),
                                    2,
                                    ",",
                                    "."
                                ); ?>

                            </td>


                            <!-- ESTADO -->

                            <td>

                                <?php if (
                                    ($producto["estado_producto"] ?? "")
                                    === "Activo"
                                ): ?>

                                    <span class="badge bg-success">
                                        Activo
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">
                                        Inactivo
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- ACCIONES -->

                            <td>

                                <a
                                    href="index.php?page=editarProducto&id=<?= $producto["id_producto"]; ?>"
                                    class="btn btn-editar btn-sm"
                                >
                                    ✏️ Editar
                                </a>


                                <a
                                    href="index.php?page=eliminarProducto&id=<?= $producto["id_producto"]; ?>"
                                    class="btn btn-eliminar btn-sm"
                                    onclick="return confirm('¿Desea eliminar este producto?');"
                                >
                                    🗑️ Eliminar
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="14"
                            class="text-center py-5"
                        >

                            <div class="text-muted">

                                <div style="font-size: 45px;">
                                    📦
                                </div>

                                <strong>
                                    No hay productos registrados.
                                </strong>

                                <div class="mt-2">
                                    Agrega un producto para comenzar.
                                </div>

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- =========================================================
     CIERRE AUTOMÁTICO DE ALERTAS
     ========================================================= -->

<script>

setTimeout(function () {

    const alertas = document.querySelectorAll(
        ".alert-success, .alert-danger"
    );

    alertas.forEach(function (alerta) {

        const alertaBootstrap =
            bootstrap.Alert.getOrCreateInstance(alerta);

        alertaBootstrap.close();

    });

}, 3000);

</script>


<?php require_once "app/views/layouts/footer.php"; ?>
