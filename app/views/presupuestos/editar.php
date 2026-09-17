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

    .encabezado-presupuesto {
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

    .encabezado-presupuesto h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
    }

    .encabezado-presupuesto p {
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
       SECCIÓN DEL FORMULARIO
    ===================================================== */

    .seccion-presupuesto {
        background-color: var(--blanco);
        border-radius: 15px;
        padding: 25px;

        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.06);
    }

    .titulo-seccion {
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--gris-borde);
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
       SUBTÍTULOS
    ===================================================== */

    .subtitulo-formulario {
        color: var(--azul-rey);
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    /* =====================================================
       CAMPOS
    ===================================================== */

    .form-label {
        font-weight: 600;
        color: var(--texto);
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        border: 1px solid var(--gris-borde);
        border-radius: 9px;
        min-height: 44px;
        padding: 9px 12px;

        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--azul-rey);

        box-shadow:
            0 0 0 3px rgba(23, 70, 162, 0.12);
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
    }

    /* =====================================================
       INPUT GROUP
    ===================================================== */

    .input-group-text {
        background-color: var(--azul-claro);
        color: var(--azul-rey);

        border: 1px solid var(--gris-borde);
        border-radius: 9px 0 0 9px;

        font-weight: 700;
    }

    .input-group .form-control {
        border-radius: 0 9px 9px 0;
    }

    /* =====================================================
       UTILIDAD
    ===================================================== */

    .campo-utilidad {
        background-color: #F8FAFD;
        font-weight: 700;
    }

    .utilidad-positiva {
        color: #176B36 !important;
        font-weight: 700;
    }

    .utilidad-negativa {
        color: var(--rojo) !important;
        font-weight: 700;
    }

    .ayuda-campo {
        color: var(--gris-texto);
        font-size: 12px;
        margin-top: 5px;
    }

    /* =====================================================
       SEPARADORES
    ===================================================== */

    .separador-formulario {
        margin: 10px 0 25px;
        border: 0;
        border-top: 1px solid var(--gris-borde);
    }

    /* =====================================================
       BOTONES
    ===================================================== */

    .contenedor-botones {
        padding-top: 20px;
        border-top: 1px solid var(--gris-borde);

        margin-top: 10px;

        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-actualizar {
        background-color: var(--amarillo-girasol);
        color: #000;
        border: none;

        border-radius: 9px;
        padding: 11px 22px;

        font-weight: 700;

        transition: all 0.2s ease;
    }

    .btn-actualizar:hover {
        background-color: var(--amarillo-oscuro);
        color: #000;

        transform: translateY(-1px);
    }

    .btn-cancelar {
        background-color: #EEF1F6;
        color: var(--texto);

        border: 1px solid var(--gris-borde);
        border-radius: 9px;

        padding: 11px 22px;

        font-weight: 600;
        text-decoration: none;

        transition: all 0.2s ease;
    }

    .btn-cancelar:hover {
        background-color: #DDE3EE;
        color: #000;
    }

    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 768px) {

        .presupuestos-container {
            padding: 15px;
        }

        .encabezado-presupuesto {
            padding: 20px;
        }

        .encabezado-presupuesto h2 {
            font-size: 23px;
        }

        .btn-volver {
            margin-top: 15px;
            width: 100%;
            text-align: center;
        }

        .seccion-presupuesto {
            padding: 18px;
        }

        .contenedor-botones {
            display: block;
        }

        .btn-actualizar,
        .btn-cancelar {
            width: 100%;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }

    }

</style>


