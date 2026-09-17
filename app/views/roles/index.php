<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/helpers/csrf.php";
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

.encabezado-roles {
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

.encabezado-roles h2 {
    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}

.encabezado-roles p {
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
   SECCIONES
   ========================================================= */

.seccion-roles {
    background-color: var(--blanco);

    border-radius: 15px;

    padding: 25px;

    margin-top: 25px;

    box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
}

.seccion-roles h4 {
    color: var(--azul-rey);

    font-weight: 700;

    margin-bottom: 5px;
}

.descripcion-seccion {
    color: #6C757D;

    margin-bottom: 20px;
}

/* =========================================================
   CAMPOS DEL FORMULARIO
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
   BOTÓN GUARDAR ROL
   ========================================================= */

.btn-guardar-rol {
    background-color: var(--amarillo-girasol);

    border: 2px solid var(--amarillo-girasol);

    color: #171717;

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 20px;

    transition: all 0.2s ease;
}

.btn-guardar-rol:hover {
    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow: 0 5px 12px rgba(23, 70, 162, 0.25);
}

/* =========================================================
   TABLA
   ========================================================= */

.tabla-roles {
    border-collapse: separate;

    border-spacing: 0;

    overflow: hidden;

    border-radius: 12px;

    margin-bottom: 0;
}

.tabla-roles thead th {
    background: var(--azul-rey);

    color: var(--blanco);

    border: none;

    padding: 14px 10px;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

    vertical-align: middle;
}

.tabla-roles thead th:first-child {
    border-top-left-radius: 10px;
}

.tabla-roles thead th:last-child {
    border-top-right-radius: 10px;
}

.tabla-roles tbody tr {
    transition: all 0.2s ease;

    background-color: var(--blanco);
}

.tabla-roles tbody tr:hover {
    background-color: var(--azul-claro);

    transform: scale(1.001);
}

.tabla-roles tbody td {
    vertical-align: middle;

    padding: 12px 10px;

    border-color: var(--gris-borde);

    color: var(--texto);

    font-size: 14px;
}

/* =========================================================
   DATOS DESTACADOS
   ========================================================= */

.columna-id {
    color: var(--azul-rey);

    font-weight: 700;
}

.nombre-rol {
    color: var(--azul-rey);

    font-weight: 700;
}

/* =========================================================
   ESTADOS
   ========================================================= */

.estado-activo {
    display: inline-block;

    background-color: #DFF6E4;

    color: #176B2C;

    padding: 7px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 700;
}

.estado-inactivo {
    display: inline-block;

    background-color: #FDE2E2;

    color: #A61B1B;

    padding: 7px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 700;
}

/* =========================================================
   BOTÓN EDITAR
   ========================================================= */

.btn-editar {
    background-color: var(--amarillo-girasol);

    border: 1px solid var(--amarillo-girasol);

    color: #161616;

    font-weight: 600;

    border-radius: 7px;

    margin-bottom: 4px;

    transition: 0.2s;
}

.btn-editar:hover {
    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);
}

/* =========================================================
   BOTÓN ELIMINAR
   ========================================================= */

.btn-eliminar {
    background-color: #DC3545;

    border: 1px solid #DC3545;

    color: var(--blanco);

    font-weight: 600;

    border-radius: 7px;

    transition: 0.2s;
}

.btn-eliminar:hover {
    background-color: #B02A37;

    border-color: #B02A37;

    color: var(--blanco);
}

/* =========================================================
   ALERTAS
   ========================================================= */

.alert {
    border-radius: 10px;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .roles-container {
        padding: 15px;
    }

    .encabezado-roles {
        padding: 20px;
    }

    .encabezado-roles h2 {
        font-size: 22px;
    }

    .btn-volver {
        margin-top: 15px;

        width: 100%;
    }

    .seccion-roles {
        padding: 18px;
    }

}

</style>


<div class="container-fluid roles-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-roles">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    🛡️ Gestión de Roles
                </h2>

                <p>
                    Administra los roles, permisos y estados de acceso de los usuarios en SIAFE.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=dashboard"
                    class="btn btn-volver"
                >
                    ← Volver al Menú
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LÍNEA SIAFE
         ===================================================== -->

    <div class="linea-siafe"></div>


    <!-- =====================================================
         MENSAJES
         ===================================================== -->

    <?php if (isset($_SESSION["mensaje"])): ?>

        <div class="alert alert-<?= $_SESSION["tipo_mensaje"] === "success" ? "success" : "danger"; ?> alert-dismissible fade show">

            <?= htmlspecialchars($_SESSION["mensaje"]); ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Cerrar"
            ></button>

        </div>

        <?php

        unset($_SESSION["mensaje"]);
        unset($_SESSION["tipo_mensaje"]);

        ?>

    <?php endif; ?>


    <!-- =====================================================
         FORMULARIO CREAR ROL
         ===================================================== -->

    <div class="seccion-roles">

        <h4>
            ➕ Crear nuevo rol
        </h4>

        <p class="descripcion-seccion">
            Registra un nuevo rol para administrar los niveles de acceso en SIAFE.
        </p>


        <form
            action="index.php?page=guardarRol"
            method="POST"
        >

            <div class="mb-3">

                <label class="form-label">
                    Nombre del Rol
                </label>

                <input
                    type="text"
                    name="nombre_rol"
                    class="form-control"
                    maxlength="50"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Descripción
                </label>

                <textarea
                    name="descripcion_rol"
                    class="form-control"
                    maxlength="255"
                    rows="3"
                ></textarea>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Estado
                </label>

                <select
                    name="estado_rol"
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


            <button
                type="submit"
                class="btn btn-guardar-rol"
            >
                ✓ Guardar Rol
            </button>

        </form>

    </div>


    <!-- =====================================================
         TOKEN CSRF
         ===================================================== -->

    <?php $csrfToken = generarTokenCSRF(); ?>


    <!-- =====================================================
         LISTADO DE ROLES
         ===================================================== -->

    <div class="seccion-roles">

        <div class="mb-4">

            <h4>
                📋 Roles registrados
            </h4>

            <small class="text-muted">
                Listado de roles configurados actualmente en SIAFE
            </small>

        </div>


        <div class="table-responsive">

            <table class="table tabla-roles table-hover">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Rol</th>

                        <th>Descripción</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($roles as $rol): ?>

                        <tr>

                            <!-- ID -->

                            <td class="columna-id">

                                <?= htmlspecialchars(
                                    $rol["id_rol"]
                                ); ?>

                            </td>


                            <!-- ROL -->

                            <td class="nombre-rol">

                                <?= htmlspecialchars(
                                    $rol["nombre_rol"]
                                ); ?>

                            </td>


                            <!-- DESCRIPCIÓN -->

                            <td>

                                <?= htmlspecialchars(
                                    $rol["descripcion_rol"] ?? ""
                                ); ?>

                            </td>


                            <!-- ESTADO -->

                            <td>

                                <?php if ($rol["estado_rol"] === "Activo"): ?>

                                    <span class="estado-activo">
                                        Activo
                                    </span>

                                <?php else: ?>

                                    <span class="estado-inactivo">
                                        <?= htmlspecialchars(
                                            $rol["estado_rol"]
                                        ); ?>
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- ACCIONES -->

                            <td>

                                <div class="d-flex flex-column gap-1">

                                    <a
                                        href="index.php?page=editarRol&id=<?= $rol["id_rol"]; ?>"
                                        class="btn btn-warning btn-sm btn-editar"
                                    >
                                        ✏️ Editar
                                    </a>


                                    <form
                                        action="index.php?page=eliminarRol"
                                        method="POST"
                                        onsubmit="return confirm('¿Está seguro de eliminar este rol?');"
                                    >

                                        <input
                                            type="hidden"
                                            name="id_rol"
                                            value="<?= $rol["id_rol"]; ?>"
                                        >


                                        <input
                                            type="hidden"
                                            name="csrf_token"
                                            value="<?= htmlspecialchars($csrfToken); ?>"
                                        >


                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm btn-eliminar w-100"
                                        >
                                            🗑️ Eliminar
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>