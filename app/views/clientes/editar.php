<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<div class="container mt-4">

    <!-- ENCABEZADO -->

    <div class="d-flex justify-content-between align-items-center">

        <h2>Editar Cliente</h2>

        <a
            href="index.php?page=clientes"
            class="btn btn-secondary"
        >
            ← Volver a Clientes
        </a>

    </div>

    <hr>


    <!-- FORMULARIO -->

    <form
        action="index.php?page=actualizarCliente"
        method="POST"
    >

        <!-- ID OCULTO -->

        <input
            type="hidden"
            name="id_cliente"
            value="<?= htmlspecialchars($datos['id_cliente']); ?>"
        >


        <div class="row">


            <!-- EMPRESA -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Empresa
                </label>

                <input
                    type="number"
                    name="id_empresa"
                    class="form-control"
                    min="1"
                    value="<?= htmlspecialchars($datos['id_empresa']); ?>"
                    required
                >

            </div>


            <!-- TIPO DOCUMENTO -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Tipo de Documento
                </label>

                <select
                    name="tipo_documento_cliente"
                    class="form-select"
                    required
                >

                    <option value="CC"
                        <?= ($datos['tipo_documento_cliente'] == 'CC') ? 'selected' : ''; ?>>
                        Cédula de Ciudadanía
                    </option>

                    <option value="TI"
                        <?= ($datos['tipo_documento_cliente'] == 'TI') ? 'selected' : ''; ?>>
                        Tarjeta de Identidad
                    </option>

                    <option value="CE"
                        <?= ($datos['tipo_documento_cliente'] == 'CE') ? 'selected' : ''; ?>>
                        Cédula de Extranjería
                    </option>

                    <option value="PASAPORTE"
                        <?= ($datos['tipo_documento_cliente'] == 'PASAPORTE') ? 'selected' : ''; ?>>
                        Pasaporte
                    </option>

                    <option value="NIT"
                        <?= ($datos['tipo_documento_cliente'] == 'NIT') ? 'selected' : ''; ?>>
                        NIT
                    </option>

                </select>

            </div>


            <!-- DOCUMENTO -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Documento
                </label>

                <input
                    type="text"
                    name="documento_cliente"
                    class="form-control"
                    maxlength="20"
                    value="<?= htmlspecialchars($datos['documento_cliente']); ?>"
                    required
                >

            </div>


            <!-- NOMBRES -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nombres
                </label>

                <input
                    type="text"
                    name="nombres_cliente"
                    class="form-control"
                    maxlength="100"
                    value="<?= htmlspecialchars($datos['nombres_cliente'] ?? ''); ?>"
                >

            </div>


            <!-- APELLIDOS -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Apellidos
                </label>

                <input
                    type="text"
                    name="apellidos_cliente"
                    class="form-control"
                    maxlength="100"
                    value="<?= htmlspecialchars($datos['apellidos_cliente'] ?? ''); ?>"
                >

            </div>


            <!-- CORREO -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    name="correo_cliente"
                    class="form-control"
                    maxlength="150"
                    value="<?= htmlspecialchars($datos['correo_cliente'] ?? ''); ?>"
                >

            </div>


            <!-- TELÉFONO -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Teléfono
                </label>

                <input
                    type="text"
                    name="telefono_cliente"
                    class="form-control"
                    maxlength="20"
                    value="<?= htmlspecialchars($datos['telefono_cliente'] ?? ''); ?>"
                >

            </div>


            <!-- DIRECCIÓN -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Dirección
                </label>

                <input
                    type="text"
                    name="direccion_cliente"
                    class="form-control"
                    maxlength="200"
                    value="<?= htmlspecialchars($datos['direccion_cliente'] ?? ''); ?>"
                >

            </div>


            <!-- CIUDAD -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Ciudad
                </label>

                <input
                    type="text"
                    name="ciudad_cliente"
                    class="form-control"
                    maxlength="100"
                    value="<?= htmlspecialchars($datos['ciudad_cliente'] ?? ''); ?>"
                >

            </div>


            <!-- ESTADO -->

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Estado
                </label>

                <select
                    name="estado_cliente"
                    class="form-select"
                >

                    <option value="Activo"
                        <?= ($datos['estado_cliente'] == 'Activo') ? 'selected' : ''; ?>>
                        Activo
                    </option>

                    <option value="Inactivo"
                        <?= ($datos['estado_cliente'] == 'Inactivo') ? 'selected' : ''; ?>>
                        Inactivo
                    </option>

                </select>

            </div>


            <!-- OBSERVACIÓN -->

            <div class="col-md-12 mb-3">

                <label class="form-label">
                    Observación
                </label>

                <textarea
                    name="observacion_cliente"
                    class="form-control"
                    rows="4"
                ><?= htmlspecialchars($datos['observacion_cliente'] ?? ''); ?></textarea>

            </div>

        </div>


        <hr>


        <!-- BOTONES -->

        <button
            type="submit"
            class="btn btn-primary"
        >
            Actualizar Cliente
        </button>

        <a
            href="index.php?page=clientes"
            class="btn btn-secondary"
        >
            Cancelar
        </a>

    </form>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>