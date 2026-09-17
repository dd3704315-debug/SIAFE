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

.roles-container {
    padding: 25px;
}

/* =========================================================
   ENCABEZADO
   ========================================================= */

.encabezado-rol {
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

.encabezado-rol h2 {
    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}

.encabezado-rol p {
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
   FORMULARIO
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
}

/* =========================================================
   SEPARADOR
   ========================================================= */

.separador-formulario {
    border: 0;

    border-top: 1px solid var(--gris-borde);

    margin: 25px 0;
}

/* =========================================================
   BOTÓN ACTUALIZAR
   ========================================================= */

.btn-actualizar-rol {
    background-color: var(--amarillo-girasol);

    border: 2px solid var(--amarillo-girasol);

    color: #171717;

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 20px;

    transition: all 0.2s ease;
}

.btn-actualizar-rol:hover {
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

    .roles-container {
        padding: 15px;
    }

    .encabezado-rol {
        padding: 20px;
    }

    .encabezado-rol h2 {
        font-size: 22px;
    }

    .btn-volver {
        margin-top: 15px;

        width: 100%;
    }

    .seccion-formulario {
        padding: 18px;
    }

    .btn-actualizar-rol,
    .btn-cancelar {
        width: 100%;

        margin-bottom: 8px;
    }

}

</style>


<div class="container-fluid roles-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-rol">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    ✏️ Editar Rol
                </h2>

                <p>
                    Actualiza el nombre, descripción y estado del rol seleccionado.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=roles"
                    class="btn btn-volver"
                >
                    ← Volver a Roles
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
            🛡️ Información del rol
        </h4>

        <p class="descripcion-formulario">
            Modifica la información registrada para este rol en SIAFE.
        </p>


        <form
            action="index.php?page=actualizarRol"
            method="POST"
        >

            <!-- ID DEL ROL -->

            <input
                type="hidden"
                name="id_rol"
                value="<?= htmlspecialchars($datos['id_rol']); ?>"
            >


            <!-- NOMBRE -->

            <div class="mb-3">

                <label class="form-label">
                    Nombre del Rol
                </label>

                <input
                    type="text"
                    name="nombre_rol"
                    class="form-control"
                    value="<?= htmlspecialchars($datos['nombre_rol']); ?>"
                    maxlength="50"
                    required
                >

            </div>


            <!-- DESCRIPCIÓN -->

            <div class="mb-3">

                <label class="form-label">
                    Descripción
                </label>

                <textarea
                    name="descripcion_rol"
                    class="form-control"
                    maxlength="255"
                    rows="4"
                ><?= htmlspecialchars($datos['descripcion_rol'] ?? ""); ?></textarea>

            </div>


            <!-- ESTADO -->

            <div class="mb-3">

                <label class="form-label">
                    Estado
                </label>

                <select
                    name="estado_rol"
                    class="form-select"
                    required
                >

                    <option
                        value="Activo"
                        <?= $datos['estado_rol'] === 'Activo' ? 'selected' : ''; ?>
                    >
                        Activo
                    </option>

                    <option
                        value="Inactivo"
                        <?= $datos['estado_rol'] === 'Inactivo' ? 'selected' : ''; ?>
                    >
                        Inactivo
                    </option>

                </select>

            </div>


            <hr class="separador-formulario">


            <!-- BOTONES -->

            <div class="d-flex gap-2 flex-wrap">

                <button
                    type="submit"
                    class="btn btn-actualizar-rol"
                >
                    ✓ Actualizar Rol
                </button>


                <a
                    href="index.php?page=roles"
                    class="btn btn-cancelar"
                >
                    ✕ Cancelar
                </a>

            </div>

        </form>

    </div>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>