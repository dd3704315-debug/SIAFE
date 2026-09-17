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


    /* =====================================================
       FONDO
    ===================================================== */

    body {
        background-color: var(--gris-fondo);
        color: var(--texto);
    }


    /* =====================================================
       CONTENEDOR
    ===================================================== */

    .gastos-container {
        padding: 25px;
    }


    /* =====================================================
       ENCABEZADO
    ===================================================== */

    .encabezado-gastos {

        background: linear-gradient(
            135deg,
            var(--azul-rey),
            var(--azul-rey-oscuro)
        );

        color: var(--blanco);

        border-radius: 15px;

        padding: 25px 30px;

        margin-bottom: 20px;

        box-shadow:
            0 6px 18px rgba(23, 70, 162, 0.18);
    }


    .encabezado-gastos h2 {

        margin: 0;

        font-size: 28px;

        font-weight: 700;
    }


    .encabezado-gastos p {

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
       SECCIÓN PRINCIPAL
    ===================================================== */

    .seccion-gastos {

        background-color: var(--blanco);

        border-radius: 15px;

        padding: 25px;

        box-shadow:
            0 5px 18px rgba(0, 0, 0, 0.06);
    }


    /* =====================================================
       TÍTULO DE SECCIÓN
    ===================================================== */

    .titulo-seccion {

        color: var(--azul-rey);

        font-size: 21px;

        font-weight: 700;

        margin: 0;
    }


    .subtitulo-seccion {

        color: var(--gris-texto);

        font-size: 14px;

        margin-top: 5px;

        margin-bottom: 0;
    }


    /* =====================================================
       BOTÓN NUEVO GASTO
    ===================================================== */

    .btn-nuevo-gasto {

        background-color: var(--amarillo-girasol);

        color: #000;

        border: none;

        border-radius: 9px;

        padding: 11px 18px;

        font-weight: 700;

        text-decoration: none;

        display: inline-block;

        transition: all 0.2s ease;
    }


    .btn-nuevo-gasto:hover {

        background-color: var(--amarillo-oscuro);

        color: #000;

        transform: translateY(-1px);
    }


    /* =====================================================
       TABLA
    ===================================================== */

    .tabla-gastos {

        margin-top: 22px;

        border-collapse: separate;

        border-spacing: 0;

        width: 100%;

        overflow: hidden;

        border: 1px solid var(--gris-borde);

        border-radius: 12px;
    }


    .tabla-gastos thead th {

        background-color: var(--azul-rey);

        color: var(--blanco);

        font-weight: 600;

        padding: 14px 12px;

        border: none;

        white-space: nowrap;
    }


    .tabla-gastos tbody td {

        padding: 13px 12px;

        vertical-align: middle;

        border-top: 1px solid var(--gris-borde);

        background-color: var(--blanco);

        color: var(--texto);
    }


    .tabla-gastos tbody tr {

        transition: all 0.2s ease;
    }


    .tabla-gastos tbody tr:hover td {

        background-color: var(--azul-claro);
    }


    /* =====================================================
       ID
    ===================================================== */

    .columna-id {

        color: var(--azul-rey);

        font-weight: 700;

        white-space: nowrap;
    }


    /* =====================================================
       EMPRESA
    ===================================================== */

    .empresa-gasto {

        font-weight: 600;

        color: var(--texto);
    }


    /* =====================================================
       CATEGORÍA
    ===================================================== */

    .categoria-gasto {

        color: var(--azul-rey);

        font-weight: 600;
    }


    /* =====================================================
       VALOR
    ===================================================== */

    .valor-gasto {

        font-weight: 700;

        color: var(--rojo);

        white-space: nowrap;
    }


    /* =====================================================
       DESCRIPCIÓN
    ===================================================== */

    .descripcion-gasto {

        color: var(--gris-texto);

        min-width: 180px;
    }


    /* =====================================================
       MÉTODO DE PAGO
    ===================================================== */

    .metodo-pago {

        font-weight: 500;

        white-space: nowrap;
    }


    /* =====================================================
       FECHA
    ===================================================== */

    .fecha-gasto {

        white-space: nowrap;

        color: var(--gris-texto);
    }


    /* =====================================================
       ESTADOS
    ===================================================== */

    .badge-estado {

        display: inline-block;

        padding: 6px 11px;

        border-radius: 20px;

        font-size: 12px;

        font-weight: 700;

        white-space: nowrap;
    }


    .badge-activo {

        background-color: #DDF5E5;

        color: #176B36;
    }


    .badge-anulado {

        background-color: #FDE2E5;

        color: #A61B29;
    }


    /* =====================================================
       ACCIONES
    ===================================================== */

    .acciones-gasto {

        white-space: nowrap;

        min-width: 170px;
    }


    .btn-editar-gasto {

        background-color: var(--amarillo-girasol);

        color: #000;

        border: none;

        border-radius: 7px;

        padding: 7px 11px;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

        display: inline-block;

        margin-right: 4px;

        transition: all 0.2s ease;
    }


    .btn-editar-gasto:hover {

        background-color: var(--amarillo-oscuro);

        color: #000;
    }


    .btn-eliminar-gasto {

        background-color: var(--rojo);

        color: var(--blanco);

        border: none;

        border-radius: 7px;

        padding: 7px 11px;

        font-size: 13px;

        font-weight: 600;

        text-decoration: none;

        display: inline-block;

        transition: all 0.2s ease;
    }


    .btn-eliminar-gasto:hover {

        background-color: #B02A37;

        color: var(--blanco);
    }


    /* =====================================================
       SIN GASTOS
    ===================================================== */

    .sin-gastos {

        padding: 35px 20px !important;

        text-align: center;

        color: var(--gris-texto);

        font-size: 15px;
    }


    .sin-gastos-icono {

        display: block;

        font-size: 35px;

        margin-bottom: 8px;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 768px) {

        .gastos-container {

            padding: 15px;
        }


        .encabezado-gastos {

            padding: 20px;
        }


        .encabezado-gastos h2 {

            font-size: 23px;
        }


        .btn-volver {

            width: 100%;

            text-align: center;

            margin-top: 15px;
        }


        .seccion-gastos {

            padding: 18px;
        }


        .encabezado-seccion {

            display: block;
        }


        .btn-nuevo-gasto {

            width: 100%;

            text-align: center;

            margin-top: 15px;
        }


        .tabla-gastos {

            font-size: 13px;
        }


        .tabla-gastos thead th,
        .tabla-gastos tbody td {

            padding: 10px 8px;
        }

    }

</style>


<div class="container-fluid gastos-container">


    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="encabezado-gastos">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    💸 Gestión de Gastos
                </h2>

                <p>
                    Administra y consulta los gastos registrados
                    de las empresas en SIAFE.
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
         SECCIÓN DE GASTOS
    ====================================================== -->

    <div class="seccion-gastos">


        <!-- TÍTULO Y BOTÓN -->

        <div
            class="d-flex justify-content-between align-items-center flex-wrap encabezado-seccion"
        >

            <div>

                <h4 class="titulo-seccion">
                    Gastos registrados
                </h4>

                <p class="subtitulo-seccion">
                    Consulta, modifica o elimina los gastos
                    registrados en el sistema.
                </p>

            </div>


            <div>

                <a
                    href="index.php?page=crearGasto"
                    class="btn-nuevo-gasto"
                >
                    + Nuevo Gasto
                </a>

            </div>

        </div>


        <!-- =================================================
             TABLA
        ================================================== -->

        <div class="table-responsive">

            <table class="table tabla-gastos">


                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Empresa
                        </th>

                        <th>
                            Categoría
                        </th>

                        <th>
                            Valor
                        </th>

                        <th>
                            Descripción
                        </th>

                        <th>
                            Método de pago
                        </th>

                        <th>
                            Fecha
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


                    <?php if (!empty($gastos)): ?>


                        <?php foreach ($gastos as $gasto): ?>


                            <tr>


                                <!-- ID -->

                                <td class="columna-id">

                                    #<?= htmlspecialchars(
                                        $gasto["id_gasto"]
                                    ); ?>

                                </td>


                                <!-- EMPRESA -->

                                <td class="empresa-gasto">

                                    <?= htmlspecialchars(
                                        $gasto[
                                            "razon_social_empresa"
                                        ]
                                    ); ?>

                                </td>


                                <!-- CATEGORÍA -->

                                <td class="categoria-gasto">

                                    <?= htmlspecialchars(
                                        $gasto[
                                            "nombre_categoria_gasto"
                                        ]
                                    ); ?>

                                </td>


                                <!-- VALOR -->

                                <td class="valor-gasto">

                                    $<?= number_format(
                                        $gasto["valor_gasto"],
                                        2,
                                        ",",
                                        "."
                                    ); ?>

                                </td>


                                <!-- DESCRIPCIÓN -->

                                <td class="descripcion-gasto">

                                    <?= htmlspecialchars(
                                        $gasto[
                                            "descripcion_gasto"
                                        ]
                                    ); ?>

                                </td>


                                <!-- MÉTODO DE PAGO -->

                                <td class="metodo-pago">

                                    <?= htmlspecialchars(
                                        $gasto[
                                            "metodo_pago_gasto"
                                        ]
                                    ); ?>

                                </td>


                                <!-- FECHA -->

                                <td class="fecha-gasto">

                                    <?= htmlspecialchars(
                                        $gasto[
                                            "fecha_gasto"
                                        ] ?? ""
                                    ); ?>

                                </td>


                                <!-- ESTADO -->

                                <td>

                                    <?php if (
                                        $gasto[
                                            "estado_gasto"
                                        ] === "Activo"
                                    ): ?>

                                        <span
                                            class="badge-estado badge-activo"
                                        >
                                            Activo
                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="badge-estado badge-anulado"
                                        >
                                            Anulado
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- ACCIONES -->

                                <td class="acciones-gasto">


                                    <a
                                        href="index.php?page=editarGasto&id=<?= $gasto["id_gasto"]; ?>"
                                        class="btn-editar-gasto"
                                    >
                                        ✏️ Editar
                                    </a>


                                    <a
                                        href="index.php?page=eliminarGasto&id=<?= $gasto["id_gasto"]; ?>"
                                        class="btn-eliminar-gasto"
                                        onclick="return confirm(
                                            '¿Está seguro de eliminar este gasto?'
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
                                class="sin-gastos"
                            >

                                <span class="sin-gastos-icono">
                                    💸
                                </span>

                                No hay gastos registrados.

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