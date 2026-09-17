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
   FONDO GENERAL
   ========================================================= */

body {
    background-color: var(--gris-fondo);
}


/* =========================================================
   CONTENEDOR
   ========================================================= */

.empresas-container {
    padding: 25px;
}


/* =========================================================
   ENCABEZADO PRINCIPAL
   IGUAL AL DE PRODUCTOS
   ========================================================= */

.encabezado-empresas {

    background: linear-gradient(
        135deg,
        var(--azul-rey),
        var(--azul-rey-oscuro)
    );

    color: var(--blanco);

    border-radius: 15px;

    padding: 25px 30px;

    margin-bottom: 25px;

    box-shadow:
        0 8px 20px rgba(23, 70, 162, 0.20);
}


.encabezado-empresas h2 {

    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}


.encabezado-empresas p {

    margin-top: 6px;

    margin-bottom: 0;

    color: #E5ECFF;
}


/* =========================================================
   BOTÓN VOLVER
   IGUAL AL DE PRODUCTOS
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
   RESTO DE LA PÁGINA
   ========================================================= */

.seccion-empresas {

    background-color: var(--blanco);

    border-radius: 15px;

    padding: 20px;

    margin-top: 25px;

    box-shadow:
        0 5px 18px rgba(0, 0, 0, 0.07);
}


.seccion-empresas h4 {

    color: var(--azul-rey);

    font-weight: 700;

    margin: 0;
}


/* =========================================================
   BOTÓN NUEVA EMPRESA
   ========================================================= */

.btn-nueva-empresa {

    background-color: var(--amarillo-girasol);

    color: #171717;

    border: 2px solid var(--amarillo-girasol);

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 18px;

    transition: all 0.2s ease;
}


.btn-nueva-empresa:hover {

    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow:
        0 5px 12px rgba(23, 70, 162, 0.25);
}


/* =========================================================
   TABLA
   ========================================================= */

.tabla-empresas {

    border-collapse: separate;

    border-spacing: 0;

    overflow: hidden;

    border-radius: 12px;

    margin-bottom: 0;
}


/* =========================================================
   ENCABEZADO TABLA
   ========================================================= */

.tabla-empresas thead th {

    background: var(--azul-rey);

    color: var(--blanco);

    border: none;

    padding: 14px 10px;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

    vertical-align: middle;
}


.tabla-empresas thead th:first-child {

    border-top-left-radius: 10px;
}


.tabla-empresas thead th:last-child {

    border-top-right-radius: 10px;
}


/* =========================================================
   FILAS
   ========================================================= */

.tabla-empresas tbody tr {

    transition: all 0.2s ease;

    background-color: var(--blanco);
}


.tabla-empresas tbody tr:hover {

    background-color: var(--azul-claro);

    transform: scale(1.001);
}


.tabla-empresas tbody td {

    vertical-align: middle;

    padding: 12px 10px;

    border-color: var(--gris-borde);

    color: var(--texto);

    font-size: 14px;
}


/* =========================================================
   ID
   ========================================================= */

.columna-id {

    color: var(--azul-rey);

    font-weight: 700;
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
   BOTÓN EDITAR
   ========================================================= */

.btn-editar {

    background-color: var(--amarillo-girasol);

    border: 1px solid var(--amarillo-girasol);

    color: #161616;

    font-weight: 600;

    border-radius: 7px;

    margin-bottom: 4px;
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
}


.btn-eliminar:hover {

    background-color: #B02A37;

    border-color: #B02A37;

    color: var(--blanco);
}


/* =========================================================
   LÍNEA DECORATIVA SIAFE
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
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .empresas-container {

        padding: 15px;
    }

    .encabezado-empresas {

        padding: 20px;
    }

    .encabezado-empresas h2 {

        font-size: 22px;
    }

    .btn-volver {

        margin-top: 15px;

        width: 100%;
    }

    .seccion-empresas {

        padding: 12px;
    }

}

</style>


<div class="container-fluid empresas-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-empresas">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    🏢 Gestión de Empresas
                </h2>

                <p>
                    Administra la información de las empresas registradas en SIAFE.
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
         EMPRESAS REGISTRADAS
         ===================================================== -->

    <div class="seccion-empresas">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4>
                    🏢 Empresas registradas
                </h4>

                <small class="text-muted">
                    Listado de empresas disponibles en SIAFE
                </small>

            </div>

            <a
                href="index.php?page=crearEmpresa"
                class="btn btn-nueva-empresa"
            >
                ＋ Nueva Empresa
            </a>

        </div>


        <!-- =================================================
             TABLA
             ================================================= -->

        <div class="table-responsive">

            <table class="table tabla-empresas table-hover">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>NIT</th>

                        <th>Razón Social</th>

                        <th>Nombre Comercial</th>

                        <th>Correo</th>

                        <th>Teléfono</th>

                        <th>Ciudad</th>

                        <th>Sector</th>

                        <th>Representante Legal</th>

                        <th>Usuario</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (!empty($empresas)): ?>

                        <?php foreach ($empresas as $empresa): ?>

                            <tr>

                                <td class="columna-id">

                                    <?= htmlspecialchars(
                                        $empresa["id_empresa"]
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["nit_empresa"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <strong>

                                        <?= htmlspecialchars(
                                            $empresa["razon_social_empresa"]
                                        ); ?>

                                    </strong>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["nombre_comercial_empresa"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["correo_empresa"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["telefono_empresa"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["ciudad_empresa"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["sector_economico_empresa"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["representante_legal_empresa"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <?= htmlspecialchars(
                                        $empresa["nombre_usuario"] ?? ""
                                    ); ?>

                                </td>


                                <td>

                                    <?php if (
                                        $empresa["estado_empresa"] === "Activo"
                                    ): ?>

                                        <span class="badge bg-success">
                                            Activo
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            Inactivo
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <td>

                                    <a
                                        href="index.php?page=editarEmpresa&id=<?= $empresa["id_empresa"]; ?>"
                                        class="btn btn-editar btn-sm"
                                    >
                                        Editar
                                    </a>


                                    <a
                                        href="index.php?page=eliminarEmpresa&id=<?= $empresa["id_empresa"]; ?>"
                                        class="btn btn-eliminar btn-sm"
                                        onclick="return confirm('¿Desea eliminar esta empresa?');"
                                    >
                                        Eliminar
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>


                    <?php else: ?>

                        <tr>

                            <td
                                colspan="12"
                                class="text-center"
                            >
                                No hay empresas registradas.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>