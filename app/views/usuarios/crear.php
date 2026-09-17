<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<style>

/* =========================================================
   COLORES SIAFE
   ========================================================= */

:root {
    --azul-rey: #1746A2;
    --azul-rey-oscuro: #10357D;
    --azul-claro: #EAF1FF;
    --amarillo-girasol: #F9C80E;
    --amarillo-oscuro: #D9A900;
    --blanco: #FFFFFF;
    --gris-fondo: #F5F7FB;
    --gris-borde: #DDE3EE;
    --texto: #263238;
}

/* =========================================================
   FONDO
   ========================================================= */

body {
    background-color: var(--gris-fondo);
}

/* =========================================================
   CONTENEDOR
   ========================================================= */

.usuarios-container {
    padding: 25px;
}

/* =========================================================
   ENCABEZADO
   ========================================================= */

.encabezado-usuario {
    background: linear-gradient(
        135deg,
        var(--azul-rey),
        var(--azul-rey-oscuro)
    );

    color: var(--blanco);

    border-radius: 15px;

    padding: 25px 30px;

    margin-bottom: 25px;

    box-shadow: 0 8px 20px rgba(23, 70, 162, 0.20);
}

.encabezado-usuario h2 {
    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}

.encabezado-usuario p {
    margin-top: 6px;

    margin-bottom: 0;

    color: #E5ECFF;
}

/* =========================================================
   BOTÓN VOLVER
   ========================================================= */

.btn-volver {
    background-color: var(--blanco);

    color: var(--azul-rey);

    border: none;

    font-weight: 600;

    border-radius: 9px;

    padding: 10px 18px;

    transition: 0.2s;
}

.btn-volver:hover {
    background-color: var(--amarillo-girasol);

    color: #000;

    transform: translateY(-2px);
}

/* =========================================================
   LÍNEA SIAFE
   ========================================================= */

.linea-siafe {
    height: 5px;

    width: 100%;

    background: linear-gradient(
        90deg,
        var(--azul-rey) 0%,
        var(--azul-rey) 65%,
        var(--amarillo-girasol) 65%,
        var(--amarillo-girasol) 100%
    );

    border-radius: 10px;

    margin-bottom: 20px;
}

/* =========================================================
   SECCIÓN FORMULARIO
   ========================================================= */

.seccion-formulario {
    background-color: var(--blanco);

    border-radius: 15px;

    padding: 25px;

    margin-top: 25px;

    box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
}

.seccion-formulario h4 {
    color: var(--azul-rey);

    font-weight: 700;

    margin-bottom: 5px;
}

.descripcion-formulario {
    color: #6C757D;

    margin-bottom: 25px;
}

/* =========================================================
   CAMPOS
   ========================================================= */

.form-label {
    color: var(--texto);

    font-weight: 600;

    margin-bottom: 7px;
}

.form-control,
.form-select {
    border: 1px solid var(--gris-borde);

    border-radius: 9px;

    padding: 10px 12px;

    color: var(--texto);

    transition: all 0.2s ease;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--azul-rey);

    box-shadow: 0 0 0 0.2rem rgba(23, 70, 162, 0.12);
}

textarea.form-control {
    resize: vertical;

    min-height: 110px;
}

/* =========================================================
   AYUDA CONTRASEÑA
   ========================================================= */

.ayuda-password {
    color: #6C757D;

    display: block;

    margin-top: 5px;

    font-size: 13px;
}

/* =========================================================
   SEPARADOR
   ========================================================= */

.separador-formulario {
    border: 0;

    border-top: 1px solid var(--gris-borde);

    margin: 10px 0 25px;
}

/* =========================================================
   BOTÓN GUARDAR
   ========================================================= */

.btn-guardar-usuario {
    background-color: var(--amarillo-girasol);

    border: 2px solid var(--amarillo-girasol);

    color: #171717;

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 20px;

    transition: all 0.2s ease;
}

.btn-guardar-usuario:hover {
    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow: 0 5px 12px rgba(23, 70, 162, 0.25);
}

/* =========================================================
   BOTÓN CANCELAR
   ========================================================= */

.btn-cancelar {
    background-color: var(--blanco);

    border: 1px solid var(--gris-borde);

    color: #495057;

    font-weight: 600;

    border-radius: 9px;

    padding: 10px 20px;

    transition: all 0.2s ease;
}

