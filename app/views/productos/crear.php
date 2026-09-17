<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<style>

    /* =====================================================
       ESTILO GENERAL SIAFE
    ===================================================== */

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
        --gris-texto: #687385;
        --rojo: #DC3545;
    }

    body {
        background-color: var(--gris-fondo);
        color: var(--texto);
    }

    /* =====================================================
       CONTENEDOR
    ===================================================== */

    .productos-container {
        padding: 25px;
    }

    /* =====================================================
       ENCABEZADO
    ===================================================== */

    .encabezado-producto {
        background: linear-gradient(
            135deg,
            var(--azul-rey),
            var(--azul-rey-oscuro)
        );

        color: var(--blanco);
        border-radius: 15px;
        padding: 25px 30px;
        margin-bottom: 20px;

        box-shadow: 0 6px 18px rgba(23, 70, 162, 0.18);
    }

    .encabezado-producto h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
    }

    .encabezado-producto p {
        margin: 8px 0 0;
        opacity: 0.9;
        font-size: 15px;
    }

    /* =====================================================
       BOTÓN VOLVER
    ===================================================== */

    .btn-volver {
        background-color: var(--blanco);
        color: var(--azul-rey);
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;

        transition: all 0.2s ease;
    }

    .btn-volver:hover {
        background-color: var(--amarillo-girasol);
        color: #000;
        transform: translateY(-1px);
    }

    /* =====================================================
       LÍNEA SIAFE
    ===================================================== */

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

    /* =====================================================
       MENSAJES
    ===================================================== */

    .alerta-producto {
        border: none;
        border-radius: 10px;
        padding: 13px 18px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alerta-exito {
        background-color: #E8F7EE;
        color: #176B36;
        border-left: 5px solid #28A745;
    }

    .alerta-error {
        background-color: #FDECEC;
        color: #A52834;
        border-left: 5px solid var(--rojo);
    }

    /* =====================================================
       SECCIÓN DEL FORMULARIO
    ===================================================== */

    .seccion-producto {
        background-color: var(--blanco);
        border-radius: 15px;
        padding: 25px;

        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
    }

    .titulo-seccion {
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--gris-borde);
    }

    .titulo-seccion h4 {
        color: var(--azul-rey);
        font-weight: 700;
        margin-bottom: 5px;
    }

    .titulo-seccion p {
        color: var(--gris-texto);
        margin: 0;
        font-size: 14px;
    }

    /* =====================================================
       CAMPOS
    ===================================================== */

    .form-label {
        font-weight: 600;
        color: var(--texto);
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        border: 1px solid var(--gris-borde);
        border-radius: 9px;
        min-height: 44px;
        padding: 9px 12px;

        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--azul-rey);
        box-shadow: 0 0 0 3px rgba(23, 70, 162, 0.12);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    /* =====================================================
       SEPARADORES
    ===================================================== */

    .separador-formulario {
        margin: 10px 0 25px;
        border: 0;
        border-top: 1px solid var(--gris-borde);
    }

    .subtitulo-formulario {
        color: var(--azul-rey);
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    /* =====================================================
       AYUDA DE CAMPOS
    ===================================================== */

    .ayuda-campo {
        color: var(--gris-texto);
        font-size: 12px;
        margin-top: 5px;
    }

    /* =====================================================
       SECCIÓN IMAGEN
    ===================================================== */

    .contenedor-imagen {
        background-color: var(--gris-fondo);
        border: 1px solid var(--gris-borde);
        border-radius: 12px;
        padding: 15px;
    }

    .icono-imagen {
        font-size: 28px;
        color: var(--azul-rey);
        margin-bottom: 5px;
    }

    /* =====================================================
       BOTONES
    ===================================================== */

    .contenedor-botones {
        padding-top: 20px;
        border-top: 1px solid var(--gris-borde);
        margin-top: 10px;
    }

    .btn-guardar {
        background-color: var(--amarillo-girasol);
        color: #000;
        border: none;

        border-radius: 9px;
        padding: 11px 22px;

        font-weight: 700;

        transition: all 0.2s ease;
    }

    .btn-guardar:hover {
        background-color: var(--amarillo-oscuro);
        color: #000;
        transform: translateY(-1px);
    }

    .btn-cancelar {
        background-color: #EEF1F6;
        color: var(--texto);
        border: 1px solid var(--gris-borde);

        border-radius: 9px;
        padding: 11px 22px;

        font-weight: 600;
        text-decoration: none;

        transition: all 0.2s ease;
    }

    .btn-cancelar:hover {
        background-color: #DDE3EE;
        color: #000;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 768px) {

        .productos-container {
            padding: 15px;
        }

        .encabezado-producto {
            padding: 20px;
        }

        .encabezado-producto h2 {
            font-size: 23px;
        }

        .btn-volver {
            margin-top: 15px;
            width: 100%;
            text-align: center;
        }

        .seccion-producto {
            padding: 18px;
        }

        .btn-guardar,
        .btn-cancelar {
            width: 100%;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }

    }

</style>


<div class="container-fluid productos-container">

    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="encabezado-producto">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>📦 Registrar Producto</h2>

                <p>
                    Registra nuevos productos, precios, inventario e imágenes
                    para la empresa en SIAFE.
                </p>

            </div>

            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=productos"
                    class="btn-volver"
                >
                    ← Volver a Productos
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LÍNEA SIAFE
    ====================================================== -->

    <div class="linea-siafe"></div>


    <!-- =====================================================
         MENSAJES
    ====================================================== -->

    <?php if (!empty($_SESSION["mensaje_producto"])): ?>

        <div class="alerta-producto alerta-exito">

            ✓
            <?= htmlspecialchars($_SESSION["mensaje_producto"]) ?>

        </div>

        <?php unset($_SESSION["mensaje_producto"]); ?>

    <?php endif; ?>


    <?php if (!empty($_SESSION["error_producto"])): ?>

        <div class="alerta-producto alerta-error">

            ⚠️
            <?= htmlspecialchars($_SESSION["error_producto"]) ?>

        </div>

        <?php unset($_SESSION["error_producto"]); ?>

    <?php endif; ?>


    <!-- =====================================================
         FORMULARIO
    ====================================================== -->

    <div class="seccion-producto">

        <div class="titulo-seccion">

            <h4>📋 Información del producto</h4>

            <p>
                Completa los datos generales, inventario, precios,
                imagen y estado del producto.
            </p>

        </div>


        <form
            action="index.php?page=guardarProducto"
            method="POST"
            enctype="multipart/form-data"
        >

            <!-- =================================================
                 INFORMACIÓN GENERAL
            ================================================== -->

            <div class="subtitulo-formulario">
                🏢 Información general
            </div>

            <div class="row">


                <!-- EMPRESA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        ID Empresa
                    </label>

                    <input
                        type="number"
                        name="id_empresa"
                        class="form-control"
                        min="1"
                        required
                    >

                    <div class="ayuda-campo">
                        Ingresa el ID de una empresa registrada.
                    </div>

                </div>


                <!-- CATEGORÍA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        ID Categoría
                    </label>

                    <input
                        type="number"
                        name="id_categoria_producto"
                        class="form-control"
                        min="1"
                        required
                    >

                    <div class="ayuda-campo">
                        Ingresa el ID de una categoría registrada.
                    </div>

                </div>


                <!-- CÓDIGO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Código del Producto
                    </label>

                    <input
                        type="text"
                        name="codigo_producto"
                        class="form-control"
                        maxlength="40"
                    >

                    <div class="ayuda-campo">
                        Código interno utilizado para identificar el producto.
                    </div>

                </div>


                <!-- NOMBRE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nombre del Producto
                    </label>

                    <input
                        type="text"
                        name="nombre_producto"
                        class="form-control"
                        maxlength="150"
                        required
                    >

                    <div class="ayuda-campo">
                        Nombre comercial del producto.
                    </div>

                </div>


                <!-- DESCRIPCIÓN -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion_producto"
                        class="form-control"
                        rows="3"
                        placeholder="Escribe una descripción del producto..."
                    ></textarea>

                </div>


                <!-- CATEGORÍA TEXTO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Categoría
                    </label>

                    <input
                        type="text"
                        name="categoria_producto"
                        class="form-control"
                        maxlength="100"
                    >

                </div>


                <!-- MARCA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Marca
                    </label>

                    <input
                        type="text"
                        name="marca_producto"
                        class="form-control"
                        maxlength="100"
                    >

                </div>


                <!-- UNIDAD -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Unidad de Medida
                    </label>

                    <select
                        name="unidad_medida_producto"
                        class="form-select"
                    >

                        <option value="Unidad">
                            Unidad
                        </option>

                        <option value="Kilogramo">
                            Kilogramo
                        </option>

                        <option value="Gramo">
                            Gramo
                        </option>

                        <option value="Litro">
                            Litro
                        </option>

                        <option value="Mililitro">
                            Mililitro
                        </option>

                        <option value="Caja">
                            Caja
                        </option>

                        <option value="Paquete">
                            Paquete
                        </option>

                    </select>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- =================================================
                 INVENTARIO Y PRECIOS
            ================================================== -->

            <div class="subtitulo-formulario">
                📊 Inventario y precios
            </div>

            <div class="row">


                <!-- STOCK -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock_producto"
                        class="form-control"
                        min="0"
                        value="0"
                        required
                    >

                    <div class="ayuda-campo">
                        Cantidad disponible inicialmente.
                    </div>

                </div>


                <!-- STOCK MÍNIMO -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Stock Mínimo
                    </label>

                    <input
                        type="number"
                        name="stock_minimo_producto"
                        class="form-control"
                        min="0"
                        value="0"
                        required
                    >

                    <div class="ayuda-campo">
                        Nivel utilizado para las alertas de inventario.
                    </div>

                </div>


                <!-- PRECIO COMPRA -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Precio de Compra
                    </label>

                    <input
                        type="number"
                        name="precio_compra_producto"
                        class="form-control"
                        min="0"
                        step="0.01"
                    >

                    <div class="ayuda-campo">
                        Valor pagado por la empresa.
                    </div>

                </div>


                <!-- PRECIO VENTA -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Precio de Venta
                    </label>

                    <input
                        type="number"
                        name="precio_venta_producto"
                        class="form-control"
                        min="0"
                        step="0.01"
                    >

                    <div class="ayuda-campo">
                        Valor de venta al cliente.
                    </div>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- =================================================
                 IMAGEN Y ESTADO
            ================================================== -->

            <div class="subtitulo-formulario">
                🖼️ Imagen y estado
            </div>

            <div class="row">


                <!-- IMAGEN -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Imagen del Producto
                    </label>

                    <div class="contenedor-imagen">

                        <input
                            type="file"
                            name="imagen_producto"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <div class="ayuda-campo">

                            📷 Selecciona una imagen del producto.

                            <br>

                            Formatos permitidos:
                            JPG, JPEG, PNG o WEBP.

                        </div>

                    </div>

                </div>


                <!-- ESTADO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Estado del Producto
                    </label>

                    <select
                        name="estado_producto"
                        class="form-select"
                    >

                        <option value="Activo">
                            Activo
                        </option>

                        <option value="Inactivo">
                            Inactivo
                        </option>

                    </select>

                    <div class="ayuda-campo">
                        Define si el producto estará disponible para las operaciones
                        del sistema.
                    </div>

                </div>

            </div>


            <!-- =================================================
                 BOTONES
            ================================================== -->

            <div class="contenedor-botones">

                <button
                    type="submit"
                    class="btn-guardar"
                >
                    ✓ Guardar Producto
                </button>

                <a
                    href="index.php?page=productos"
                    class="btn-cancelar"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>