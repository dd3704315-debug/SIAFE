<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<style>

    /* =====================================================
       ESTILO GENERAL SIAFE
    ===================================================== */

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
        --gris-texto: #687385;
        --rojo: #DC3545;
    }

    body {
        background-color: var(--gris-fondo);
        color: var(--texto);
    }

    /* =====================================================
       CONTENEDOR
    ===================================================== */

    .presupuestos-container {
        padding: 25px;
    }

    /* =====================================================
       ENCABEZADO
    ===================================================== */

    .encabezado-presupuestos {
        background: linear-gradient(
            135deg,
            var(--azul-rey),
            var(--azul-rey-oscuro)
        );

        color: var(--blanco);
        border-radius: 15px;
        padding: 25px 30px;
        margin-bottom: 20px;

        box-shadow: 0 6px 18px rgba(23, 70, 162, 0.18);
    }

    .encabezado-presupuestos h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
    }

    .encabezado-presupuestos p {
        margin: 8px 0 0;
        opacity: 0.9;
        font-size: 15px;
    }

    /* =====================================================
       BOTÓN VOLVER
    ===================================================== */

    .btn-volver {
        background-color: var(--blanco);
        color: var(--azul-rey);
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;

        transition: all 0.2s ease;
    }

    .btn-volver:hover {
        background-color: var(--amarillo-girasol);
        color: #000;
        transform: translateY(-1px);
    }

    /* =====================================================
       LÍNEA SIAFE
    ===================================================== */

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

    /* =====================================================
       SECCIÓN DE PRESUPUESTOS
    ===================================================== */

    .seccion-presupuestos {
        background-color: var(--blanco);
        border-radius: 15px;
        padding: 25px;

        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
    }

    .titulo-seccion {
        margin-bottom: 20px;
    }

    .titulo-seccion h4 {
        color: var(--azul-rey);
        font-weight: 700;
        margin-bottom: 5px;
    }

    .titulo-seccion p {
        color: var(--gris-texto);
        margin: 0;
        font-size: 14px;
    }

    /* =====================================================
       BOTÓN NUEVO PRESUPUESTO
    ===================================================== */

    .btn-nuevo-presupuesto {
        background-color: var(--amarillo-girasol);
        color: #000;
        border: none;

        border-radius: 9px;
        padding: 10px 18px;

        font-weight: 700;
        text-decoration: none;

        display: inline-block;

        transition: all 0.2s ease;
    }

    .btn-nuevo-presupuesto:hover {
        background-color: var(--amarillo-oscuro);
        color: #000;
        transform: translateY(-1px);
    }

    /* =====================================================
       TABLA
    ===================================================== */

    .tabla-presupuestos {
        margin-top: 10px;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        overflow: hidden;
    }

    .tabla-presupuestos thead th {
        background-color: var(--azul-rey);
        color: var(--blanco);

        font-weight: 600;
        padding: 13px 12px;

        border: none;
        white-space: nowrap;
    }

    .tabla-presupuestos thead th:first-child {
        border-top-left-radius: 10px;
    }

    .tabla-presupuestos thead th:last-child {
        border-top-right-radius: 10px;
    }

    .tabla-presupuestos tbody td {
        background-color: var(--blanco);
        border-bottom: 1px solid var(--gris-borde);
        padding: 13px 12px;

        vertical-align: middle;
    }

    .tabla-presupuestos tbody tr {
        transition: all 0.2s ease;
    }

    .tabla-presupuestos tbody tr:hover td {
        background-color: var(--azul-claro);
    }

    /* =====================================================
       ID
    ===================================================== */

    .columna-id {
        color: var(--azul-rey);
        font-weight: 700;
    }

    /* =====================================================
       EMPRESA
    ===================================================== */

    .empresa-presupuesto {
        font-weight: 600;
        color: var(--texto);
        min-width: 180px;
    }

    /* =====================================================
       VALORES
    ===================================================== */

    .valor-presupuesto {
        font-weight: 600;
        white-space: nowrap;
    }

    .valor-ingresos {
        color: #176B36;
    }

    .valor-gastos {
        color: #A52834;
    }

    .utilidad-positiva {
        color: #176B36;
        font-weight: 700;
    }

    .utilidad-negativa {
        color: var(--rojo);
        font-weight: 700;
    }

    /* =====================================================
       AÑO Y MES
    ===================================================== */

    .periodo-presupuesto {
        text-align: center;
        font-weight: 600;
    }

    /* =====================================================
       BADGES
    ===================================================== */

    .badge-estado {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-activo {
        background-color: #E8F7EE;
        color: #176B36;
    }

    .badge-finalizado {
        background-color: var(--azul-claro);
        color: var(--azul-rey);
    }

    .badge-cancelado {
        background-color: #FDECEC;
        color: #A52834;
    }

    /* =====================================================
       ACCIONES
    ===================================================== */

    .acciones-presupuesto {
        white-space: nowrap;
    }

    .btn-editar-presupuesto {
        background-color: var(--amarillo-girasol);
        color: #000;
        border: none;

        border-radius: 7px;
        padding: 7px 12px;

        font-size: 13px;
        font-weight: 700;
        text-decoration: none;

        display: inline-block;
        margin-right: 4px;

        transition: all 0.2s ease;
    }

    .btn-editar-presupuesto:hover {
        background-color: var(--amarillo-oscuro);
        color: #000;
    }

    .btn-eliminar-presupuesto {
        background-color: var(--rojo);
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

    .btn-eliminar-presupuesto:hover {
        background-color: #B02A37;
        color: var(--blanco);
    }

    /* =====================================================
       SIN PRESUPUESTOS
    ===================================================== */

    .sin-presupuestos {
        text-align: center;
        padding: 45px 20px !important;
        color: var(--gris-texto);
    }

    .sin-presupuestos-icono {
        font-size: 40px;
        margin-bottom: 10px;
    }

    .sin-presupuestos-texto {
        font-size: 16px;
        font-weight: 600;
        color: var(--texto);
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 768px) {

        .presupuestos-container {
            padding: 15px;
        }

        .encabezado-presupuestos {
            padding: 20px;
        }

        .encabezado-presupuestos h2 {
            font-size: 23px;
        }

        .btn-volver {
            margin-top: 15px;
            width: 100%;
            text-align: center;
        }

        .seccion-presupuestos {
            padding: 18px;
        }

        .titulo-seccion {
            display: block !important;
        }

        .btn-nuevo-presupuesto {
            width: 100%;
            text-align: center;
            margin-top: 15px;
        }

        .tabla-presupuestos {
            font-size: 13px;
        }

        .tabla-presupuestos thead th,
        .tabla-presupuestos tbody td {
            padding: 10px 8px;
        }

    }

</style>


<div class="container-fluid presupuestos-container">

    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="encabezado-presupuestos">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    💰 Gestión de Presupuestos
                </h2>

                <p>
                    Planifica y controla los ingresos, gastos y utilidad
                    estimada de tu empresa en SIAFE.
                </p>

            </div>

            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=dashboard"
                    class="btn-volver"
                >
                    ← Volver al Menú
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LÍNEA SIAFE
    ====================================================== -->

    <div class="linea-siafe"></div>


    <!-- =====================================================
         CONTENIDO
    ====================================================== -->

    <div class="seccion-presupuestos">

        <!-- TÍTULO Y BOTÓN -->

        <div class="titulo-seccion">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h4>
                        📋 Presupuestos registrados
                    </h4>

                    <p>
                        Consulta y administra los presupuestos financieros
                        registrados en SIAFE.
                    </p>

                </div>

                <div class="col-md-4 text-md-end">

                    <a
                        href="index.php?page=crearPresupuesto"
                        class="btn-nuevo-presupuesto"
                    >
                        ＋ Nuevo Presupuesto
                    </a>

                </div>

            </div>

        </div>


        <!-- =================================================
             TABLA
        ================================================== -->

        <div class="table-responsive">

            <table class="tabla-presupuestos">

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Empresa
                        </th>

                        <th>
                            Año
                        </th>

                        <th>
                            Mes
                        </th>

                        <th>
                            Ingresos estimados
                        </th>

                        <th>
                            Gastos estimados
                        </th>

                        <th>
                            Utilidad estimada
                        </th>

                        <th>
                            Estado
                        </th>

                        <th>
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (!empty($presupuestos)): ?>

                        <?php foreach ($presupuestos as $presupuesto): ?>

                            <tr>

                                <!-- ID -->

                                <td class="columna-id">

                                    <?= htmlspecialchars(
                                        $presupuesto["id_presupuesto"]
                                    ); ?>

                                </td>


                                <!-- EMPRESA -->

                                <td class="empresa-presupuesto">

                                    <?= htmlspecialchars(
                                        $presupuesto["razon_social_empresa"]
                                    ); ?>

                                </td>


                                <!-- AÑO -->

                                <td class="periodo-presupuesto">

                                    <?= htmlspecialchars(
                                        $presupuesto["anio_presupuesto"]
                                    ); ?>

                                </td>


                                <!-- MES -->

                                <td class="periodo-presupuesto">

                                    <?= htmlspecialchars(
                                        $presupuesto["mes_presupuesto"]
                                    ); ?>

                                </td>


                                <!-- INGRESOS -->

                                <td class="valor-presupuesto valor-ingresos">

                                    $
                                    <?= number_format(
                                        $presupuesto[
                                            "presupuesto_ingresos_estimado"
                                        ],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- GASTOS -->

                                <td class="valor-presupuesto valor-gastos">

                                    $
                                    <?= number_format(
                                        $presupuesto[
                                            "presupuesto_gastos_estimado"
                                        ],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- UTILIDAD -->

                                <td class="valor-presupuesto">

                                    <?php
                                    $utilidad =
                                        $presupuesto[
                                            "presupuesto_utilidad_estimada"
                                        ];
                                    ?>

                                    <span
                                        class="<?= $utilidad >= 0
                                            ? 'utilidad-positiva'
                                            : 'utilidad-negativa'; ?>"
                                    >

                                        <?= $utilidad >= 0 ? '▲' : '▼'; ?>

                                        $

                                        <?= number_format(
                                            $utilidad,
                                            2,
                                            ",",
                                            "."
                                        ); ?>

                                    </span>

                                </td>


                                <!-- ESTADO -->

                                <td>

                                    <?php

                                    $estado =
                                        $presupuesto[
                                            "estado_presupuesto"
                                        ];

                                    if ($estado === "Activo"):

                                    ?>

                                        <span class="badge-estado badge-activo">
                                            Activo
                                        </span>

                                    <?php elseif ($estado === "Finalizado"): ?>

                                        <span class="badge-estado badge-finalizado">
                                            Finalizado
                                        </span>

                                    <?php else: ?>

                                        <span class="badge-estado badge-cancelado">
                                            Cancelado
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- ACCIONES -->

                                <td class="acciones-presupuesto">

                                    <a
                                        href="index.php?page=editarPresupuesto&id=<?= $presupuesto["id_presupuesto"]; ?>"
                                        class="btn-editar-presupuesto"
                                    >
                                        ✏️ Editar
                                    </a>

                                    <a
                                        href="index.php?page=eliminarPresupuesto&id=<?= $presupuesto["id_presupuesto"]; ?>"
                                        class="btn-eliminar-presupuesto"
                                        onclick="return confirm(
                                            '¿Está seguro de eliminar este presupuesto?'
                                        );"
                                    >
                                        🗑️ Eliminar
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="9"
                                class="sin-presupuestos"
                            >

                                <div class="sin-presupuestos-icono">
                                    💰
                                </div>

                                <div class="sin-presupuestos-texto">
                                    No hay presupuestos registrados.
                                </div>

                                <div>
                                    Crea tu primer presupuesto para comenzar
                                    a planificar las finanzas de la empresa.
                                </div>

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