.btn-cancelar:hover {
    background-color: var(--azul-claro);

    border-color: var(--azul-rey);

    color: var(--azul-rey);

    transform: translateY(-2px);
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .usuarios-container {
        padding: 15px;
    }

    .encabezado-usuario {
        padding: 20px;
    }

    .encabezado-usuario h2 {
        font-size: 22px;
    }

    .btn-volver {
        margin-top: 15px;

        width: 100%;
    }

    .seccion-formulario {
        padding: 18px;
    }

    .btn-guardar-usuario,
    .btn-cancelar {
        width: 100%;

        margin-bottom: 8px;
    }

}

</style>


<div class="container-fluid usuarios-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-usuario">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    👤 Crear Usuario
                </h2>

                <p>
                    Registra un nuevo usuario y configura sus datos de acceso, rol y estado.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=usuarios"
                    class="btn btn-volver"
                >
                    ← Volver a Usuarios
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LÍNEA SIAFE
         ===================================================== -->

    <div class="linea-siafe"></div>


    <!-- =====================================================
         FORMULARIO
         ===================================================== -->

    <div class="seccion-formulario">

        <h4>
            👤 Información del usuario
        </h4>

        <p class="descripcion-formulario">
            Completa la información para registrar el nuevo usuario en SIAFE.
        </p>


        <form
            action="index.php?page=guardarUsuario"
            method="POST"
        >

            <div class="row">

                <!-- NOMBRE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre_usuario"
                        class="form-control"
                        maxlength="100"
                        required
                    >

                </div>


                <!-- APELLIDO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Apellido
                    </label>

                    <input
                        type="text"
                        name="apellido_usuario"
                        class="form-control"
                        maxlength="100"
                        required
                    >

                </div>


                <!-- TIPO DOCUMENTO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Tipo de documento
                    </label>

                    <select
                        name="tipo_documento_usuario"
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


                <!-- NUMERO DOCUMENTO -->

                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Número de documento
                    </label>

                    <input
                        type="text"
                        name="numero_documento_usuario"
                        class="form-control"
                        maxlength="20"
                        required
                    >

                </div>


                <!-- CORREO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="correo_usuario"
                        class="form-control"
                        maxlength="120"
                        required
                    >

                </div>


                <!-- TELEFONO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono_usuario"
                        class="form-control"
                        maxlength="20"
                    >

                </div>


                <!-- DIRECCION -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Dirección
                    </label>

                    <input
                        type="text"
                        name="direccion_usuario"
                        class="form-control"
                        maxlength="200"
                    >

                </div>


                <!-- USUARIO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nombre de usuario
                    </label>

                    <input
                        type="text"
                        name="usuario"
                        class="form-control"
                        maxlength="50"
                        required
                    >

                </div>


                <!-- CONTRASEÑA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        minlength="6"
                        required
                    >

                    <small class="ayuda-password">
                        🔐 Mínimo 6 caracteres.
                    </small>

                </div>


                <!-- ROL -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Rol
                    </label>

                    <select
                        name="id_rol"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione un rol...
                        </option>

                        <?php foreach ($roles as $rol): ?>

                            <option
                                value="<?= htmlspecialchars($rol["id_rol"]); ?>"
                            >

                                <?= htmlspecialchars($rol["nombre_rol"]); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- ESTADO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Estado
                    </label>

                    <select
                        name="estado_usuario"
                        class="form-select"
                        required
                    >

                        <option value="Activo">
                            Activo
                        </option>

                        <option value="Inactivo">
                            Inactivo
                        </option>

                    </select>

                </div>


                <!-- OBSERVACIONES -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Observaciones
                    </label>

                    <textarea
                        name="observaciones"
                        class="form-control"
                        rows="4"
                    ></textarea>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- BOTONES -->

            <div class="d-flex gap-2 flex-wrap">

                <button
                    type="submit"
                    class="btn btn-guardar-usuario"
                >
                    ✓ Guardar Usuario
                </button>


                <a
                    href="index.php?page=usuarios"
                    class="btn btn-cancelar"
                >
                    ✕ Cancelar
                </a>

            </div>

        </form>

    </div>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>