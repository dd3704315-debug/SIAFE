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
   ENCABEZADO
   ========================================================= */

.encabezado-empresa {

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


.encabezado-empresa h2 {

    margin: 0;

    font-weight: 700;

    letter-spacing: 0.3px;
}


.encabezado-empresa p {

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
   LÍNEA DECORATIVA
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

    box-shadow:
        0 5px 18px rgba(0, 0, 0, 0.07);
}


.seccion-formulario h4 {

    color: var(--azul-rey);

    font-weight: 700;

    margin-bottom: 5px;
}


/* =========================================================
   ETIQUETAS
   ========================================================= */

.form-label {

    color: var(--texto);

    font-weight: 600;

    margin-bottom: 6px;
}


/* =========================================================
   CAMPOS
   ========================================================= */

.form-control,
.form-select {

    border: 1px solid var(--gris-borde);

    border-radius: 8px;

    padding: 10px 12px;

    color: var(--texto);

    transition: all 0.2s ease;
}


.form-control:focus,
.form-select:focus {

    border-color: var(--azul-rey);

    box-shadow:
        0 0 0 0.2rem rgba(23, 70, 162, 0.15);
}


/* =========================================================
   BOTÓN ACTUALIZAR
   ========================================================= */

.btn-actualizar-empresa {

    background-color: var(--amarillo-girasol);

    border: 2px solid var(--amarillo-girasol);

    color: #171717;

    font-weight: 700;

    border-radius: 9px;

    padding: 10px 18px;

    transition: all 0.2s ease;
}


.btn-actualizar-empresa:hover {

    background-color: var(--azul-rey);

    border-color: var(--azul-rey);

    color: var(--blanco);

    transform: translateY(-2px);

    box-shadow:
        0 5px 12px rgba(23, 70, 162, 0.25);
}


/* =========================================================
   BOTÓN CANCELAR
   ========================================================= */

.btn-cancelar {

    background-color: var(--blanco);

    border: 1px solid #BFC7D5;

    color: #555;

    font-weight: 600;

    border-radius: 9px;

    padding: 10px 18px;

    transition: all 0.2s ease;
}


.btn-cancelar:hover {

    background-color: var(--azul-claro);

    border-color: var(--azul-rey);

    color: var(--azul-rey);
}


/* =========================================================
   ALERTA
   ========================================================= */

.alert {

    border-radius: 10px;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .empresas-container {

        padding: 15px;
    }

    .encabezado-empresa {

        padding: 20px;
    }

    .encabezado-empresa h2 {

        font-size: 22px;
    }

    .btn-volver {

        margin-top: 15px;

        width: 100%;
    }

    .seccion-formulario {

        padding: 15px;
    }

}

</style>


<div class="container-fluid empresas-container">


    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="encabezado-empresa">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>
                    🏢 Editar Empresa
                </h2>

                <p>
                    Actualiza la información de la empresa registrada en SIAFE.
                </p>

            </div>

            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=empresas"
                    class="btn btn-volver"
                >
                    ← Volver a Empresas
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

        <div class="mb-4">

            <h4>
                ✏️ Información de la empresa
            </h4>

            <small class="text-muted">
                Modifica los datos necesarios y guarda los cambios.
            </small>

        </div>


        <?php if (!empty($error)): ?>

            <div class="alert alert-danger">

                <?= htmlspecialchars($error); ?>

            </div>

        <?php endif; ?>


        <form
            action="index.php?page=actualizarEmpresa"
            method="POST"
        >


            <!-- =================================================
                 ID DE LA EMPRESA
                 ================================================= -->

            <input
                type="hidden"
                name="id_empresa"
                value="<?= htmlspecialchars($datos['id_empresa']); ?>"
            >


            <!-- =================================================
                 USUARIO / NIT
                 ================================================= -->

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="id_usuario"
                    >
                        Usuario responsable
                    </label>

                    <select
                        name="id_usuario"
                        id="id_usuario"
                        class="form-select"
                        required
                    >

                        <?php foreach ($usuarios as $usuario): ?>

                            <option
                                value="<?= $usuario['id_usuario']; ?>"
                                <?= $usuario['id_usuario'] == $datos['id_usuario'] ? 'selected' : ''; ?>
                            >

                                <?= htmlspecialchars(
                                    $usuario['nombre_usuario'] . " " .
                                    $usuario['apellido_usuario'] .
                                    " (" . $usuario['usuario'] . ")"
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="nit_empresa"
                    >
                        NIT
                    </label>

                    <input
                        type="text"
                        name="nit_empresa"
                        id="nit_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['nit_empresa'] ?? ''); ?>"
                        maxlength="20"
                        required
                    >

                </div>

            </div>


            <!-- =================================================
                 RAZÓN SOCIAL / NOMBRE COMERCIAL
                 ================================================= -->

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="razon_social_empresa"
                    >
                        Razón Social
                    </label>

                    <input
                        type="text"
                        name="razon_social_empresa"
                        id="razon_social_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['razon_social_empresa'] ?? ''); ?>"
                        maxlength="150"
                        required
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="nombre_comercial_empresa"
                    >
                        Nombre Comercial
                    </label>

                    <input
                        type="text"
                        name="nombre_comercial_empresa"
                        id="nombre_comercial_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['nombre_comercial_empresa'] ?? ''); ?>"
                        maxlength="150"
                    >

                </div>

            </div>


            <!-- =================================================
                 CORREO / TELÉFONO
                 ================================================= -->

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="correo_empresa"
                    >
                        Correo Electrónico
                    </label>

                    <input
                        type="email"
                        name="correo_empresa"
                        id="correo_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['correo_empresa'] ?? ''); ?>"
                        maxlength="150"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="telefono_empresa"
                    >
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono_empresa"
                        id="telefono_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['telefono_empresa'] ?? ''); ?>"
                        maxlength="20"
                    >

                </div>

            </div>


            <!-- =================================================
                 DIRECCIÓN / CIUDAD
                 ================================================= -->

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="direccion_empresa"
                    >
                        Dirección
                    </label>

                    <input
                        type="text"
                        name="direccion_empresa"
                        id="direccion_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['direccion_empresa'] ?? ''); ?>"
                        maxlength="200"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="ciudad_empresa"
                    >
                        Ciudad
                    </label>

                    <input
                        type="text"
                        name="ciudad_empresa"
                        id="ciudad_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['ciudad_empresa'] ?? ''); ?>"
                        maxlength="100"
                    >

                </div>

            </div>


            <!-- =================================================
                 DEPARTAMENTO / SECTOR
                 ================================================= -->

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="departamento_empresa"
                    >
                        Departamento
                    </label>

                    <input
                        type="text"
                        name="departamento_empresa"
                        id="departamento_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['departamento_empresa'] ?? ''); ?>"
                        maxlength="100"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="sector_economico_empresa"
                    >
                        Sector Económico
                    </label>

                    <input
                        type="text"
                        name="sector_economico_empresa"
                        id="sector_economico_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['sector_economico_empresa'] ?? ''); ?>"
                        maxlength="100"
                    >

                </div>

            </div>


            <!-- =================================================
                 REPRESENTANTE / ESTADO
                 ================================================= -->

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="representante_legal_empresa"
                    >
                        Representante Legal
                    </label>

                    <input
                        type="text"
                        name="representante_legal_empresa"
                        id="representante_legal_empresa"
                        class="form-control"
                        value="<?= htmlspecialchars($datos['representante_legal_empresa'] ?? ''); ?>"
                        maxlength="150"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label
                        class="form-label"
                        for="estado_empresa"
                    >
                        Estado
                    </label>

                    <select
                        name="estado_empresa"
                        id="estado_empresa"
                        class="form-select"
                    >

                        <option
                            value="Activo"
                            <?= ($datos['estado_empresa'] ?? '') === 'Activo' ? 'selected' : ''; ?>
                        >
                            Activo
                        </option>

                        <option
                            value="Inactivo"
                            <?= ($datos['estado_empresa'] ?? '') === 'Inactivo' ? 'selected' : ''; ?>
                        >
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>


            <!-- =================================================
                 BOTONES
                 ================================================= -->

            <div class="d-flex gap-2 mt-3">

                <button
                    type="submit"
                    class="btn btn-actualizar-empresa"
                >
                    💾 Actualizar Empresa
                </button>


                <a
                    href="index.php?page=empresas"
                    class="btn btn-cancelar"
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