<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<style>

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

    body {
        background-color: var(--gris-fondo);
    }

    .ingresos-container {
        padding: 25px;
    }

    /* ================================
       ENCABEZADO
    ================================= */

    .encabezado-ingresos {
        background: linear-gradient(
            135deg,
            var(--azul-rey),
            var(--azul-rey-oscuro)
        );

        color: var(--blanco);
        padding: 25px 30px;
        border-radius: 15px;
        margin-bottom: 0;
        box-shadow: 0 5px 15px rgba(16, 53, 125, 0.18);
    }

    .encabezado-ingresos h2 {
        margin: 0;
        font-weight: 700;
        font-size: 28px;
    }

    .encabezado-ingresos p {
        margin: 8px 0 0;
        opacity: 0.9;
        font-size: 15px;
    }

    /* ================================
       BOTÓN VOLVER
    ================================= */

    .btn-volver {
        background-color: var(--blanco);
        color: var(--azul-rey);
        border: none;
        font-weight: 600;
        border-radius: 9px;
        padding: 10px 18px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .btn-volver:hover {
        background-color: var(--amarillo-girasol);
        color: #000;
        transform: translateY(-1px);
    }

    /* ================================
       LÍNEA SIAFE
    ================================= */

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

    /* ================================
       SECCIÓN PRINCIPAL
    ================================= */

    .seccion-ingresos {
        background-color: var(--blanco);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    }

    .titulo-seccion {
        color: var(--azul-rey);
        font-weight: 700;
        margin: 0;
        font-size: 22px;
    }

    .subtitulo-seccion {
        color: #6c757d;
        margin: 5px 0 0;
        font-size: 14px;
    }

    /* ================================
       BOTÓN NUEVO INGRESO
    ================================= */

    .btn-nuevo-ingreso {
        background-color: var(--amarillo-girasol);
        color: #000;
        border: none;
        font-weight: 700;
        border-radius: 9px;
        padding: 11px 20px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .btn-nuevo-ingreso:hover {
        background-color: var(--azul-rey);
        color: var(--blanco);
        transform: translateY(-1px);
    }

    /* ================================
       TABLA
    ================================= */

    .tabla-ingresos {
        width: 100%;
        margin-top: 20px;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid var(--gris-borde);
    }

    .tabla-ingresos thead th {
        background-color: var(--azul-rey);
        color: var(--blanco);
        border: none;
        padding: 14px 12px;
        font-size: 14px;
        font-weight: 600;
        vertical-align: middle;
        white-space: nowrap;
    }

    .tabla-ingresos tbody td {
        padding: 13px 12px;
        vertical-align: middle;
        border-color: var(--gris-borde);
        color: var(--texto);
        font-size: 14px;
    }

    .tabla-ingresos tbody tr {
        background-color: var(--blanco);
        transition: background-color 0.2s ease;
    }

    .tabla-ingresos tbody tr:hover {
        background-color: var(--azul-claro);
    }

    /* ================================
       COLUMNAS
    ================================= */

    .columna-id {
        color: var(--azul-rey);
        font-weight: 700;
        text-align: center;
    }

    .empresa-ingreso {
        font-weight: 600;
        color: var(--azul-rey-oscuro);
    }

    .categoria-ingreso {
        font-weight: 500;
    }

    .valor-ingreso {
        color: #198754;
        font-weight: 700;
        white-space: nowrap;
    }

    .descripcion-ingreso {
        max-width: 220px;
        color: #5f6368;
    }

    .metodo-pago-ingreso {
        font-weight: 500;
    }

    .fecha-ingreso {
        white-space: nowrap;
        color: #5f6368;
    }

    /* ================================
       ESTADOS
    ================================= */

    .badge-estado {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-activo {
        background-color: #D1F7E3;
        color: #137333;
    }

    .badge-anulado {
        background-color: #FDE2E2;
        color: #B42318;
    }

    /* ================================
       ACCIONES
    ================================= */

    .acciones-ingreso {
        white-space: nowrap;
    }

    .btn-editar-ingreso {
        background-color: var(--amarillo-girasol);
        color: #000;
        border: none;
        border-radius: 7px;
        padding: 7px 12px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-right: 4px;
        transition: all 0.2s ease;
    }

    .btn-editar-ingreso:hover {
        background-color: var(--amarillo-oscuro);
        color: #000;
    }

    .btn-eliminar-ingreso {
        background-color: #DC3545;
        color: var(--blanco);
        border: none;
        border-radius: 7px;
        padding: 7px 12px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .btn-eliminar-ingreso:hover {
        background-color: #B02A37;
        color: var(--blanco);
    }

    /* ================================
       SIN INGRESOS
    ================================= */

    .sin-ingresos {
        padding: 35px !important;
        text-align: center;
        color: #6c757d;
        font-size: 15px;
    }

    /* ================================
       RESPONSIVE
    ================================= */

    @media (max-width: 768px) {

        .ingresos-container {
            padding: 15px;
        }

        .encabezado-ingresos {
            padding: 20px;
        }

        .encabezado-ingresos h2 {
            font-size: 23px;
        }

        .seccion-ingresos {
            padding: 18px;
        }

        .titulo-seccion {
            font-size: 19px;
        }

        .btn-nuevo-ingreso {
            margin-top: 15px;
        }

        .tabla-ingresos {
            font-size: 13px;
        }

        .tabla-ingresos thead th,
        .tabla-ingresos tbody td {
            padding: 10px 8px;
        }
    }

</style>


<div class="container-fluid ingresos-container">

    <!-- ENCABEZADO -->
    <div class="encabezado-ingresos">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>💰 Gestión de Ingresos</h2>

                <p>
                    Administra y consulta los ingresos registrados de tu empresa.
                </p>

            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">

                <a
                    href="index.php?page=dashboard"
                    class="btn-volver"
                >
                    ← Volver al Menú
                </a>

            </div>

        </div>

    </div>


    <div class="linea-siafe"></div>


    <!-- SECCIÓN PRINCIPAL -->
    <div class="seccion-ingresos">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="titulo-seccion">
                    Ingresos registrados
                </h4>

                <p class="subtitulo-seccion">
                    Consulta, edita o elimina los ingresos registrados en el sistema.
                </p>

            </div>

            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=crearIngreso"
                    class="btn-nuevo-ingreso"
                >
                    + Nuevo Ingreso
                </a>

            </div>

        </div>


        <!-- TABLA -->

        <div class="table-responsive">

            <table class="table tabla-ingresos align-middle">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Empresa</th>

                        <th>Categoría</th>

                        <th>Valor</th>

                        <th>Descripción</th>

                        <th>Método de pago</th>

                        <th>Fecha</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (!empty($ingresos)): ?>

                        <?php foreach ($ingresos as $ingreso): ?>

                            <tr>

                                <!-- ID -->
                                <td class="columna-id">

                                    <?= htmlspecialchars(
                                        $ingreso["id_ingreso"]
                                    ); ?>

                                </td>


                                <!-- EMPRESA -->
                                <td class="empresa-ingreso">

                                    <?= htmlspecialchars(
                                        $ingreso["razon_social_empresa"]
                                    ); ?>

                                </td>


                                <!-- CATEGORÍA -->
                                <td class="categoria-ingreso">

                                    <?= htmlspecialchars(
                                        $ingreso["nombre_categoria_ingreso"]
                                    ); ?>

                                </td>


                                <!-- VALOR -->
                                <td class="valor-ingreso">

                                    $<?= number_format(
                                        $ingreso["valor_ingreso"],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- DESCRIPCIÓN -->
                                <td class="descripcion-ingreso">

                                    <?= htmlspecialchars(
                                        $ingreso["descripcion_ingreso"]
                                    ); ?>

                                </td>


                                <!-- MÉTODO DE PAGO -->
                                <td class="metodo-pago-ingreso">

                                    <?= htmlspecialchars(
                                        $ingreso["metodo_pago_ingreso"]
                                    ); ?>

                                </td>


                                <!-- FECHA -->
                                <td class="fecha-ingreso">

                                    <?= htmlspecialchars(
                                        $ingreso["fecha_ingreso"] ?? ""
                                    ); ?>

                                </td>


                                <!-- ESTADO -->
                                <td>

                                    <?php if (
                                        $ingreso["estado_ingreso"] === "Activo"
                                    ): ?>

                                        <span class="badge-estado badge-activo">
                                            Activo
                                        </span>

                                    <?php else: ?>

                                        <span class="badge-estado badge-anulado">
                                            Anulado
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- ACCIONES -->
                                <td class="acciones-ingreso">

                                    <a
                                        href="index.php?page=editarIngreso&id=<?= $ingreso["id_ingreso"]; ?>"
                                        class="btn-editar-ingreso"
                                    >
                                        Editar
                                    </a>


                                    <a
                                        href="index.php?page=eliminarIngreso&id=<?= $ingreso["id_ingreso"]; ?>"
                                        class="btn-eliminar-ingreso"
                                        onclick="return confirm('¿Está seguro de eliminar este ingreso?');"
                                    >
                                        Eliminar
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="9"
                                class="sin-ingresos"
                            >
                                No hay ingresos registrados.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<?php

require_once "app/views/layouts/footer.php";

?>