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

.encabezado-reporte {
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

.encabezado-reporte h2 {
    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}

.encabezado-reporte p {
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

    margin: 0;
}

.descripcion-formulario {
    color: #6C757D;

    margin-top: 6px;

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
   INPUT GROUP
   ========================================================= */

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

/* =========================================================
   UTILIDAD
   ========================================================= */

.utilidad-resultado {
    font-weight: 700;

    color: var(--azul-rey);

    background-color: var(--azul-claro);
}

.utilidad-positiva {
    color: #198754 !important;

    background-color: #EAF7EF !important;
}

.utilidad-negativa {
    color: #DC3545 !important;

    background-color: #FFF0F1 !important;
}

/* =========================================================
   AYUDA
   ========================================================= */

.ayuda-campo {
    color: #6C757D;

    font-size: 13px;

    margin-top: 5px;
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

.btn-actualizar-reporte {
    background-color: var(--amarillo-girasol);

    border: 2px solid var(--amarillo-girasol);

    color: #171717;

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 20px;

    transition: all 0.2s ease;
}

.btn-actualizar-reporte:hover {
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

    .reportes-container {
        padding: 15px;
    }

    .encabezado-reporte {
        padding: 20px;
    }

    .encabezado-reporte h2 {
        font-size: 22px;
    }

    .btn-volver {
        margin-top: 15px;

        width: 100%;
    }

    .seccion-formulario {
        padding: 18px;
    }

    .btn-actualizar-reporte,
    .btn-cancelar {
        width: 100%;

        margin-bottom: 8px;
    }

}

</style>


<div class="container-fluid reportes-container">

    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-reporte">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    ✏️ Editar Reporte
                </h2>

                <p>
                    Modifica la información financiera del reporte seleccionado.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=reportes"
                    class="btn btn-volver"
                >
                    ← Volver a Reportes
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
            📊 Información del reporte
        </h4>

        <p class="descripcion-formulario">
            Actualiza los datos de la empresa, periodo, valores financieros y estado del reporte.
        </p>


        <form
            action="index.php?page=actualizarReporte"
            method="POST"
        >

            <!-- ID DEL REPORTE -->

            <input
                type="hidden"
                name="id_reporte"
                value="<?= htmlspecialchars(
                    $datos["id_reporte"]
                ); ?>"
            >


            <div class="row">

                <!-- =================================================
                     EMPRESA
                     ================================================= -->

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

                </div>


                <!-- =================================================
                     TIPO
                     ================================================= -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Tipo de reporte
                    </label>

                    <select
                        name="tipo_reporte"
                        class="form-select"
                        required
                    >

                        <?php

                        $tipos = [
                            "General",
                            "Ingresos",
                            "Gastos",
                            "Utilidad",
                            "Presupuesto",
                            "Financiero"
                        ];

                        foreach ($tipos as $tipo):

                        ?>

                            <option
                                value="<?= $tipo; ?>"
                                <?= $datos["tipo_reporte"] === $tipo
                                    ? "selected"
                                    : ""; ?>
                            >

                                <?= $tipo; ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- =================================================
                     AÑO
                     ================================================= -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Año
                    </label>

                    <input
                        type="number"
                        name="periodo_anio"
                        class="form-control"
                        min="2020"
                        max="2100"
                        value="<?= htmlspecialchars(
                            $datos["periodo_anio"]
                        ); ?>"
                        required
                    >

                </div>


                <!-- =================================================
                     MES
                     ================================================= -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Mes
                    </label>

                    <select
                        name="periodo_mes"
                        class="form-select"
                    >

                        <option
                            value=""
                            <?= empty($datos["periodo_mes"])
                                ? "selected"
                                : ""; ?>
                        >
                            Todo el año
                        </option>

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

                        foreach ($meses as $numero => $nombre):

                        ?>

                            <option
                                value="<?= $numero; ?>"
                                <?= (
                                    $datos["periodo_mes"]
                                    == $numero
                                )
                                ? "selected"
                                : ""; ?>
                            >

                                <?= $nombre; ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- =================================================
                     INGRESOS
                     ================================================= -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Total ingresos
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            $
                        </span>

                        <input
                            type="number"
                            name="total_ingresos"
                            id="total_ingresos"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="<?= htmlspecialchars(
                                $datos["total_ingresos"]
                            ); ?>"
                            required
                        >

                    </div>

                </div>


                <!-- =================================================
                     GASTOS
                     ================================================= -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Total gastos
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            $
                        </span>

                        <input
                            type="number"
                            name="total_gastos"
                            id="total_gastos"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="<?= htmlspecialchars(
                                $datos["total_gastos"]
                            ); ?>"
                            required
                        >

                    </div>

                </div>


                <!-- =================================================
                     UTILIDAD
                     ================================================= -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Utilidad
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            $
                        </span>

                        <input
                            type="text"
                            id="utilidad"
                            class="form-control utilidad-resultado"
                            value="<?= number_format(
                                $datos["utilidad"],
                                2,
                                ".",
                                ""
                            ); ?>"
                            readonly
                        >

                    </div>

                    <small class="ayuda-campo">
                        Ingresos - Gastos
                    </small>

                </div>


                <!-- =================================================
                     ESTADO
                     ================================================= -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Estado
                    </label>

                    <select
                        name="estado_reporte"
                        class="form-select"
                        required
                    >

                        <option
                            value="Generado"
                            <?= $datos["estado_reporte"] === "Generado"
                                ? "selected"
                                : ""; ?>
                        >
                            Generado
                        </option>

                        <option
                            value="Revisado"
                            <?= $datos["estado_reporte"] === "Revisado"
                                ? "selected"
                                : ""; ?>
                        >
                            Revisado
                        </option>

                        <option
                            value="Archivado"
                            <?= $datos["estado_reporte"] === "Archivado"
                                ? "selected"
                                : ""; ?>
                        >
                            Archivado
                        </option>

                    </select>

                </div>


                <!-- =================================================
                     DESCRIPCIÓN
                     ================================================= -->

                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion_reporte"
                        class="form-control"
                        rows="4"
                    ><?= htmlspecialchars(
                        $datos["descripcion_reporte"] ?? ""
                    ); ?></textarea>

                </div>

            </div>


            <!-- =================================================
                 SEPARADOR
                 ================================================= -->

            <hr class="separador-formulario">


            <!-- =================================================
                 BOTONES
                 ================================================= -->

            <div class="d-flex justify-content-end gap-2 flex-wrap">

                <a
                    href="index.php?page=reportes"
                    class="btn btn-cancelar"
                >
                    ✕ Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-actualizar-reporte"
                >
                    ✓ Actualizar Reporte
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
    document.getElementById("total_ingresos");

const gastos =
    document.getElementById("total_gastos");

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


    /* Cambiar apariencia según resultado */

    utilidad.classList.remove(
        "utilidad-positiva",
        "utilidad-negativa"
    );


    if (resultado >= 0) {

        utilidad.classList.add(
            "utilidad-positiva"
        );

    } else {

        utilidad.classList.add(
            "utilidad-negativa"
        );

    }
}


/* Calcular al cambiar ingresos */

ingresos.addEventListener(
    "input",
    calcularUtilidad
);


/* Calcular al cambiar gastos */

gastos.addEventListener(
    "input",
    calcularUtilidad
);


/* Calcular al cargar la página */

calcularUtilidad();

</script>


<?php

require_once "app/views/layouts/footer.php";

?>