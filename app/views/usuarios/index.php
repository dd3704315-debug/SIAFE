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

/* FONDO */

body {
    background-color: var(--gris-fondo);
}

/* CONTENEDOR */

.usuarios-container {
    padding: 25px;
}

/* =========================================================
   ENCABEZADO
   ========================================================= */

.encabezado-usuarios {
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

.encabezado-usuarios h2 {
    margin: 0;
    font-weight: 700;
    letter-spacing: 0.3px;
}

.encabezado-usuarios p {
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
   SECCIÓN USUARIOS
   ========================================================= */

.seccion-usuarios {
    background-color: var(--blanco);

    border-radius: 15px;

    padding: 20px;
    margin-top: 25px;

    box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
}

.seccion-usuarios h4 {
    color: var(--azul-rey);

    font-weight: 700;

    margin: 0;
}

/* =========================================================
   BOTÓN NUEVO USUARIO
   ========================================================= */

.btn-nuevo-usuario {
    background-color: var(--amarillo-girasol);

    color: #171717;

    border: 2px solid var(--amarillo-girasol);

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 18px;

    transition: all 0.2s ease;
}

.btn-nuevo-usuario:hover {
    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow: 0 5px 12px rgba(23, 70, 162, 0.25);
}

/* =========================================================
   TABLA
   ========================================================= */

.tabla-usuarios {
    border-collapse: separate;

    border-spacing: 0;

    overflow: hidden;

    border-radius: 12px;

    margin-bottom: 0;
}

.tabla-usuarios thead th {
    background: var(--azul-rey);

    color: var(--blanco);

    border: none;

    padding: 14px 10px;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

    vertical-align: middle;
}

.tabla-usuarios thead th:first-child {
    border-top-left-radius: 10px;
}

.tabla-usuarios thead th:last-child {
    border-top-right-radius: 10px;
}

.tabla-usuarios tbody tr {
    transition: all 0.2s ease;

    background-color: var(--blanco);
}

.tabla-usuarios tbody tr:hover {
    background-color: var(--azul-claro);

    transform: scale(1.001);
}

.tabla-usuarios tbody td {
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

.nombre-usuario {
    color: var(--azul-rey);

    font-weight: 700;
}

.usuario-login {
    color: var(--azul-rey);

    font-weight: 600;
}

/* =========================================================
   BADGES
   ========================================================= */

.badge {
    padding: 7px 10px;

    border-radius: 20px;

    font-size: 12px;
}

/* =========================================================
   ESTADO
   ========================================================= */

.estado-activo {
    background-color: #DFF6E4;

    color: #176B2C;

    padding: 7px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 700;

    display: inline-block;
}

.estado-inactivo {
    background-color: #FDE2E2;

    color: #A61B1B;

    padding: 7px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 700;

    display: inline-block;
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
   ALERTA SIN USUARIOS
   ========================================================= */

.alert-sin-usuarios {
    background-color: var(--azul-claro);

    color: var(--azul-rey);

    border: none;

    border-left: 6px solid var(--azul-rey);

    border-radius: 10px;

    padding: 20px;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .usuarios-container {
        padding: 15px;
    }

    .encabezado-usuarios {
        padding: 20px;
    }

    .encabezado-usuarios h2 {
        font-size: 22px;
    }

    .btn-volver {
        margin-top: 15px;

        width: 100%;
    }

    .seccion-usuarios {
        padding: 12px;
    }

    .btn-nuevo-usuario {
        padding: 8px 12px;

        font-size: 13px;
    }

}

</style>


<div class="container-fluid usuarios-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-usuarios">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    👥 Gestión de Usuarios
                </h2>

                <p>
                    Administra los usuarios, datos personales, roles y estados de acceso a SIAFE.
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
         SECCIÓN USUARIOS
         ===================================================== -->

    <div class="seccion-usuarios">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4>
                    👥 Usuarios registrados
                </h4>

                <small class="text-muted">
                    Listado de usuarios registrados en SIAFE
                </small>

            </div>


            <a
                href="index.php?page=crearUsuario"
                class="btn btn-nuevo-usuario"
            >
                ＋ Nuevo Usuario
            </a>

        </div>


        <!-- =================================================
             TABLA
             ================================================= -->

        <div class="table-responsive">

            <table class="table tabla-usuarios table-hover">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Nombre</th>

                        <th>Documento</th>

                        <th>Correo</th>

                        <th>Usuario</th>

                        <th>Rol</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($usuarios as $usuario): ?>

                        <tr>

                            <!-- ID -->

                            <td class="columna-id">

                                <?= htmlspecialchars(
                                    $usuario["id_usuario"]
                                ); ?>

                            </td>


                            <!-- NOMBRE -->

                            <td class="nombre-usuario">

                                <?= htmlspecialchars(
                                    $usuario["nombre_usuario"] . " " .
                                    $usuario["apellido_usuario"]
                                ); ?>

                            </td>


                            <!-- DOCUMENTO -->

                            <td>

                                <?= htmlspecialchars(
                                    $usuario["tipo_documento_usuario"] . " " .
                                    $usuario["numero_documento_usuario"]
                                ); ?>

                            </td>


                            <!-- CORREO -->

                            <td>

                                <?= htmlspecialchars(
                                    $usuario["correo_usuario"]
                                ); ?>

                            </td>


                            <!-- USUARIO -->

                            <td class="usuario-login">

                                <?= htmlspecialchars(
                                    $usuario["usuario"]
                                ); ?>

                            </td>


                            <!-- ROL -->

                            <td>

                                <?= htmlspecialchars(
                                    $usuario["nombre_rol"]
                                ); ?>

                            </td>


                            <!-- ESTADO -->

                            <td>

                                <?php if ($usuario["estado_usuario"] === "Activo"): ?>

                                    <span class="estado-activo">
                                        Activo
                                    </span>

                                <?php else: ?>

                                    <span class="estado-inactivo">
                                        <?= htmlspecialchars(
                                            $usuario["estado_usuario"]
                                        ); ?>
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- ACCIONES -->

                            <td>

                                <div class="d-flex flex-column gap-1">

                                    <a
                                        href="index.php?page=editarUsuario&id=<?= $usuario["id_usuario"]; ?>"
                                        class="btn btn-sm btn-editar"
                                    >
                                        ✏️ Editar
                                    </a>


                                    <a
                                        href="index.php?page=eliminarUsuario&id=<?= $usuario["id_usuario"]; ?>"
                                        class="btn btn-sm btn-eliminar"
                                        onclick="return confirm('¿Está seguro de eliminar este usuario?');"
                                    >
                                        🗑️ Eliminar
                                    </a>

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