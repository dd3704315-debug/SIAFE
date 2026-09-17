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

    .encabezado-ingreso {
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

    .encabezado-ingreso h2 {
        margin: 0;
        font-weight: 700;
        font-size: 28px;
    }

    .encabezado-ingreso p {
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
       SECCIÓN FORMULARIO
    ================================= */

    .seccion-ingreso {
        background-color: var(--blanco);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    }

    .titulo-seccion {
        color: var(--azul-rey);
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 22px;
    }

    .subtitulo-formulario {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 25px;
    }

    /* ================================
       CAMPOS
    ================================= */

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
        background-color: var(--blanco);
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--azul-rey);
        box-shadow: 0 0 0 3px rgba(23, 70, 162, 0.12);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
    }

    .ayuda-campo {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
    }

    /* ================================
       SEPARADOR
    ================================= */

    .separador-formulario {
        border: 0;
        border-top: 1px solid var(--gris-borde);
        margin: 25px 0;
    }

    /* ================================
       BOTÓN ACTUALIZAR
    ================================= */

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
        background-color: var(--azul-rey);
        color: var(--blanco);
        transform: translateY(-1px);
    }

    /* ================================
       BOTÓN CANCELAR
    ================================= */

    .btn-cancelar {
        background-color: #6c757d;
        color: var(--blanco);
        border: none;
        border-radius: 9px;
        padding: 11px 22px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s ease;
    }

    .btn-cancelar:hover {
        background-color: #495057;
        color: var(--blanco);
    }

    /* ================================
       ESTADO
    ================================= */

    .campo-estado {
        max-width: 50%;
    }

    /* ================================
       RESPONSIVE
    ================================= */

    @media (max-width: 768px) {

        .ingresos-container {
            padding: 15px;
        }

        .encabezado-ingreso {
            padding: 20px;
        }

        .encabezado-ingreso h2 {
            font-size: 23px;
        }

        .seccion-ingreso {
            padding: 20px;
        }

        .titulo-seccion {
            font-size: 19px;
        }

        .campo-estado {
            max-width: 100%;
        }

        .btn-actualizar,
        .btn-cancelar {
            width: 100%;
            text-align: center;
        }

    }

</style>