<div class="container-fluid presupuestos-container">

    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="encabezado-presupuesto">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    ✏️ Editar Presupuesto
                </h2>

                <p>
                    Modifica la información financiera del presupuesto
                    seleccionado en SIAFE.
                </p>

            </div>

            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=presupuestos"
                    class="btn-volver"
                >
                    ← Volver a Presupuestos
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LÍNEA SIAFE
    ===================================================== -->

    <div class="linea-siafe"></div>


    <!-- =====================================================
         CONTENIDO
    ===================================================== -->

    <div class="seccion-presupuesto">

        <div class="titulo-seccion">

            <h4>
                📊 Modificar presupuesto
            </h4>

            <p>
                Actualiza los datos de la empresa, periodo,
                valores financieros, descripción y estado.
            </p>

        </div>


        <form
            action="index.php?page=actualizarPresupuesto"
            method="POST"
        >

            <!-- =================================================
                 ID DEL PRESUPUESTO
            ================================================== -->

            <input
                type="hidden"
                name="id_presupuesto"
                value="<?= htmlspecialchars(
                    $datos["id_presupuesto"]
                ); ?>"
            >


            <!-- =================================================
                 EMPRESA Y PERIODO
            ================================================== -->

            <div class="subtitulo-formulario">
                🏢 Empresa y periodo
            </div>

            <div class="row">


                <!-- EMPRESA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Empresa
                    </label>

                    <select
                        name="id_empresa"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione una empresa
                        </option>

                        <?php foreach ($empresas as $empresa): ?>

                            <option
                                value="<?= $empresa["id_empresa"]; ?>"
                                <?= (
                                    $datos["id_empresa"]
                                    == $empresa["id_empresa"]
                                )
                                ? "selected"
                                : ""; ?>
                            >

                                <?= htmlspecialchars(
                                    $empresa[
                                        "razon_social_empresa"
                                    ]
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <div class="ayuda-campo">
                        Selecciona la empresa asociada al presupuesto.
                    </div>

                </div>


                <!-- AÑO -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Año
                    </label>

                    <input
                        type="number"
                        name="anio_presupuesto"
                        class="form-control"
                        min="2020"
                        max="2100"
                        value="<?= htmlspecialchars(
                            $datos["anio_presupuesto"]
                        ); ?>"
                        required
                    >

                </div>


                <!-- MES -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Mes
                    </label>

                    <select
                        name="mes_presupuesto"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione
                        </option>

                        <option
                            value="1"
                            <?= $datos["mes_presupuesto"] == 1
                                ? "selected"
                                : ""; ?>
                        >
                            Enero
                        </option>

                        <option
                            value="2"
                            <?= $datos["mes_presupuesto"] == 2
                                ? "selected"
                                : ""; ?>
                        >
                            Febrero
                        </option>

                        <option
                            value="3"
                            <?= $datos["mes_presupuesto"] == 3
                                ? "selected"
                                : ""; ?>
                        >
                            Marzo
                        </option>

                        <option
                            value="4"
                            <?= $datos["mes_presupuesto"] == 4
                                ? "selected"
                                : ""; ?>
                        >
                            Abril
                        </option>

                        <option
                            value="5"
                            <?= $datos["mes_presupuesto"] == 5
                                ? "selected"
                                : ""; ?>
                        >
                            Mayo
                        </option>

                        <option
                            value="6"
                            <?= $datos["mes_presupuesto"] == 6
                                ? "selected"
                                : ""; ?>
                        >
                            Junio
                        </option>

                        <option
                            value="7"
                            <?= $datos["mes_presupuesto"] == 7
                                ? "selected"
                                : ""; ?>
                        >
                            Julio
                        </option>

                        <option
                            value="8"
                            <?= $datos["mes_presupuesto"] == 8
                                ? "selected"
                                : ""; ?>
                        >
                            Agosto
                        </option>

                        <option
                            value="9"
                            <?= $datos["mes_presupuesto"] == 9
                                ? "selected"
                                : ""; ?>
                        >
                            Septiembre
                        </option>

                        <option
                            value="10"
                            <?= $datos["mes_presupuesto"] == 10
                                ? "selected"
                                : ""; ?>
                        >
                            Octubre
                        </option>

                        <option
                            value="11"
                            <?= $datos["mes_presupuesto"] == 11
                                ? "selected"
                                : ""; ?>
                        >
                            Noviembre
                        </option>

                        <option
                            value="12"
                            <?= $datos["mes_presupuesto"] == 12
                                ? "selected"
                                : ""; ?>
                        >
                            Diciembre
                        </option>

                    </select>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- =================================================
                 VALORES FINANCIEROS
            ================================================== -->

            <div class="subtitulo-formulario">
                💰 Valores financieros
            </div>

            <div class="row">


                <!-- INGRESOS -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Ingresos estimados
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            $
                        </span>

                        <input
                            type="number"
                            name="presupuesto_ingresos_estimado"
                            id="ingresos"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="<?= htmlspecialchars(
                                $datos[
                                    "presupuesto_ingresos_estimado"
                                ]
                            ); ?>"
                            required
                        >

                    </div>

                    <div class="ayuda-campo">
                        Valor estimado de los ingresos del periodo.
                    </div>

                </div>


                <!-- GASTOS -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Gastos estimados
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            $
                        </span>

                        <input
                            type="number"
                            name="presupuesto_gastos_estimado"
                            id="gastos"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="<?= htmlspecialchars(
                                $datos[
                                    "presupuesto_gastos_estimado"
                                ]
                            ); ?>"
                            required
                        >

                    </div>

                    <div class="ayuda-campo">
                        Valor estimado de los gastos del periodo.
                    </div>

                </div>


                <!-- UTILIDAD -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Utilidad estimada
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            $
                        </span>

                        <input
                            type="text"
                            id="utilidad"
                            class="form-control campo-utilidad"
                            value="<?= number_format(
                                $datos[
                                    "presupuesto_utilidad_estimada"
                                ],
                                2,
                                ".",
                                ""
                            ); ?>"
                            readonly
                        >

                    </div>

                    <div class="ayuda-campo">
                        Se calcula automáticamente:
                        ingresos − gastos.
                    </div>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- =================================================
                 INFORMACIÓN ADICIONAL
            ================================================== -->

            <div class="subtitulo-formulario">
                📝 Información adicional
            </div>

            <div class="row">


                <!-- DESCRIPCIÓN -->

                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="presupuesto_descripcion"
                        class="form-control"
                        rows="4"
                        placeholder="Descripción del presupuesto..."
                    ><?= htmlspecialchars(
                        $datos[
                            "presupuesto_descripcion"
                        ] ?? ""
                    ); ?></textarea>

                    <div class="ayuda-campo">
                        Actualiza las observaciones o información adicional
                        del presupuesto.
                    </div>

                </div>


                <!-- ESTADO -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Estado
                    </label>

                    <select
                        name="estado_presupuesto"
                        class="form-select"
                        required
                    >

                        <option
                            value="Activo"
                            <?= $datos[
                                "estado_presupuesto"
                            ] === "Activo"
                                ? "selected"
                                : ""; ?>
                        >
                            Activo
                        </option>

                        <option
                            value="Finalizado"
                            <?= $datos[
                                "estado_presupuesto"
                            ] === "Finalizado"
                                ? "selected"
                                : ""; ?>
                        >
                            Finalizado
                        </option>

                        <option
                            value="Cancelado"
                            <?= $datos[
                                "estado_presupuesto"
                            ] === "Cancelado"
                                ? "selected"
                                : ""; ?>
                        >
                            Cancelado
                        </option>

                    </select>

                    <div class="ayuda-campo">
                        Define el estado actual del presupuesto.
                    </div>

                </div>

            </div>


            <!-- =================================================
                 BOTONES
            ================================================== -->

            <div class="contenedor-botones">

                <a
                    href="index.php?page=presupuestos"
                    class="btn-cancelar"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn-actualizar"
                >
                    💾 Actualizar Presupuesto
                </button>

            </div>

        </form>

    </div>

