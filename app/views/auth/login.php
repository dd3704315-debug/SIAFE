<?php require_once "app/views/layouts/header.php"; ?>

<style>

    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    body {
        background-color: #E9ECEF;
    }

    /* ==========================================
       CONTENEDOR PRINCIPAL
       ========================================== */

    .login-screen {
        position: relative;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
    }

    /* ==========================================
       LOGO SIAFE - ESQUINA SUPERIOR IZQUIERDA
       ========================================== */

    .logo-siafe {
        position: absolute;

        top: 20px;
        left: 20px;

        width: 85px;
        height: 85px;

        border-radius: 50%;

        overflow: hidden;

        z-index: 5;

        background: white;

        box-shadow:
            0 4px 15px rgba(0, 0, 0, 0.25);
    }

    .logo-siafe img {
        width: 100%;
        height: 100%;

        object-fit: cover;

        display: block;
    }

    /* ==========================================
       CUADRÍCULA DE 4 IMÁGENES
       ========================================== */

    .imagenes-fondo {
        position: absolute;
        inset: 0;

        display: grid;

        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;

        width: 100%;
        height: 100%;
    }

    .imagen-cuadro {
        width: 100%;
        height: 100%;

        overflow: hidden;
    }

    .imagen-cuadro img {
        width: 100%;
        height: 100%;

        object-fit: cover;
        display: block;
    }

    /* ==========================================
       CAPA OSCURA SUAVE
       ========================================== */

    .capa-fondo {
        position: absolute;
        inset: 0;

        background: rgba(0, 0, 0, 0.20);

        z-index: 2;
    }

    /* ==========================================
       CONTENEDOR DEL LOGIN
       ========================================== */

    .login-centro {
        position: absolute;

        top: 50%;
        left: 50%;

        transform: translate(-50%, -50%);

        width: 100%;
        max-width: 420px;

        padding: 20px;

        z-index: 3;
    }

    /* ==========================================
       CUADRO SIAFE
       ========================================== */

    .login-card {
        width: 100%;

        background: white;

        border: none;

        border-radius: 20px;

        overflow: hidden;

        box-shadow:
            0 15px 45px rgba(0, 0, 0, 0.30);
    }

    /* ==========================================
       ENCABEZADO
       ========================================== */

    .login-header {
        background: linear-gradient(
            135deg,
            #66D9FF,
            #3157A4
        );

        color: white;

        text-align: center;

        padding: 25px 20px;
    }

    .login-header h2 {
        margin: 0;

        font-size: 38px;

        font-weight: 900;

        letter-spacing: 4px;
    }

    .login-header p {
        margin: 5px 0 0;

        font-size: 15px;

        font-weight: 500;
    }

    /* ==========================================
       CUERPO
       ========================================== */

    .login-body {
        padding: 30px;
    }

    .login-body .form-label {
        font-weight: 600;

        color: #333;
    }

    .login-body .form-control {
        border-radius: 10px;

        padding: 12px;

        border: 1px solid #ced4da;
    }

    .login-body .form-control:focus {
        border-color: #3157A4;

        box-shadow:
            0 0 0 0.2rem rgba(49, 87, 164, 0.15);
    }

    /* ==========================================
       BOTÓN INGRESAR
       ========================================== */

    .btn-siafe {
        background-color: #3157A4;

        color: white;

        border: none;

        border-radius: 10px;

        padding: 12px;

        font-weight: 700;

        transition: 0.2s;
    }

    .btn-siafe:hover {
        background-color: #244582;

        color: white;

        transform: translateY(-1px);
    }

    /* ==========================================
       RECUPERAR CONTRASEÑA
       ========================================== */

    .forgot-password {
        display: block;

        text-align: center;

        margin-top: 18px;

        color: #3157A4;

        text-decoration: none;

        font-weight: 600;

        font-size: 14px;
    }

    .forgot-password:hover {
        text-decoration: underline;

        color: #244582;
    }

    /* ==========================================
       MENSAJE DE ERROR
       ========================================== */

    .alert {
        border-radius: 10px;

        font-size: 14px;
    }

    /* ==========================================
       CELULARES
       ========================================== */

    @media (max-width: 600px) {

        .login-centro {
            max-width: 360px;

            padding: 15px;
        }

        .login-header {
            padding: 20px 15px;
        }

        .login-header h2 {
            font-size: 32px;
        }

        .login-body {
            padding: 25px 20px;
        }

        /* LOGO MÁS PEQUEÑO EN CELULAR */
        .logo-siafe {
            width: 60px;
            height: 60px;

            top: 15px;
            left: 15px;
        }

    }

</style>


<div class="login-screen">

    <!-- ==========================================
         LOGO SIAFE
         ========================================== -->

    <div class="logo-siafe">

        <img
            src="public/img/logo.jpg"
            alt="Logo SIAFE"
        >

    </div>


    <!-- ==========================================
         4 IMÁGENES
         ========================================== -->

    <div class="imagenes-fondo">

        <!-- ARRIBA IZQUIERDA -->

        <div class="imagen-cuadro">

            <img
                src="public/img/foto4.jpg"
                alt="SIAFE imagen 4"
            >

        </div>


        <!-- ARRIBA DERECHA -->

        <div class="imagen-cuadro">

            <img
                src="public/img/foto2.jpg"
                alt="SIAFE imagen 2"
            >

        </div>


        <!-- ABAJO IZQUIERDA -->

        <div class="imagen-cuadro">

            <img
                src="public/img/foto3.jpg"
                alt="SIAFE imagen 3"
            >

        </div>


        <!-- ABAJO DERECHA -->

        <div class="imagen-cuadro">

            <img
                src="public/img/foto1.jpg"
                alt="SIAFE imagen 1"
            >

        </div>

    </div>


    <!-- ==========================================
         CAPA SOBRE LAS IMÁGENES
         ========================================== -->

    <div class="capa-fondo"></div>


    <!-- ==========================================
         CUADRO CENTRAL SIAFE
         ========================================== -->

    <div class="login-centro">

        <div class="login-card">


            <!-- ==========================================
                 ENCABEZADO
                 ========================================== -->

            <div class="login-header">

                <h2>SIAFE</h2>

                <p>Iniciar sesión</p>

            </div>


            <!-- ==========================================
                 CUERPO
                 ========================================== -->

            <div class="login-body">

                <?php if (isset($error)) : ?>

                    <div class="alert alert-danger">

                        <?= htmlspecialchars($error); ?>

                    </div>

                <?php endif; ?>


                <form
                    method="POST"
                    action="index.php?page=autenticar"
                >


                    <!-- ==========================================
                         CORREO
                         ========================================== -->

                    <div class="mb-3">

                        <label class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="correo"
                            class="form-control"
                            placeholder="Ingrese su correo"
                            required
                        >

                    </div>


                    <!-- ==========================================
                         CONTRASEÑA
                         ========================================== -->

                    <div class="mb-3">

                        <label class="form-label">
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Ingrese su contraseña"
                            required
                        >

                    </div>


                    <!-- ==========================================
                         INGRESAR
                         ========================================== -->

                    <button
                        type="submit"
                        class="btn btn-siafe w-100"
                    >
                        Ingresar
                    </button>

                </form>


                <!-- ==========================================
                     RECUPERAR CONTRASEÑA
                     ========================================== -->

                <a
                    href="index.php?page=recuperarPassword"
                    class="forgot-password"
                >
                    ¿Has olvidado tu contraseña?
                </a>

                <div style="text-align:center; margin-top:14px;">
                    <a href="index.php?page=registro" class="forgot-password">
                        ¿No tienes cuenta? Crea tu empresa en SIAFE
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>