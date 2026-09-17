<?php require_once "app/views/layouts/header.php"; ?>

<style>
    body {
        background-color: #E9ECEF;
    }

    .recuperar-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .recuperar-card {
        width: 100%;
        max-width: 450px;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .recuperar-header {
        background: linear-gradient(
            135deg,
            #66D9FF,
            #3157A4
        );
        color: white;
        text-align: center;
        padding: 25px;
    }

    .recuperar-header h2 {
        font-weight: 900;
        letter-spacing: 3px;
        margin-bottom: 5px;
    }

    .recuperar-header p {
        margin-bottom: 0;
        font-size: 14px;
    }

    .recuperar-body {
        padding: 30px;
        background-color: white;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
    }

    .form-control:focus {
        border-color: #3157A4;
        box-shadow: 0 0 0 0.2rem rgba(49, 87, 164, 0.15);
    }

    .btn-siafe {
        background-color: #3157A4;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
    }

    .btn-siafe:hover {
        background-color: #244582;
        color: white;
    }

    .volver-login {
        display: block;
        text-align: center;
        margin-top: 18px;
        color: #3157A4;
        text-decoration: none;
        font-weight: 600;
    }

    .volver-login:hover {
        text-decoration: underline;
    }
</style>

<div class="container recuperar-container">

    <div class="card recuperar-card">

        <div class="recuperar-header">

            <h2>SIAFE</h2>

            <p>Recuperación de contraseña</p>

        </div>

        <div class="recuperar-body">

            <h5 class="text-center mb-3">
                ¿Olvidaste tu contraseña?
            </h5>

            <p class="text-center text-muted mb-4">
                Ingresa el correo electrónico registrado en tu cuenta.
            </p>

            <?php if (isset($error)) : ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>

            <form
                method="POST"
                action="index.php?page=procesarRecuperacion"
            >

                <div class="mb-3">

                    <label class="form-label">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                        placeholder="ejemplo@correo.com"
                        required
                        autofocus
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-siafe w-100"
                >
                    Continuar
                </button>

            </form>

            <a
                href="index.php?page=login"
                class="volver-login"
            >
                ← Volver al inicio de sesión
            </a>

        </div>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>