<div class="container-fluid ingresos-container">

    <!-- ENCABEZADO -->

    <div class="encabezado-ingreso">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>✏️ Editar Ingreso</h2>

                <p>
                    Modifica la información del ingreso registrado en SIAFE.
                </p>

            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">

                <a
                    href="index.php?page=ingresos"
                    class="btn-volver"
                >
                    ← Volver a Ingresos
                </a>

            </div>

        </div>

    </div>


    <div class="linea-siafe"></div>


    <!-- SECCIÓN DEL FORMULARIO -->

    <div class="seccion-ingreso">

        <h4 class="titulo-seccion">
            Información del ingreso
        </h4>

        <p class="subtitulo-formulario">
            Actualiza los datos necesarios y guarda los cambios realizados.
        </p>


        <form
            action="index.php?page=actualizarIngreso"
            method="POST"
        >

            <!-- ID OCULTO -->

            <input
                type="hidden"
                name="id_ingreso"
                value="<?= htmlspecialchars($datos["id_ingreso"]); ?>"
            >


            <div class="row">


                <!-- EMPRESA -->

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Empresa
                    </label>

                    <select
                        name="id_empresa"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione una empresa...
                        </option>

                        <?php foreach ($empresas as $empresa): ?>

                            <option
                                value="<?= $empresa["id_empresa"]; ?>"
                                <?= (
                                    $datos["id_empresa"]
                                    == $empresa["id_empresa"]
                                ) ? "selected" : ""; ?>
                            >

                                <?= htmlspecialchars(
                                    $empresa["razon_social_empresa"]
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <div class="ayuda-campo">
                        Selecciona la empresa a la que pertenece este ingreso.
                    </div>

                </div>


                <!-- CATEGORÍA -->

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Categoría del ingreso
                    </label>

                    <select
                        name="id_categoria_ingreso"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione una categoría...
                        </option>

                        <?php foreach ($categorias as $categoria): ?>

                            <option
                                value="<?= $categoria["id_categoria_ingreso"]; ?>"
                                <?= (
                                    $datos["id_categoria_ingreso"]
                                    == $categoria["id_categoria_ingreso"]
                                ) ? "selected" : ""; ?>
                            >

                                <?= htmlspecialchars(
                                    $categoria["nombre_categoria_ingreso"]
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <div class="ayuda-campo">
                        Clasifica el ingreso según su tipo.
                    </div>

                </div>


                <!-- VALOR -->

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Valor del ingreso
                    </label>

                    <input
                        type="number"
                        name="valor_ingreso"
                        class="form-control"
                        step="0.01"
                        min="0"
                        value="<?= htmlspecialchars(
                            $datos["valor_ingreso"]
                        ); ?>"
                        required
                    >

                    <div class="ayuda-campo">
                        Ingresa el valor correspondiente al ingreso.
                    </div>

                </div>


                <!-- MÉTODO DE PAGO -->

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Método de pago
                    </label>

                    <select
                        name="metodo_pago_ingreso"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione...
                        </option>

                        <option
                            value="Efectivo"
                            <?= $datos["metodo_pago_ingreso"] === "Efectivo"
                                ? "selected"
                                : ""; ?>
                        >
                            Efectivo
                        </option>

                        <option
                            value="Transferencia"
                            <?= $datos["metodo_pago_ingreso"] === "Transferencia"
                                ? "selected"
                                : ""; ?>
                        >
                            Transferencia
                        </option>

                        <option
                            value="Tarjeta"
                            <?= $datos["metodo_pago_ingreso"] === "Tarjeta"
                                ? "selected"
                                : ""; ?>
                        >
                            Tarjeta
                        </option>

                        <option
                            value="Nequi"
                            <?= $datos["metodo_pago_ingreso"] === "Nequi"
                                ? "selected"
                                : ""; ?>
                        >
                            Nequi
                        </option>

                    </select>

                    <div class="ayuda-campo">
                        Selecciona cómo se recibió el pago.
                    </div>

                </div>


                <!-- DESCRIPCIÓN -->

                <div class="col-md-12 mb-4">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion_ingreso"
                        class="form-control"
                        rows="3"
                        required
                    ><?= htmlspecialchars(
                        $datos["descripcion_ingreso"]
                    ); ?></textarea>

                    <div class="ayuda-campo">
                        Describe brevemente el motivo o concepto del ingreso.
                    </div>

                </div>


                <!-- COMPROBANTE -->

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Comprobante
                    </label>

                    <input
                        type="text"
                        name="comprobante_ingreso"
                        class="form-control"
                        maxlength="255"
                        value="<?= htmlspecialchars(
                            $datos["comprobante_ingreso"] ?? ""
                        ); ?>"
                    >

                    <div class="ayuda-campo">
                        Número o referencia del comprobante, si aplica.
                    </div>

                </div>


                <!-- FECHA -->

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Fecha del ingreso
                    </label>

                    <input
                        type="date"
                        name="fecha_ingreso"
                        class="form-control"
                        value="<?= htmlspecialchars(
                            $datos["fecha_ingreso"] ?? ""
                        ); ?>"
                        required
                    >

                    <div class="ayuda-campo">
                        Fecha en la que se registró el ingreso.
                    </div>

                </div>


                <!-- OBSERVACIÓN -->

                <div class="col-md-12 mb-4">

                    <label class="form-label">
                        Observación
                    </label>

                    <textarea
                        name="observacion_ingreso"
                        class="form-control"
                        rows="3"
                    ><?= htmlspecialchars(
                        $datos["observacion_ingreso"] ?? ""
                    ); ?></textarea>

                    <div class="ayuda-campo">
                        Agrega información adicional relacionada con el ingreso.
                    </div>

                </div>


                <!-- ESTADO -->

                <div class="col-md-6 mb-4 campo-estado">

                    <label class="form-label">
                        Estado
                    </label>

                    <select
                        name="estado_ingreso"
                        class="form-select"
                        required
                    >

                        <option
                            value="Activo"
                            <?= $datos["estado_ingreso"] === "Activo"
                                ? "selected"
                                : ""; ?>
                        >
                            Activo
                        </option>

                        <option
                            value="Anulado"
                            <?= $datos["estado_ingreso"] === "Anulado"
                                ? "selected"
                                : ""; ?>
                        >
                            Anulado
                        </option>

                    </select>

                    <div class="ayuda-campo">
                        Define si el ingreso permanece activo o fue anulado.
                    </div>

                </div>

            </div>


            <hr class="separador-formulario">


            <!-- BOTONES -->

            <div class="d-flex gap-2 flex-wrap">

                <button
                    type="submit"
                    class="btn-actualizar"
                >
                    💾 Actualizar Ingreso
                </button>

                <a
                    href="index.php?page=ingresos"
                    class="btn-cancelar"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>


<?php

require_once "app/views/layouts/footer.php";

?>