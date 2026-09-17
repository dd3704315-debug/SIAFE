<?php

require_once "app/middleware/AuthMiddleware.php";
require_once "app/views/layouts/header.php";

?>

<div class="container-fluid p-4">

    <!-- ENCABEZADO -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                ➕ Nueva Venta
            </h2>

            <p class="text-muted mb-0">
                Registra una nueva venta y agrega los productos vendidos.
            </p>

        </div>

        <a
            href="index.php?page=ventas"
            class="btn btn-secondary"
        >
            ← Volver
        </a>

    </div>


    <form
        method="POST"
        action="index.php?page=guardarVenta"
        id="formVenta"
    >

        <!-- =====================================================
             INFORMACIÓN DE LA VENTA
        ====================================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">
                    📋 Información de la venta
                </h5>

            </div>


            <div class="card-body">

                <div class="row g-3">

                    <!-- EMPRESA -->

<div class="col-md-4">

    <label class="form-label">
        Empresa
    </label>

    <input
        type="text"
        class="form-control"
        value="<?= htmlspecialchars(
            $empresa['nombre_comercial_empresa']
            ?? $empresa['razon_social_empresa']
            ?? 'Empresa no encontrada'
        ); ?>"
        readonly
    >

    <input
        type="hidden"
        name="id_empresa"
        value="<?= htmlspecialchars(
            $empresa['id_empresa'] ?? $idEmpresa ?? ''
        ); ?>"
    >

</div>

                    <!-- CLIENTE -->

                    <div class="col-md-4">

                        <label class="form-label">
                            Cliente *
                        </label>

                        <select
                            name="id_cliente"
                            id="id_cliente"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Seleccione un cliente
                            </option>

                            <?php foreach ($clientes as $cliente): ?>

                                <option
                                    value="<?= $cliente["id_cliente"]; ?>"
                                >

                                    <?= htmlspecialchars(
                                        $cliente["nombres_cliente"]
                                        . " "
                                        . $cliente["apellidos_cliente"]
                                    ); ?>

                                    -
                                    <?= htmlspecialchars(
                                        $cliente["documento_cliente"]
                                    ); ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- FACTURA -->

                    <div class="col-md-4">

                        <label class="form-label">
                            Número de factura *
                        </label>

                        <input
                            type="text"
                            name="numero_factura_venta"
                            class="form-control"
                            placeholder="Ej: FAC-0001"
                            required
                        >

                    </div>


                    <!-- MÉTODO DE PAGO -->

                    <div class="col-md-4">

                        <label class="form-label">
                            Método de pago
                        </label>

                        <select
                            name="metodo_pago_venta"
                            class="form-select"
                        >

                            <option value="Efectivo">
                                Efectivo
                            </option>

                            <option value="Tarjeta">
                                Tarjeta
                            </option>

                            <option value="Transferencia">
                                Transferencia
                            </option>

                            <option value="Nequi">
                                Nequi
                            </option>

                            <option value="Daviplata">
                                Daviplata
                            </option>

                        </select>

                    </div>


                    <!-- ESTADO -->

                    <div class="col-md-4">

                        <label class="form-label">
                            Estado
                        </label>

                        <select
                            name="estado_venta"
                            class="form-select"
                        >

                            <option value="Pendiente">
                                Pendiente
                            </option>

                            <option value="Pagada">
                                Pagada
                            </option>

                            <option value="Anulada">
                                Anulada
                            </option>

                        </select>

                    </div>


                    <!-- OBSERVACIÓN -->

                    <div class="col-md-4">

                        <label class="form-label">
                            Observación
                        </label>

                        <input
                            type="text"
                            name="observacion_venta"
                            class="form-control"
                            placeholder="Observaciones de la venta"
                        >

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             PRODUCTOS
        ====================================================== -->

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-primary text-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        📦 Productos
                    </h5>

                    <button
                        type="button"
                        class="btn btn-light btn-sm"
                        id="btnAgregarProducto"
                    >
                        ➕ Agregar producto
                    </button>

                </div>

            </div>


            <div class="card-body">

                <div class="table-responsive">

                    <table
                        class="table table-bordered align-middle"
                        id="tablaProductos"
                    >

                        <thead class="table-light">

                            <tr>

                                <th style="width: 30%;">
                                    Producto
                                </th>

                                <th>
                                    Stock
                                </th>

                                <th>
                                    Cantidad
                                </th>

                                <th>
                                    Precio unitario
                                </th>

                                <th>
                                    Descuento
                                </th>

                                <th>
                                    Impuesto
                                </th>

                                <th>
                                    Subtotal
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>

                        </thead>


                        <tbody id="productosContainer">

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- =====================================================
             TOTALES
        ====================================================== -->

        <div class="row justify-content-end">

            <div class="col-md-5">

                <div class="card shadow-sm">

                    <div class="card-header bg-dark text-white">

                        <h5 class="mb-0">
                            💰 Resumen
                        </h5>

                    </div>


                    <div class="card-body">

                        <!-- SUBTOTAL -->

                        <div class="mb-3">

                            <label class="form-label">
                                Subtotal
                            </label>

                            <input
                                type="number"
                                name="subtotal_venta"
                                id="subtotalVenta"
                                class="form-control"
                                value="0"
                                readonly
                            >

                        </div>


                        <!-- DESCUENTO -->

                        <div class="mb-3">

                            <label class="form-label">
                                Descuento
                            </label>

                            <input
                                type="number"
                                name="descuento_venta"
                                id="descuentoVenta"
                                class="form-control"
                                value="0"
                                min="0"
                                step="0.01"
                            >

                        </div>


                        <!-- IMPUESTO -->

                        <div class="mb-3">

                            <label class="form-label">
                                Impuesto
                            </label>

                            <input
                                type="number"
                                name="impuesto_venta"
                                id="impuestoVenta"
                                class="form-control"
                                value="0"
                                min="0"
                                step="0.01"
                            >

                        </div>


                        <!-- TOTAL -->

                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                TOTAL
                            </label>

                            <input
                                type="number"
                                name="total_venta"
                                id="totalVenta"
                                class="form-control form-control-lg fw-bold"
                                value="0"
                                readonly
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             BOTONES
        ====================================================== -->

        <div class="d-flex justify-content-end gap-2 mt-4">

            <a
                href="index.php?page=ventas"
                class="btn btn-secondary"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-success"
            >
                💾 Guardar venta
            </button>

        </div>

    </form>

