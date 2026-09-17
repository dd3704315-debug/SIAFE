<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

$mensaje = $_SESSION["mensaje_proveedor"] ?? null;
$tipoMensaje = $_SESSION["tipo_mensaje_proveedor"] ?? "success";

unset($_SESSION["mensaje_proveedor"]);
unset($_SESSION["tipo_mensaje_proveedor"]);

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
    background: var(--gris-fondo);
}

.proveedores-container {
    padding: 25px;
}

.encabezado-proveedores {
    background: linear-gradient(
        135deg,
        var(--azul-rey),
        var(--azul-rey-oscuro)
    );
    color: white;
    border-radius: 15px;
    padding: 25px 30px;
    margin-bottom: 20px;
    box-shadow: 0 8px 20px rgba(16, 53, 125, 0.18);
}

.encabezado-proveedores h2 {
    font-weight: 700;
    margin-bottom: 8px;
}

.encabezado-proveedores p {
    margin-bottom: 0;
    opacity: .9;
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

.seccion-proveedores {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 18px rgba(0,0,0,.07);
}

.titulo-seccion {
    color: var(--azul-rey-oscuro);
    font-weight: 700;
    margin-bottom: 5px;
}

.subtitulo-seccion {
    color: #6c757d;
    margin-bottom: 20px;
}

.btn-nuevo-proveedor {
    background: var(--amarillo-girasol);
    color: #111;
    border: none;
    border-radius: 9px;
    padding: 10px 18px;
    font-weight: 700;
}

.btn-nuevo-proveedor:hover {
    background: var(--azul-rey);
    color: white;
}

.tabla-proveedores {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
}

.tabla-proveedores thead th {
    background: var(--azul-rey);
    color: white;
    padding: 14px 12px;
    border: none;
    font-size: 14px;
}

.tabla-proveedores thead th:first-child {
    border-radius: 12px 0 0 0;
}

.tabla-proveedores thead th:last-child {
    border-radius: 0 12px 0 0;
}

.tabla-proveedores tbody td {
    padding: 14px 12px;
    border-bottom: 1px solid var(--gris-borde);
    vertical-align: middle;
    color: var(--texto);
}

.tabla-proveedores tbody tr:hover {
    background: var(--azul-claro);
}

.id-proveedor {
    font-weight: 700;
    color: var(--azul-rey);
}

.nombre-proveedor {
    font-weight: 700;
}

.categoria-proveedor {
    font-weight: 600;
}

.ciudad-proveedor {
    color: #555;
}

.badge-estado {
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.badge-activo {
    background: #dff6e5;
    color: #198754;
}

.badge-inactivo {
    background: #f8d7da;
    color: #b02a37;
}

.acciones-proveedor {
    white-space: nowrap;
}

.btn-editar-proveedor {
    background: var(--amarillo-girasol);
    color: #111;
    border: none;
    border-radius: 7px;
    padding: 7px 11px;
    font-weight: 600;
    text-decoration: none;
}

.btn-editar-proveedor:hover {
    background: var(--amarillo-oscuro);
    color: #111;
}

.btn-eliminar-proveedor {
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 7px;
    padding: 7px 11px;
    font-weight: 600;
    text-decoration: none;
}

.btn-eliminar-proveedor:hover {
    background: #bb2d3b;
    color: white;
}

.sin-proveedores {
    text-align: center;
    padding: 40px;
    color: #6c757d;
}

@media (max-width: 768px) {

    .proveedores-container {
        padding: 15px;
    }

    .seccion-proveedores {
        padding: 15px;
        overflow-x: auto;
    }

    .tabla-proveedores {
        min-width: 900px;
    }

    .btn-nuevo-proveedor {
        margin-top: 15px;
    }
}

</style>


<div class="container-fluid proveedores-container">

    <div class="encabezado-proveedores">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h2>🏭 Gestión de Proveedores</h2>

                <p>
                    Administra las empresas que suministran productos
                    e inventario al negocio.
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


    <div class="linea-siafe"></div>


    <?php if ($mensaje): ?>

        <div class="alert alert-<?= htmlspecialchars($tipoMensaje) ?> alert-dismissible fade show">

            <?= htmlspecialchars($mensaje) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <div class="seccion-proveedores">

        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

            <div>

                <h4 class="titulo-seccion">
                    Proveedores registrados
                </h4>

                <p class="subtitulo-seccion">
                    Consulta y administra los proveedores del negocio.
                </p>

            </div>

            <div>

                <a
                    href="index.php?page=crearProveedor"
                    class="btn btn-nuevo-proveedor"
                >
                    + Nuevo Proveedor
                </a>

            </div>

        </div>


        <?php if (!empty($proveedores)): ?>

            <div class="table-responsive">

                <table class="tabla-proveedores">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Proveedor</th>

                            <th>NIT</th>

                            <th>Teléfono</th>

                            <th>Correo</th>

                            <th>Categoría</th>

                            <th>Ciudad</th>

                            <th>Estado</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($proveedores as $proveedor): ?>

                            <tr>

                                <td class="id-proveedor">
                                    #<?= htmlspecialchars($proveedor["id_proveedor"]) ?>
                                </td>

                                <td class="nombre-proveedor">
                                    <?= htmlspecialchars($proveedor["nombre_proveedor"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($proveedor["nit_proveedor"] ?: "—") ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($proveedor["telefono_proveedor"] ?: "—") ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($proveedor["correo_proveedor"] ?: "—") ?>
                                </td>

                                <td class="categoria-proveedor">
                                    <?= htmlspecialchars($proveedor["categoria_proveedor"] ?: "—") ?>
                                </td>

                                <td class="ciudad-proveedor">
                                    <?= htmlspecialchars($proveedor["ciudad_proveedor"] ?: "—") ?>
                                </td>

                                <td>

                                    <?php if ($proveedor["estado_proveedor"] === "Activo"): ?>

                                        <span class="badge-estado badge-activo">
                                            Activo
                                        </span>

                                    <?php else: ?>

                                        <span class="badge-estado badge-inactivo">
                                            Inactivo
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td class="acciones-proveedor">

                                    <a
                                        href="index.php?page=editarProveedor&id=<?= $proveedor["id_proveedor"] ?>"
                                        class="btn-editar-proveedor"
                                    >
                                        ✏️ Editar
                                    </a>

                                    <a
                                        href="index.php?page=eliminarProveedor&id=<?= $proveedor["id_proveedor"] ?>"
                                        class="btn-eliminar-proveedor"
                                        onclick="return confirm('¿Está seguro de eliminar este proveedor?');"
                                    >
                                        🗑️
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="sin-proveedores">

                <h5>🏭 No hay proveedores registrados</h5>

                <p>
                    Comienza registrando el primer proveedor del negocio.
                </p>

                <a
                    href="index.php?page=crearProveedor"
                    class="btn btn-nuevo-proveedor"
                >
                    + Registrar proveedor
                </a>

            </div>

        <?php endif; ?>

    </div>

</div>