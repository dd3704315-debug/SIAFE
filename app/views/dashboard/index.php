<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<style>

    :root {
        --gris-fondo: #E9ECEF;

        --azul-siafe: #3157A4;
        --azul-cielo: #66D9FF;

        --beige: #E8D8BD;
        --verde: #BFDDB8;
        --amarillo: #F6DF8A;
        --naranja: #F2C095;
        --azul-claro: #B7D3EE;
        --morado-claro: #D5C3EA;
        --rosa: #E8C4CF;
        --turquesa: #B7DDD8;
        --gris-claro: #D9D9D9;
        --crema: #F0DFC2;
        --lavanda: #D8CBE8;
        --verde-agua: #C7DFCF;

        --texto: #30343B;
    }


    /* =========================
       CUERPO
       ========================= */

    body {
        background-color: var(--gris-fondo);
        color: var(--texto);
    }


    .siafe-container {
        padding: 25px;
    }


    /* =========================
       ENCABEZADO
       ========================= */

    .siafe-header {
        background: transparent;

        color: var(--texto);

        border-radius: 0;

        padding: 25px 30px 35px;

        margin-bottom: 25px;

        position: relative;

        box-shadow: none;

        text-align: center;
    }


    /* =========================
       NOMBRE SIAFE
       ========================= */

    .siafe-title {

        font-size: 58px;

        font-weight: 900;

        letter-spacing: 5px;

        margin-bottom: 5px;

        /* Degradado azul cielo → azul rey */

        background: linear-gradient(
            90deg,
            #66D9FF,
            #3157A4
        );

        -webkit-background-clip: text;

        -webkit-text-fill-color: transparent;

        background-clip: text;

        display: inline-block;

        line-height: 1.1;
    }


    /* =========================
       SUBTÍTULO
       ========================= */

    .siafe-subtitle {

        font-size: 15px;

        color: #6C757D;

        margin-bottom: 0;
    }


    /* =========================
       BIENVENIDA
       ========================= */

    .welcome-text {

        margin-top: 8px;

        color: #555;
    }


    /* =========================
       BOTÓN CERRAR SESIÓN
       ========================= */

    .btn-logout {

        position: absolute;

        top: 15px;

        right: 20px;

        background-color: white;

        color: var(--azul-siafe);

        border: 1px solid #D9D9D9;

        padding: 9px 16px;

        border-radius: 12px;

        font-weight: 700;

        text-decoration: none;

        transition: all 0.25s ease;

        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
    }


    .btn-logout:hover {

        background-color: #F1F7FF;

        color: var(--azul-siafe);

        transform: translateY(-2px);

        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.12);
    }


    /* =========================
       TÍTULOS DE SECCIÓN
       ========================= */

    .section-title {

        font-size: 22px;

        font-weight: 800;

        margin-bottom: 20px;

        color: var(--texto);
    }


    /* =========================
       TARJETAS DE MÓDULOS
       ========================= */

    .module-card {

        border: none;

        border-radius: 20px;

        min-height: 170px;

        padding: 25px;

        text-decoration: none;

        color: var(--texto);

        display: flex;

        flex-direction: column;

        justify-content: center;

        align-items: center;

        text-align: center;

        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);

        transition: all 0.25s ease;
    }


    .module-card:hover {

        transform: translateY(-6px);

        color: var(--texto);

        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.15);
    }


    .module-icon {

        font-size: 42px;

        margin-bottom: 12px;
    }


    .module-title {

        font-size: 17px;

        font-weight: 700;

        margin-bottom: 5px;
    }


    .module-description {

        font-size: 13px;

        opacity: 0.75;
    }


    /* =========================
       COLORES DE LAS TARJETAS
       ========================= */

    .card-beige {
        background-color: var(--beige);
    }


    .card-verde {
        background-color: var(--verde);
    }


    .card-amarillo {
        background-color: var(--amarillo);
    }


    .card-naranja {
        background-color: var(--naranja);
    }


    .card-azul {
        background-color: var(--azul-claro);
    }


    .card-morado {
        background-color: var(--morado-claro);
    }


    .card-rosa {
        background-color: var(--rosa);
    }


    .card-turquesa {
        background-color: var(--turquesa);
    }


    .card-gris {
        background-color: var(--gris-claro);
    }


    .card-crema {
        background-color: var(--crema);
    }


    .card-lavanda {
        background-color: var(--lavanda);
    }


    .card-verde-agua {
        background-color: var(--verde-agua);
    }


    /* =========================
       TARJETAS FINANCIERAS
       ========================= */

    .financial-card {

        background-color: white;

        border-radius: 18px;

        padding: 22px;

        border: none;

        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.07);

        height: 100%;
    }


    .financial-title {

        font-size: 14px;

        font-weight: 600;

        color: #6C757D;

        margin-bottom: 8px;
    }


    .financial-value {

        font-size: 25px;

        font-weight: 800;

        color: var(--azul-siafe);
    }


    /* =========================
       RESPONSIVE
       ========================= */

    @media (max-width: 768px) {

        .siafe-container {

            padding: 15px;
        }


        .siafe-header {

            padding: 75px 15px 30px;

            margin-bottom: 20px;
        }


        .siafe-title {

            font-size: 45px;

            letter-spacing: 4px;
        }


        .siafe-subtitle {

            font-size: 13px;
        }


        .btn-logout {

            top: 15px;

            right: 15px;

            padding: 8px 12px;

            font-size: 13px;
        }


        .module-card {

            min-height: 150px;
        }

    }