</div>


<!-- ==========================================================
     JAVASCRIPT
========================================================== -->

<script>

const productos = <?= json_encode($productos); ?>;

let contadorProductos = 0;


// ==========================================================
// AGREGAR PRODUCTO
// ==========================================================

document
    .getElementById("btnAgregarProducto")
    .addEventListener("click", function () {

        agregarProducto();

    });


function agregarProducto()
{
    contadorProductos++;

    const container =
        document.getElementById("productosContainer");


    const fila =
        document.createElement("tr");

    fila.dataset.fila = contadorProductos;


    let opciones = `
        <option value="">
            Seleccione un producto
        </option>
    `;


    productos.forEach(function(producto) {

        opciones += `
           <option
    value="${producto.id_producto}"
    data-precio="${producto.precio_venta_producto ?? 0}"
    data-stock="${producto.stock_producto ?? 0}"
    ${parseInt(producto.stock_producto ?? 0) <= 0 ? "disabled" : ""}
>
    ${producto.nombre_producto}
    ${parseInt(producto.stock_producto ?? 0) <= 0 ? " - AGOTADO" : ""}
</option>
        `;

    });


    fila.innerHTML = `

        <td>

            <select
                name="productos[${contadorProductos}][id_producto]"
                class="form-select productoSelect"
                required
            >

                ${opciones}

            </select>

        </td>


        <td>

            <input
                type="number"
                class="form-control stockProducto"
                value="0"
                readonly
            >

        </td>


        <td>

            <input
                type="number"
                name="productos[${contadorProductos}][cantidad]"
                class="form-control cantidadProducto"
                value="1"
                min="1"
                step="1"
                required
            >

        </td>


        <td>

            <input
                type="number"
                name="productos[${contadorProductos}][precio_unitario]"
                class="form-control precioProducto"
                value="0"
                min="0"
                step="0.01"
                readonly
            >

        </td>


        <td>

            <input
                type="number"
                name="productos[${contadorProductos}][descuento]"
                class="form-control descuentoProducto"
                value="0"
                min="0"
                step="0.01"
            >

        </td>


        <td>

            <input
                type="number"
                name="productos[${contadorProductos}][impuesto]"
                class="form-control impuestoProducto"
                value="0"
                min="0"
                step="0.01"
            >

        </td>


        <td>

            <input
                type="number"
                name="productos[${contadorProductos}][subtotal]"
                class="form-control subtotalProducto"
                value="0"
                readonly
            >

        </td>


        <td>

            <button
                type="button"
                class="btn btn-danger btn-sm btnEliminarProducto"
            >
                🗑️
            </button>

        </td>

    `;


    container.appendChild(fila);


    configurarFila(fila);

    calcularTotales();
}


// ==========================================================
// CONFIGURAR FILA
// ==========================================================

