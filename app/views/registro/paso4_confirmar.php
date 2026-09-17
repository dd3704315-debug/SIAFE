<?php require_once "app/views/layouts/header.php"; ?>
<?php require "app/views/registro/_estilos.php"; ?>

<?php
$e = $datos["empresa"] ?? [];
$u = $datos["usuario"] ?? [];
$ciclo = $datos["ciclo"] ?? "Mensual";
$precio = $datos["precio"] ?? 0;
$error = $_SESSION["registro_error"] ?? null;
unset($_SESSION["registro_error"]);
?>

<div class="asistente-contenedor">

    <div class="asistente-logo">
        <img src="public/img/logo.jpg" alt="Logo SIAFE">
    </div>

    <?php require "app/views/registro/_progreso.php"; ?>

    <div class="asistente-tarjeta">

        <h2>Confirma y activa tu cuenta</h2>
        <p class="ayuda">Revisa que todo esté correcto antes de continuar.</p>

        <?php if ($error): ?>
            <div class="aviso-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="resumen-linea">
            <span>Plan</span>
            <strong><?= htmlspecialchars($plan["nombre_plan"] ?? "") ?></strong>
        </div>
        <div class="resumen-linea">
            <span>Ciclo de pago</span>
            <strong><?= $ciclo === "Anual" ? "Anual" : "Mensual" ?></strong>
        </div>
        <div class="resumen-linea">
            <span>Empresa</span>
            <strong><?= htmlspecialchars($e["razon_social"] ?? "") ?></strong>
        </div>
        <div class="resumen-linea">
            <span>Usuario administrador</span>
            <strong><?= htmlspecialchars(($u["nombre"] ?? "") . " " . ($u["apellido"] ?? "")) ?></strong>
        </div>
        <div class="resumen-linea">
            <span>Total a pagar <?= $ciclo === "Anual" ? "(1 año)" : "(1 mes)" ?></span>
            <span>$<?= number_format((float) $precio, 0, ",", ".") ?> COP</span>
        </div>

        <p style="font-size:0.8rem; color:#999; margin-top:14px;">
            * Esta es una simulación del pago dentro del proyecto SIAFE. Aquí es donde,
            en una versión en producción, se conectaría una pasarela real
            (por ejemplo PSE, tarjeta de crédito, etc.).
        </p>

        <form action="index.php?page=registro_confirmar" method="POST">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:16px;">
                <a href="index.php?page=registro&paso=3" class="btn-volver">&larr; Volver</a>
                <button type="submit" class="btn-siafe">Confirmar y activar mi cuenta</button>
            </div>
        </form>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>
