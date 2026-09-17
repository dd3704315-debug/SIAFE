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

    .encabezado-gasto {

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


    .encabezado-gasto h2 {

        margin: 0;

        font-size: 28px;

        font-weight: 700;
    }


    .encabezado-gasto p {

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

    .seccion-gasto {

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

        min-height: 100px;

        resize: vertical;
    }


    /* =====================================================
       VALOR DEL GASTO
    ===================================================== */

    .campo-valor {

        font-weight: 700;
    }


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
       AYUDA
    ===================================================== */

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


    .btn-guardar {

        background-color: var(--amarillo-girasol);

        color: #000;

        border: none;

        border-radius: 9px;

        padding: 11px 22px;

        font-weight: 700;

        transition: all 0.2s ease;
    }


    .btn-guardar:hover {

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

        .gastos-container {

            padding: 15px;
        }


        .encabezado-gasto {

            padding: 20px;
        }


        .encabezado-gasto h2 {

            font-size: 23px;
        }


        .btn-volver {

            width: 100%;

            text-align: center;

            margin-top: 15px;
        }


        .seccion-gasto {

            padding: 18px;
        }


        .contenedor-botones {

            display: block;
        }


        .btn-guardar,
        .btn-cancelar {

            width: 100%;

            display: block;

            text-align: center;

            margin-bottom: 10px;
        }

    }

</style>


<div class="container-fluid gastos-container">


    <!-- =====================================================
         ENCABEZADO
    ====================================================== -->

    <div class="encabezado-gasto">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    💸 Registrar Gasto
                </h2>

                <p>
                    Registra y organiza los gastos de la empresa
                    para mantener actualizada la información financiera.
                </p>

            </div>


            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=gastos"
                    class="btn-volver"
                >
                    ← Volver a Gastos
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LÍNEA SIAFE
    ====================================================== -->

    <div class="linea-siafe"></div>


    <!-- =====================================================
         SECCIÓN DEL FORMULARIO
    ====================================================== -->

    <div class="seccion-gasto">


        <div class="titulo-seccion">

            <h4>
                📝 Información del gasto
            </h4>

            <p>
                Completa los datos necesarios para registrar
                correctamente el gasto en SIAFE.
            </p>

        </div>


        <form
            action="index.php?page=guardarGasto"
            method="POST"
        >


            <!-- =================================================
                 EMPRESA Y CATEGORÍA
            ================================================== -->

            <div class="subtitulo-formulario">
                🏢 Empresa y categoría
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

                        <?php foreach (
                            $empresas
                            as $empresa
                        ): ?>

                            <option
                                value="<?= $empresa[
                                    "id_empresa"
                                ]; ?>"
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
                        Selecciona la empresa a la que pertenece
                        el gasto.
                    </div>

                </div>


                <!-- CATEGORÍA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Categoría del gasto
                    </label>

                    <select
                        name="id_categoria_gasto"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione una categoría
                        </option>

                        <?php foreach (
                            $categorias
                            as $categoria
                        ): ?>

                            <option
                                value="<?= $categoria[
                                    "id_categoria_gasto"
                                ]; ?>"
                            >

                                <?= htmlspecialchars(
                                    $categoria[
                                        "nombre_categoria_gasto"
                                    ]
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <div class="ayuda-campo">
                        Selecciona la categoría correspondiente
                        al gasto.
                    </div>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- =================================================
                 VALOR Y FECHA
            ================================================== -->

            <div class="subtitulo-formulario">
                💰 Valor y fecha
            </div>

            <div class="row">


                <!-- VALOR -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Valor del gasto
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            $
                        </span>

                        <input
                            type="number"
                            name="valor_gasto"
                            class="form-control campo-valor"
                            min="0"
                            step="0.01"
                            placeholder="Ej: 150000"
                            required
                        >

                    </div>

                    <div class="ayuda-campo">
                        Ingresa el valor total del gasto.
                    </div>

                </div>


                <!-- FECHA -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Fecha del gasto
                    </label>

                    <input
                        type="date"
                        name="fecha_gasto"
                        class="form-control"
                        value="<?= date('Y-m-d'); ?>"
                        required
                    >

                    <div class="ayuda-campo">
                        Fecha en la que se realizó el gasto.
                    </div>

                </div>

            </div>


            <!-- =================================================
                 DESCRIPCIÓN
            ================================================== -->

            <div class="row">

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion_gasto"
                        class="form-control"
                        rows="3"
                        placeholder="Descripción del gasto..."
                        required
                    ></textarea>

                    <div class="ayuda-campo">
                        Describe brevemente el motivo o concepto
                        del gasto.
                    </div>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- =================================================
                 COMPROBANTE Y MÉTODO DE PAGO
            ================================================== -->

            <div class="subtitulo-formulario">
                🧾 Comprobante y método de pago
            </div>

            <div class="row">


                <!-- COMPROBANTE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Comprobante
                    </label>

                    <input
                        type="text"
                        name="comprobante_gasto"
                        class="form-control"
                        maxlength="255"
                        placeholder="Número o referencia del comprobante"
                    >

                    <div class="ayuda-campo">
                        Ingresa el número de factura, recibo
                        o referencia cuando corresponda.
                    </div>

                </div>


                <!-- MÉTODO DE PAGO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Método de pago
                    </label>

                    <select
                        name="metodo_pago_gasto"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione un método
                        </option>

                        <option value="Efectivo">
                            Efectivo
                        </option>

                        <option value="Transferencia">
                            Transferencia
                        </option>

                        <option value="Tarjeta">
                            Tarjeta
                        </option>

                        <option value="Nequi">
                            Nequi
                        </option>

                        <option value="Daviplata">
                            Daviplata
                        </option>

                    </select>

                </div>

            </div>


            <!-- =================================================
                 OBSERVACIONES
            ================================================== -->

            <div class="row">

                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Observaciones
                    </label>

                    <textarea
                        name="observacion_gasto"
                        class="form-control"
                        rows="3"
                        placeholder="Observaciones adicionales..."
                    ></textarea>

                    <div class="ayuda-campo">
                        Campo opcional para agregar información
                        adicional sobre el gasto.
                    </div>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- =================================================
                 ESTADO
            ================================================== -->

            <div class="subtitulo-formulario">
                📌 Estado del gasto
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Estado
                    </label>

                    <select
                        name="estado_gasto"
                        class="form-select"
                        required
                    >

                        <option value="Activo">
                            Activo
                        </option>

                        <option value="Anulado">
                            Anulado
                        </option>

                    </select>

                    <div class="ayuda-campo">
                        Selecciona el estado inicial del gasto.
                    </div>

                </div>

            </div>


            <!-- =================================================
                 BOTONES
            ================================================== -->

            <div class="contenedor-botones">

                <a
                    href="index.php?page=gastos"
                    class="btn-cancelar"
                >
                    Cancelar
                </a>


                <button
                    type="submit"
                    class="btn-guardar"
                >
                    💾 Guardar Gasto
                </button>

            </div>


        </form>

    </div>

</div>


<?php

require_once "app/views/layouts/footer.php";

?>