</div>


<!-- =========================================================
     CÁLCULO AUTOMÁTICO DE UTILIDAD
========================================================= -->

<script>

    const ingresos =
        document.getElementById("ingresos");

    const gastos =
        document.getElementById("gastos");

    const utilidad =
        document.getElementById("utilidad");


    function calcularUtilidad()
    {

        const valorIngresos =
            parseFloat(ingresos.value) || 0;

        const valorGastos =
            parseFloat(gastos.value) || 0;

        const resultado =
            valorIngresos - valorGastos;


        utilidad.value =
            resultado.toFixed(2);


        /* =================================================
           CAMBIAR COLOR SEGÚN LA UTILIDAD
        ================================================= */

        utilidad.classList.remove(
            "utilidad-positiva",
            "utilidad-negativa"
        );


        if (resultado >= 0)
        {

            utilidad.classList.add(
                "utilidad-positiva"
            );

        }
        else
        {

            utilidad.classList.add(
                "utilidad-negativa"
            );

        }

    }


    ingresos.addEventListener(
        "input",
        calcularUtilidad
    );

    gastos.addEventListener(
        "input",
        calcularUtilidad
    );


    /* =====================================================
       CALCULAR AL CARGAR LA PÁGINA
    ===================================================== */

    calcularUtilidad();

</script>


<?php

require_once "app/views/layouts/footer.php";

?>