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
    --gris-fondo: #F5F7FB;
    --gris-borde: #DDE3EE;
}

body {
    background: var(--gris-fondo);
}

.proveedor-form-container {
    padding: 25px;
}

.encabezado-proveedor-form {
    background: linear-gradient(
        135deg,
        var(--azul-rey),
        var(--azul-rey-oscuro)
    );
    color: white;
    border-radius: 15px;
    padding: 25px 30px;
    margin-bottom: 20px;
    box-shadow: 0 8px 20px rgba(16,53,125,.18);
}

.btn-volver {
    background: white;
    color: var(--azul-rey);
    border: none;
    border-radius: 9px;
    padding: 10px 18px;
    font-weight: 600;
}

.btn-volver:hover {
    background: var(--amarillo-girasol);
    color: #111;
}

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

.seccion-formulario {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 18px rgba(0,0,0,.07);
}

.form-label {
    font-weight: 600;
    color: var(--azul-rey-oscuro);
}

.form-control,
.form-select {
    border: 1px solid var(--gris-borde);
    border-radius: 9px;
    padding: 11px 13px;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--azul-rey);
    box-shadow: 0 0 0 .2rem rgba(23,70,162,.12);
}

.btn-guardar {
    background: var(--amarillo-girasol);
    color: #111;
    border: none;
    border-radius: 9px;
    padding: 11px 22px;
    font-weight: 700;
}

.btn-guardar:hover {
    background: var(--azul-rey);
    color: white;
}

.btn-cancelar {
    background: #6c757d;
    color: white;
    border: none;
    border-radius: 9px;
    padding: 11px 22px;
    font-weight: 600;
}

</style>


<div class="container-fluid proveedor-form-container">

    <div class="encabezado-proveedor-form">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>🏭 Registrar Proveedor</h2>

                <p class="mb-0">
                    Registra una empresa que suministra productos al negocio.
                </p>

            </div>

            <div class="col-md-4 text-md-end">

                <a
                    href="index.php?page=proveedores"
                    class="btn btn-volver"
                >
                    ← Volver a Proveedores
                </a>

            </div>

        </div>

    </div>


    <div class="linea-siafe"></div>


    <div class="seccion-formulario">

        <form
            action="index.php?page=guardarProveedor"
            method="POST"
        >

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="form-label">
                        Nombre del proveedor *
                    </label>

                    <input
                        type="text"
                        name="nombre_proveedor"
                        class="form-control"
                        placeholder="Ej: Distribuidora de Alimentos SAS"
                        required
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        NIT
                    </label>

                    <input
                        type="text"
                        name="nit_proveedor"
                        class="form-control"
                        placeholder="Ej: 900123456-7"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono_proveedor"
                        class="form-control"
                        placeholder="Ej: 6011234567"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="correo_proveedor"
                        class="form-control"
                        placeholder="proveedor@empresa.com"
                    >

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Ciudad
                    </label>

                    <input
                        type="text"
                        name="ciudad_proveedor"
                        class="form-control"
                        placeholder="Ej: Bogotá"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Dirección
                    </label>

                    <input
                        type="text"
                        name="direccion_proveedor"
                        class="form-control"
                        placeholder="Dirección del proveedor"
                    >

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        Categoría del proveedor
                    </label>

                    <select
                        name="categoria_proveedor"
                        class="form-select"
                    >

                        <option value="">
                            Seleccionar categoría
                        </option>

                        <option value="Granos y Cereales">
                            Granos y Cereales
                        </option>

                        <option value="Aceites y Condimentos">
                            Aceites y Condimentos
                        </option>

                        <option value="Lácteos">
                            Lácteos
                        </option>

                        <option value="Bebidas">
                            Bebidas
                        </option>

                        <option value="Aseo del Hogar">
                            Aseo del Hogar
                        </option>

                        <option value="Snacks y Mecato">
                            Snacks y Mecato
                        </option>

                        <option value="Enlatados y Conservas">
                            Enlatados y Conservas
                        </option>

                        <option value="Panadería">
                            Panadería
                        </option>

                    </select>

                </div>


                <div class="col-md-4">

                    <label class="form-label">
                        Estado
                    </label>

                    <select
                        name="estado_proveedor"
                        class="form-select"
                    >

                        <option value="Activo">
                            Activo
                        </option>

                        <option value="Inactivo">
                            Inactivo
                        </option>

                    </select>

                </div>

            </div>


            <div class="mt-4 d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-guardar"
                >
                    💾 Guardar Proveedor
                </button>

                <a
                    href="index.php?page=proveedores"
                    class="btn btn-cancelar"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>