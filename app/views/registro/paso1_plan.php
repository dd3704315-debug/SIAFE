<?php require_once "app/views/layouts/header.php"; ?>

<?php require "app/views/registro/_estilos.php"; ?>

<?php

$planPreseleccionado = $datos["id_plan"] ?? ($_GET["plan"] ?? "");

$error = $_SESSION["registro_error"] ?? null;

unset($_SESSION["registro_error"]);

?>

<div class="asistente-contenedor">

    <div class="asistente-logo">
        <img src="public/img/logo.jpg" alt="Logo SIAFE">
    </div>

    <?php require "app/views/registro/_progreso.php"; ?>

    <div class="asistente-tarjeta">

        <h2>Elige tu plan</h2>

        <p class="ayuda">
            Selecciona el plan que mejor se adapte a las necesidades de tu empresa.
        </p>

        <?php if ($error): ?>

            <div class="aviso-error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <form action="index.php?page=registro_guardar_plan" method="POST">

            <?php foreach ($planes as $indice => $p): ?>

                <?php

                $marcado = $planPreseleccionado !== ""
                    ? (string) $planPreseleccionado === (string) $p["id_plan"]
                    : $indice === 0;

                ?>

                <label class="plan-opcion">

                    <input
                        type="radio"
                        name="id_plan"
                        value="<?= (int) $p["id_plan"] ?>"
                        <?= $marcado ? "checked" : "" ?>
                        required
                    >

                    <span class="nombre-plan">
                        <?= htmlspecialchars($p["nombre_plan"]) ?>
                    </span>

                    <span class="precio-plan">

                        <?php if ((float) $p["precio_plan"] == 0): ?>

                            Gratis

                        <?php else: ?>

                            $<?= number_format((float) $p["precio_plan"], 0, ",", ".") ?>
                            COP / <?= strtolower($p["periodo_plan"]) ?>

                        <?php endif; ?>

                    </span>

                    <div style="clear:both; color:#666; font-size:0.85rem; margin-top:4px;">

                        <?= htmlspecialchars($p["descripcion_plan"]) ?>

                    </div>

                </label>

            <?php endforeach; ?>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">

                <a href="index.php?page=landing" class="btn-volver">
                    &larr; Volver al inicio
                </a>

                <button type="submit" class="btn-siafe">
                    Continuar
                </button>

            </div>

        </form>

    </div>

    <p style="text-align:center; margin-top:16px; font-size:0.88rem; color:#666;">

        ¿Ya tienes cuenta?

        <a
            href="index.php?page=login"
            style="color:var(--azul-siafe); font-weight:600;"
        >
            Inicia sesión
        </a>

    </p>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>