function configurarFila(fila)
{

    const select =
        fila.querySelector(".productoSelect");

    const cantidad =
        fila.querySelector(".cantidadProducto");

    const descuento =
        fila.querySelector(".descuentoProducto");

    const impuesto =
        fila.querySelector(".impuestoProducto");

    const eliminar =
        fila.querySelector(".btnEliminarProducto");


    select.addEventListener("change", function() {

        const opcion =
            this.options[this.selectedIndex];


        const precio =
            parseFloat(
                opcion.dataset.precio || 0
            );


        const stock =
            parseInt(
                opcion.dataset.stock || 0
            );


        fila.querySelector(".precioProducto").value =
            precio.toFixed(2);


        fila.querySelector(".stockProducto").value =
            stock;


        calcularFila(fila);

    });


  cantidad.addEventListener(
    "input",
    function() {

        const stock = parseInt(
            fila.querySelector(".stockProducto").value || 0
        );

        let valor = parseInt(this.value || 0);

        if (valor < 1) {
            valor = 1;
            this.value = 1;
        }

        if (valor > stock) {

            alert(
                "⚠️ Stock insuficiente.\n\n" +
                "Stock disponible: " + stock +
                "\nCantidad solicitada: " + valor
            );

            this.value = stock > 0 ? stock : 0;
        }

        calcularFila(fila);
    }
);


    descuento.addEventListener(
        "input",
        function() {

            calcularFila(fila);

        }
    );


    impuesto.addEventListener(
        "input",
        function() {

            calcularFila(fila);

        }
    );


    eliminar.addEventListener(
        "click",
        function() {

            fila.remove();

            calcularTotales();

        }
    );

}


// ==========================================================
// CALCULAR FILA
// ==========================================================

function calcularFila(fila)
{

    const cantidad =
        parseFloat(
            fila.querySelector(".cantidadProducto").value || 0
        );


    const precio =
        parseFloat(
            fila.querySelector(".precioProducto").value || 0
        );


    const descuento =
        parseFloat(
            fila.querySelector(".descuentoProducto").value || 0
        );


    const impuesto =
        parseFloat(
            fila.querySelector(".impuestoProducto").value || 0
        );


    const subtotalBase =
        cantidad * precio;


    const subtotal =
        subtotalBase
        - descuento
        + impuesto;


    fila.querySelector(".subtotalProducto").value =
        subtotal.toFixed(2);


    calcularTotales();

}


// ==========================================================
// CALCULAR TOTALES
// ==========================================================

function calcularTotales()
{

    let subtotal = 0;

    const filas =
        document.querySelectorAll(
            "#productosContainer tr"
        );


    filas.forEach(function(fila) {

        const cantidad =
            parseFloat(
                fila.querySelector(".cantidadProducto").value || 0
            );


        const precio =
            parseFloat(
                fila.querySelector(".precioProducto").value || 0
            );


        subtotal += cantidad * precio;

    });


    const descuento =
        parseFloat(
            document.getElementById("descuentoVenta").value || 0
        );


    const impuesto =
        parseFloat(
            document.getElementById("impuestoVenta").value || 0
        );


    const total =
        subtotal
        - descuento
        + impuesto;


    document.getElementById("subtotalVenta").value =
        subtotal.toFixed(2);


    document.getElementById("totalVenta").value =
        total.toFixed(2);

}


// ==========================================================
// CAMBIOS EN DESCUENTO E IMPUESTO GENERAL
// ==========================================================

document
    .getElementById("descuentoVenta")
    .addEventListener(
        "input",
        calcularTotales
    );


document
    .getElementById("impuestoVenta")
    .addEventListener(
        "input",
        calcularTotales
    );


// ==========================================================
// VALIDAR FORMULARIO
// ==========================================================

document
    .getElementById("formVenta")
    .addEventListener("submit", function(event) {

        const filas =
            document.querySelectorAll(
                "#productosContainer tr"
            );


        if (filas.length === 0) {

            event.preventDefault();

            alert(
                "Debe agregar al menos un producto a la venta."
            );

            return;

        }


        for (const fila of filas) {

            const cantidad =
                parseFloat(
                    fila.querySelector(
                        ".cantidadProducto"
                    ).value || 0
                );


            const stock =
                parseFloat(
                    fila.querySelector(
                        ".stockProducto"
                    ).value || 0
                );


            if (cantidad > stock) {

                event.preventDefault();

                alert(
                    "La cantidad solicitada supera el stock disponible."
                );

                return;

            }

        }

    });

</script>


<?php

require_once "app/views/layouts/footer.php";

?>