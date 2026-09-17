<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<div class="container mt-4">

    <!-- ENCABEZADO -->

    <div class="d-flex justify-content-between align-items-center">

        <h2>Registrar Cliente</h2>

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
        action="index.php?page=guardarCliente"
        method="POST"
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
                    required
                    placeholder="ID de la empresa"
                >

                <div class="form-text">
                    Escribe el ID de la empresa a la que pertenece el cliente.
                </div>

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

                    <option value="">
                        Seleccione...
                    </option>

                    <option value="CC">
                        Cédula de Ciudadanía
                    </option>

                    <option value="TI">
                        Tarjeta de Identidad
                    </option>

                    <option value="CE">
                        Cédula de Extranjería
                    </option>

                    <option value="PASAPORTE">
                        Pasaporte
                    </option>

                    <option value="NIT">
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
                    required
                    placeholder="Número de documento"
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
                    placeholder="Nombres del cliente"
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
                    placeholder="Apellidos del cliente"
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
                    placeholder="correo@ejemplo.com"
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
                    placeholder="Número de teléfono"
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
                    placeholder="Dirección"
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
                    placeholder="Ciudad"
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

                    <option value="Activo">
                        Activo
                    </option>

                    <option value="Inactivo">
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
                    placeholder="Observaciones del cliente"
                ></textarea>

            </div>

        </div>


        <hr>


        <!-- BOTONES -->

        <button
            type="submit"
            class="btn btn-success"
        >
            Guardar Cliente
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