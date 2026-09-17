<?php require_once "app/views/layouts/header.php"; ?>
<?php require "app/views/registro/_estilos.php"; ?>

<?php
$e = $datos["empresa"] ?? [];
$error = $_SESSION["registro_error"] ?? null;
unset($_SESSION["registro_error"]);
?>

<div class="asistente-contenedor">

    <div class="asistente-logo">
        <img src="public/img/logo.jpg" alt="Logo SIAFE">
    </div>

    <?php require "app/views/registro/_progreso.php"; ?>

    <div class="asistente-tarjeta">

        <h2>Datos de tu empresa</h2>
        <p class="ayuda">Esta información aparecerá en tus reportes y documentos.</p>

        <?php if ($error): ?>
            <div class="aviso-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="index.php?page=registro_guardar_empresa" method="POST">

            <label>NIT *</label>
            <input type="text" name="nit" class="form-control" required
                value="<?= htmlspecialchars($e["nit"] ?? "") ?>">

            <label>Razón social *</label>
            <input type="text" name="razon_social" class="form-control" required
                value="<?= htmlspecialchars($e["razon_social"] ?? "") ?>">

            <label>Nombre comercial</label>
            <input type="text" name="nombre_comercial" class="form-control"
                value="<?= htmlspecialchars($e["nombre_comercial"] ?? "") ?>">

            <label>Correo de la empresa</label>
            <input type="email" name="correo_empresa" class="form-control"
                value="<?= htmlspecialchars($e["correo_empresa"] ?? "") ?>">

            <label>Teléfono</label>
            <input type="text" name="telefono_empresa" class="form-control"
                value="<?= htmlspecialchars($e["telefono_empresa"] ?? "") ?>">

            <label>Dirección</label>
            <input type="text" name="direccion_empresa" class="form-control"
                value="<?= htmlspecialchars($e["direccion_empresa"] ?? "") ?>">

            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label>Ciudad</label>
                    <input type="text" name="ciudad_empresa" class="form-control"
                        value="<?= htmlspecialchars($e["ciudad_empresa"] ?? "") ?>">
                </div>
                <div style="flex:1;">
                    <label>Departamento</label>
                    <input type="text" name="departamento_empresa" class="form-control"
                        value="<?= htmlspecialchars($e["departamento_empresa"] ?? "") ?>">
                </div>
            </div>

            <label>Sector económico</label>
            <input type="text" name="sector_economico" class="form-control"
                value="<?= htmlspecialchars($e["sector_economico"] ?? "") ?>">

            <label>Representante legal</label>
            <input type="text" name="representante_legal" class="form-control"
                value="<?= htmlspecialchars($e["representante_legal"] ?? "") ?>">

            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:10px;">
                <a href="index.php?page=registro&paso=1" class="btn-volver">&larr; Volver</a>
                <button type="submit" class="btn-siafe">Continuar</button>
            </div>

        </form>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>
