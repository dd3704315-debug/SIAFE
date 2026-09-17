<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<div class="container-fluid mt-4">

    <!-- ENCABEZADO -->

    <div class="d-flex justify-content-between align-items-center">

        <h2>Gestión de Clientes</h2>

        <a
            href="index.php?page=dashboard"
            class="btn btn-secondary"
        >
            ← Volver al Menú
        </a>

    </div>

    <hr>


    <!-- TÍTULO Y BOTÓN NUEVO -->

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4>Clientes registrados</h4>

        <a
            href="index.php?page=crearCliente"
            class="btn btn-success"
        >
            + Nuevo Cliente
        </a>

    </div>


    <!-- TABLA -->

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Empresa</th>

                    <th>Documento</th>

                    <th>Nombre</th>

                    <th>Correo</th>

                    <th>Teléfono</th>

                    <th>Ciudad</th>

                    <th>Estado</th>

                    <th>Acciones</th>

                </tr>

            </thead>


            <tbody>

                <?php if (!empty($clientes)): ?>

                    <?php foreach ($clientes as $cliente): ?>

                        <tr>

                            <!-- ID -->

                            <td>
                                <?= htmlspecialchars(
                                    $cliente["id_cliente"]
                                ); ?>
                            </td>


                            <!-- EMPRESA -->

                            <td>
                                <?= htmlspecialchars(
                                    $cliente["razon_social_empresa"]
                                ); ?>
                            </td>


                            <!-- DOCUMENTO -->

                            <td>

                                <?= htmlspecialchars(
                                    $cliente["tipo_documento_cliente"]
                                ); ?>

                                <?= htmlspecialchars(
                                    $cliente["documento_cliente"]
                                ); ?>

                            </td>


                            <!-- NOMBRE -->

                            <td>

                                <?= htmlspecialchars(
                                    $cliente["nombres_cliente"] . " " .
                                    $cliente["apellidos_cliente"]
                                ); ?>

                            </td>


                            <!-- CORREO -->

                            <td>

                                <?= htmlspecialchars(
                                    $cliente["correo_cliente"] ?? ""
                                ); ?>

                            </td>


                            <!-- TELÉFONO -->

                            <td>

                                <?= htmlspecialchars(
                                    $cliente["telefono_cliente"] ?? ""
                                ); ?>

                            </td>


                            <!-- CIUDAD -->

                            <td>

                                <?= htmlspecialchars(
                                    $cliente["ciudad_cliente"] ?? ""
                                ); ?>

                            </td>


                            <!-- ESTADO -->

                            <td>

                                <?php if (
                                    $cliente["estado_cliente"] === "Activo"
                                ): ?>

                                    <span class="badge bg-success">
                                        Activo
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">
                                        Inactivo
                                    </span>

                                <?php endif; ?>

                            </td>


                            <!-- ACCIONES -->

                            <td>

                                <a
                                    href="index.php?page=editarCliente&id=<?= $cliente["id_cliente"]; ?>"
                                    class="btn btn-warning btn-sm"
                                >
                                    Editar
                                </a>


                                <a
                                    href="index.php?page=eliminarCliente&id=<?= $cliente["id_cliente"]; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Desea eliminar este cliente?');"
                                >
                                    Eliminar
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="9"
                            class="text-center"
                        >

                            No hay clientes registrados.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<?php require_once "app/views/layouts/footer.php"; ?>