</style>


<div class="siafe-container">

    <?php if (!empty($_SESSION["bienvenida"])): ?>
        <div class="alert alert-success">
            🎉 ¡Tu cuenta y tu empresa fueron creadas con éxito! Bienvenido a SIAFE.
        </div>
        <?php unset($_SESSION["bienvenida"]); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION["error_ia"])): ?>
        <div class="alert alert-warning">
            <?= htmlspecialchars($_SESSION["error_ia"]); ?>
        </div>
        <?php unset($_SESSION["error_ia"]); ?>
    <?php endif; ?>

    <!-- =========================
         ENCABEZADO SIAFE
         ========================= -->

    <div class="siafe-header">


        <!-- BOTÓN CERRAR SESIÓN -->

        <a
            href="index.php?page=logout"
            class="btn-logout"
        >
            🚪 Cerrar sesión
        </a>


        <!-- NOMBRE SIAFE -->

        <div class="siafe-title">
            SIAFE
        </div>


        <!-- DESCRIPCIÓN -->

        <p class="siafe-subtitle">

            Sistema Inteligente de Análisis Financiero Empresarial con IA

        </p>


        <!-- USUARIO -->

        <p class="mb-0 welcome-text">

            Bienvenido,

            <strong>

                <?= htmlspecialchars(
                    $_SESSION["nombre"] ?? "Usuario"
                ); ?>

                <?= htmlspecialchars(
                    $_SESSION["apellido"] ?? ""
                ); ?>

            </strong>

        </p>


    </div>



    <!-- =========================
         MÓDULOS DEL SISTEMA
         ========================= -->

    <h3 class="section-title">

        Módulos del sistema

    </h3>


    <div class="row">


        <!-- =========================
             EMPRESAS
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=empresas"
                class="module-card card-beige"
            >

                <div class="module-icon">
                    🏢
                </div>

                <div class="module-title">
                    Gestión de Empresas
                </div>

                <div class="module-description">
                    Administrar empresas registradas
                </div>

            </a>

        </div>

        <!-- =========================
             PROVEEDORES
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=proveedores"
                class="module-card card-azul"
            >

                <div class="module-icon">
                    🚚
                </div>

                <div class="module-title">
                    Proveedores
                </div>

                <div class="module-description">
                    Gestionar proveedores de la empresa
                </div>

            </a>

        </div>

        <!-- =========================
             PRODUCTOS
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=productos"
                class="module-card card-verde"
            >

                <div class="module-icon">
                    📦
                </div>

                <div class="module-title">
                    Productos
                </div>

                <div class="module-description">
                    Gestionar productos e inventario
                </div>

            </a>

        </div>



        <!-- =========================
             VENTAS
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=ventas"
                class="module-card card-amarillo"
            >

                <div class="module-icon">
                    🛒
                </div>

                <div class="module-title">
                    Ventas
                </div>

                <div class="module-description">
                    Registrar y consultar ventas
                </div>

            </a>

        </div>



        <!-- =========================
             GASTOS
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=gastos"
                class="module-card card-naranja"
            >

                <div class="module-icon">
                    💸
                </div>

                <div class="module-title">
                    Gastos
                </div>

                <div class="module-description">
                    Controlar gastos empresariales
                </div>

            </a>

        </div>



        <!-- =========================
             ROLES
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=roles"
                class="module-card card-azul"
            >

                <div class="module-icon">
                    🛡️
                </div>

                <div class="module-title">
                    Gestión de Roles
                </div>

                <div class="module-description">
                    Administrar roles y permisos
                </div>

            </a>

        </div>



        <!-- =========================
             USUARIOS
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=usuarios"
                class="module-card card-morado"
            >

                <div class="module-icon">
                    👥
                </div>

                <div class="module-title">
                    Gestión de Usuarios
                </div>

                <div class="module-description">
                    Administrar usuarios del sistema
                </div>

            </a>

        </div>



        <!-- =========================
             CLIENTES
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=clientes"
                class="module-card card-rosa"
            >

                <div class="module-icon">
                    👤
                </div>

                <div class="module-title">
                    Gestión de Clientes
                </div>

                <div class="module-description">
                    Registrar y gestionar clientes
                </div>

            </a>

        </div>



        <!-- =========================
             INGRESOS
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=ingresos"
                class="module-card card-turquesa"
            >

                <div class="module-icon">
                    💰
                </div>

                <div class="module-title">
                    Gestión de Ingresos
                </div>

                <div class="module-description">
                    Registrar y controlar ingresos
                </div>

            </a>

        </div>



        <!-- =========================
             ANÁLISIS INTELIGENTE
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=ia"
                class="module-card card-gris"
            >

                <div class="module-icon">
                    🤖
                </div>

                <div class="module-title">
                    Análisis Inteligente
                </div>

                <div class="module-description">
                    Analizar información con IA
                </div>

            </a>

        </div>



        <!-- =========================
             PRESUPUESTOS
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=presupuestos"
                class="module-card card-crema"
            >

                <div class="module-icon">
                    📊
                </div>

                <div class="module-title">
                    Gestión de Presupuestos
                </div>

                <div class="module-description">
                    Planificar y controlar presupuestos
                </div>

            </a>

        </div>



        <!-- =========================
             REPORTES
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=reportes"
                class="module-card card-lavanda"
            >

                <div class="module-icon">
                    📄
                </div>

                <div class="module-title">
                    Reportes
                </div>

                <div class="module-description">
                    Consultar información financiera
                </div>

            </a>

        </div>



        <!-- =========================
             INDICADORES
             ========================= -->

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <a
                href="index.php?page=indicadores"
                class="module-card card-verde-agua"
            >

                <div class="module-icon">
                    📈
                </div>

                <div class="module-title">
                    Indicadores Financieros
                </div>

                <div class="module-description">
                    Analizar el rendimiento financiero
                </div>

            </a>

        </div>


    </div>



    <!-- =========================
         RESUMEN FINANCIERO
         ========================= -->

    <h3 class="section-title mt-4">

        Resumen financiero

    </h3>


    <div class="row">


        <!-- =========================
             INGRESOS
             ========================= -->

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="financial-card">

                <div class="financial-title">

                    💰 Total de ingresos

                </div>


                <div class="financial-value">

                    $<?= number_format(
                        $totalIngresos ?? 0,
                        0,
                        ",",
                        "."
                    ); ?>

                </div>

            </div>

        </div>



        <!-- =========================
             GASTOS
             ========================= -->

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="financial-card">

                <div class="financial-title">

                    💸 Total de gastos

                </div>


                <div class="financial-value">

                    $<?= number_format(
                        $totalGastos ?? 0,
                        0,
                        ",",
                        "."
                    ); ?>

                </div>

            </div>

        </div>



        <!-- =========================
             UTILIDAD
             ========================= -->

        <div class="col-lg-4 col-md-6 mb-4">

            <div class="financial-card">

                <div class="financial-title">

                    📈 Utilidad neta

                </div>


                <div class="financial-value">

                    $<?= number_format(
                        $utilidad ?? 0,
                        0,
                        ",",
                        "."
                    ); ?>

                </div>

            </div>

        </div>


    </div>


</div>


<?php

require_once "app/views/layouts/footer.php";

?>
