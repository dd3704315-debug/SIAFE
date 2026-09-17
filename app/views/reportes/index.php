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

.reportes-container {
    padding: 25px;
}

/* =========================================================
   ENCABEZADO
   ========================================================= */

.encabezado-reportes {
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

.encabezado-reportes h2 {
    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}

.encabezado-reportes p {
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
   SECCIÓN REPORTES
   ========================================================= */

.seccion-reportes {
    background-color: var(--blanco);

    border-radius: 15px;

    padding: 20px;

    margin-top: 25px;

    box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
}

.seccion-reportes h4 {
    color: var(--azul-rey);

    font-weight: 700;

    margin: 0;
}

.seccion-reportes small {
    color: #6C757D;
}

/* =========================================================
   BOTÓN NUEVO REPORTE
   ========================================================= */

.btn-nuevo-reporte {
    background-color: var(--amarillo-girasol);

    color: #171717;

    border: 2px solid var(--amarillo-girasol);

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 18px;

    transition: all 0.2s ease;
}

.btn-nuevo-reporte:hover {
    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow: 0 5px 12px rgba(23, 70, 162, 0.25);
}

/* =========================================================
   TABLA
   ========================================================= */

.tabla-reportes {
    border-collapse: separate;

    border-spacing: 0;

    overflow: hidden;

    border-radius: 12px;

    margin-bottom: 0;
}

.tabla-reportes thead th {
    background: var(--azul-rey);

    color: var(--blanco);

    border: none;

    padding: 14px 10px;

    font-size: 13px;

    font-weight: 700;

    white-space: nowrap;

    vertical-align: middle;
}

.tabla-reportes thead th:first-child {
    border-top-left-radius: 10px;
}

.tabla-reportes thead th:last-child {
    border-top-right-radius: 10px;
}

.tabla-reportes tbody tr {
    transition: all 0.2s ease;

    background-color: var(--blanco);
}

.tabla-reportes tbody tr:hover {
    background-color: var(--azul-claro);

    transform: scale(1.001);
}

.tabla-reportes tbody td {
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

.empresa-reporte {
    color: var(--azul-rey);

    font-weight: 700;
}

.tipo-reporte {
    font-weight: 600;
}

.valor-reporte {
    font-weight: 700;

    color: var(--azul-rey);

    white-space: nowrap;
}

.utilidad-positiva {
    color: #198754;

    font-weight: 700;

    white-space: nowrap;
}

.utilidad-negativa {
    color: #DC3545;

    font-weight: 700;

    white-space: nowrap;
}

/* =========================================================
   BADGES
   ========================================================= */

.badge {
    padding: 7px 10px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: 600;
}

.badge-tipo {
    background-color: var(--azul-claro);

    color: var(--azul-rey);
}

.badge-generado {
    background-color: var(--azul-rey);

    color: var(--blanco);
}

.badge-revisado {
    background-color: #198754;

    color: var(--blanco);
}

.badge-archivado {
    background-color: #6C757D;

    color: var(--blanco);
}

/* =========================================================
   BOTONES DE ACCIONES
   ========================================================= */

.btn-editar-reporte {
    background-color: var(--amarillo-girasol);

    border: 1px solid var(--amarillo-girasol);

    color: #161616;

    font-weight: 600;

    border-radius: 7px;

    margin-bottom: 4px;

    transition: all 0.2s ease;
}

.btn-editar-reporte:hover {
    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);
}

.btn-eliminar-reporte {
    background-color: #DC3545;

    border: 1px solid #DC3545;

    color: var(--blanco);

    font-weight: 600;

    border-radius: 7px;

    transition: all 0.2s ease;
}

.btn-eliminar-reporte:hover {
    background-color: #B02A37;

    border-color: #B02A37;

    color: var(--blanco);
}

/* =========================================================
   MENSAJE SIN REPORTES
   ========================================================= */

.sin-reportes {
    padding: 30px !important;

    color: #6C757D !important;

    font-weight: 600;

    background-color: #FAFBFD !important;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .reportes-container {
        padding: 15px;
    }

    .encabezado-reportes {
        padding: 20px;
    }

    .encabezado-reportes h2 {
        font-size: 22px;
    }

    .btn-volver {
        margin-top: 15px;

        width: 100%;
    }

    .seccion-reportes {
        padding: 12px;
    }

    .btn-nuevo-reporte {
        width: 100%;

        margin-top: 15px;
    }

}

</style>


<div class="container-fluid reportes-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-reportes">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    📊 Gestión de Reportes
                </h2>

                <p>
                    Consulta, administra y analiza los reportes financieros generados en SIAFE.
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
         SECCIÓN DE REPORTES
         ===================================================== -->

    <div class="seccion-reportes">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <div>

                <h4>
                    📋 Reportes registrados
                </h4>

                <small>
                    Listado de reportes financieros disponibles en SIAFE
                </small>

            </div>


            <a
                href="index.php?page=crearReporte"
                class="btn btn-nuevo-reporte"
            >
                ＋ Nuevo Reporte
            </a>

        </div>


        <!-- =================================================
             TABLA
             ================================================= -->

        <div class="table-responsive">

            <table class="table tabla-reportes table-hover">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Empresa</th>

                        <th>Tipo</th>

                        <th>Año</th>

                        <th>Mes</th>

                        <th>Ingresos</th>

                        <th>Gastos</th>

                        <th>Utilidad</th>

                        <th>Estado</th>

                        <th>Fecha</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                    <?php if (!empty($reportes)): ?>

                        <?php foreach ($reportes as $reporte): ?>

                            <tr>

                                <!-- ID -->

                                <td class="columna-id">

                                    <?= htmlspecialchars(
                                        $reporte["id_reporte"]
                                    ); ?>

                                </td>


                                <!-- EMPRESA -->

                                <td class="empresa-reporte">

                                    <?= htmlspecialchars(
                                        $reporte[
                                            "razon_social_empresa"
                                        ]
                                    ); ?>

                                </td>


                                <!-- TIPO -->

                                <td class="tipo-reporte">

                                    <?php

                                    $tipo =
                                        $reporte["tipo_reporte"];

                                    ?>

                                    <span class="badge badge-tipo">

                                        <?= htmlspecialchars($tipo); ?>

                                    </span>

                                </td>


                                <!-- AÑO -->

                                <td>

                                    <?= htmlspecialchars(
                                        $reporte["periodo_anio"]
                                    ); ?>

                                </td>


                                <!-- MES -->

                                <td>

                                    <?php

                                    $meses = [
                                        1 => "Enero",
                                        2 => "Febrero",
                                        3 => "Marzo",
                                        4 => "Abril",
                                        5 => "Mayo",
                                        6 => "Junio",
                                        7 => "Julio",
                                        8 => "Agosto",
                                        9 => "Septiembre",
                                        10 => "Octubre",
                                        11 => "Noviembre",
                                        12 => "Diciembre"
                                    ];

                                    $mes =
                                        $reporte["periodo_mes"];

                                    echo $meses[$mes]
                                        ?? "Todos";

                                    ?>

                                </td>


                                <!-- INGRESOS -->

                                <td class="valor-reporte">

                                    $
                                    <?= number_format(
                                        $reporte[
                                            "total_ingresos"
                                        ],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- GASTOS -->

                                <td class="valor-reporte">

                                    $
                                    <?= number_format(
                                        $reporte[
                                            "total_gastos"
                                        ],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- UTILIDAD -->

                                <td>

                                    <?php

                                    $utilidad =
                                        (float)$reporte[
                                            "utilidad"
                                        ];

                                    ?>

                                    <span
                                        class="<?= $utilidad >= 0
                                            ? 'utilidad-positiva'
                                            : 'utilidad-negativa'; ?>"
                                    >

                                        <?= $utilidad >= 0
                                            ? '▲'
                                            : '▼'; ?>

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
                                        $reporte[
                                            "estado_reporte"
                                        ];

                                    if ($estado === "Generado"):

                                    ?>

                                        <span class="badge badge-generado">
                                            Generado
                                        </span>

                                    <?php elseif ($estado === "Revisado"): ?>

                                        <span class="badge badge-revisado">
                                            Revisado
                                        </span>

                                    <?php else: ?>

                                        <span class="badge badge-archivado">
                                            Archivado
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- FECHA -->

                                <td>

                                    <?= htmlspecialchars(
                                        $reporte[
                                            "fecha_generacion"
                                        ]
                                    ); ?>

                                </td>


                                <!-- ACCIONES -->

                                <td>

                                    <a
                                        href="index.php?page=editarReporte&id=<?= $reporte["id_reporte"]; ?>"
                                        class="btn btn-editar-reporte btn-sm"
                                    >
                                        ✏️ Editar
                                    </a>


                                    <a
                                        href="index.php?page=eliminarReporte&id=<?= $reporte["id_reporte"]; ?>"
                                        class="btn btn-eliminar-reporte btn-sm"
                                        onclick="return confirm(
                                            '¿Está seguro de eliminar este reporte?'
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
                                colspan="11"
                                class="text-center sin-reportes"
                            >

                                📄 No hay reportes registrados.

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