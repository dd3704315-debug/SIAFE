<?php require_once "app/views/layouts/header.php"; ?>
<?php require "app/views/registro/_estilos.php"; ?>

<?php
$u = $datos["usuario"] ?? [];
$error = $_SESSION["registro_error"] ?? null;
unset($_SESSION["registro_error"]);
?>

<div class="asistente-contenedor">

    <div class="asistente-logo">
        <img src="public/img/logo.jpg" alt="Logo SIAFE">
    </div>

    <?php require "app/views/registro/_progreso.php"; ?>

    <div class="asistente-tarjeta">

        <h2>Crea tu usuario</h2>
        <p class="ayuda">Serás el administrador principal de la cuenta de tu empresa.</p>

        <?php if ($error): ?>
            <div class="aviso-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="index.php?page=registro_guardar_usuario" method="POST">

            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label>Nombres *</label>
                    <input type="text" name="nombre" class="form-control" required
                        value="<?= htmlspecialchars($u["nombre"] ?? "") ?>">
                </div>
                <div style="flex:1;">
                    <label>Apellidos *</label>
                    <input type="text" name="apellido" class="form-control" required
                        value="<?= htmlspecialchars($u["apellido"] ?? "") ?>">
                </div>
            </div>

            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label>Tipo de documento</label>
                    <select name="tipo_documento" class="form-control">
                        <?php $tipoActual = $u["tipo_documento"] ?? "CC"; ?>
                        <?php foreach (["CC" => "Cédula", "CE" => "Cédula de extranjería", "NIT" => "NIT"] as $codigo => $etiqueta): ?>
                            <option value="<?= $codigo ?>" <?= $tipoActual === $codigo ? "selected" : "" ?>>
                                <?= $etiqueta ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="flex:1;">
                    <label>Número de documento *</label>
                    <input type="text" name="numero_documento" class="form-control" required
                        value="<?= htmlspecialchars($u["numero_documento"] ?? "") ?>">
                </div>
            </div>

            <label>Correo electrónico *</label>
            <input type="email" name="correo" class="form-control" required
                value="<?= htmlspecialchars($u["correo"] ?? "") ?>">

            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                value="<?= htmlspecialchars($u["telefono"] ?? "") ?>">

            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control"
                value="<?= htmlspecialchars($u["direccion"] ?? "") ?>">

            <label>Nombre de usuario *</label>
            <input type="text" name="usuario" class="form-control" required
                value="<?= htmlspecialchars($u["usuario"] ?? "") ?>">

            <div style="display:flex; gap:12px;">
                <div style="flex:1;">
                    <label>Contraseña *</label>
                    <input type="password" name="password" class="form-control" required minlength="6">
                </div>
                <div style="flex:1;">
                    <label>Confirmar contraseña *</label>
                    <input type="password" name="password_confirmar" class="form-control" required minlength="6">
                </div>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:10px;">
                <a href="index.php?page=registro&paso=2" class="btn-volver">&larr; Volver</a>
                <button type="submit" class="btn-siafe">Continuar</button>
            </div>

        </form>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>
