<?php require_once "app/views/layouts/header.php"; ?>

<style>
    body {
        background-color: #E9ECEF;
    }

    .password-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-card {
        width: 100%;
        max-width: 450px;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .password-header {
        background: linear-gradient(
            135deg,
            #66D9FF,
            #3157A4
        );
        color: white;
        text-align: center;
        padding: 25px;
    }

    .password-header h2 {
        font-weight: 900;
        letter-spacing: 3px;
        margin-bottom: 5px;
    }

    .password-header p {
        margin-bottom: 0;
        font-size: 14px;
    }

    .password-body {
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
</style>

<div class="container password-container">

    <div class="card password-card">

        <div class="password-header">

            <h2>SIAFE</h2>

            <p>Nueva contraseña</p>

        </div>

        <div class="password-body">

            <h5 class="text-center mb-3">
                Crear nueva contraseña
            </h5>

            <p class="text-center text-muted mb-4">
                Ingresa una nueva contraseña para tu cuenta.
            </p>

            <?php if (isset($error)) : ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>

            <form
                method="POST"
                action="index.php?page=guardarNuevaPassword"
            >

                <div class="mb-3">

                    <label class="form-label">
                        Nueva contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Mínimo 6 caracteres"
                        minlength="6"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Confirmar contraseña
                    </label>

                    <input
                        type="password"
                        name="confirmar_password"
                        class="form-control"
                        placeholder="Repita la contraseña"
                        minlength="6"
                        required
                    >

                </div>

                <button
                    type="submit"
                    class="btn btn-siafe w-100"
                >
                    Guardar nueva contraseña
                </button>

            </form>

        </div>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>