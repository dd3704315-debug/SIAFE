<?php
$resultado = $resultado ?? null;
$indicadores = $indicadores ?? [];
$empresas = $empresas ?? [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Indicadores Financieros - SIAFE</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Indicadores Financieros</h2>
            <p class="text-muted mb-0">
                Análisis financiero de las empresas registradas en SIAFE.
            </p>
        </div>

        <a href="index.php?page=dashboard"
           class="btn btn-secondary">
            Volver al Dashboard
        </a>
    </div>


    <!-- SELECCIÓN DE EMPRESA -->

    <div class="card shadow-sm mb-4">

        <div class="card-header">
            <h5 class="mb-0">Calcular indicadores</h5>
        </div>

        <div class="card-body">

            <form method="GET" action="index.php">

                <input type="hidden"
                       name="page"
                       value="indicadores">

                <div class="row align-items-end">

                    <div class="col-md-8">

                        <label class="form-label">
                            Seleccionar empresa
                        </label>

                        <select
                            name="id_empresa"
                            class="form-select"
                            required>

                            <option value="">
                                Seleccione una empresa
                            </option>

                            <?php foreach ($empresas as $empresa): ?>

                                <option
                                    value="<?= $empresa['id_empresa'] ?>"
                                    <?= ($idEmpresaSeleccionada == $empresa['id_empresa']) ? 'selected' : '' ?>>

                                    <?= htmlspecialchars($empresa['razon_social_empresa']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-4">

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Calcular indicadores

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <?php if ($resultado): ?>

        <!-- RESULTADOS -->

        <div class="row g-4 mb-4">

            <!-- INGRESOS -->

            <div class="col-md-3">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Total ingresos
                        </h6>

                        <h3 class="fw-bold text-success">

                            $<?= number_format(
                                $resultado['total_ingresos'],
                                0,
                                ',',
                                '.'
                            ) ?>

                        </h3>

                    </div>

                </div>

            </div>


            <!-- GASTOS -->

            <div class="col-md-3">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Total gastos
                        </h6>

                        <h3 class="fw-bold text-danger">

                            $<?= number_format(
                                $resultado['total_gastos'],
                                0,
                                ',',
                                '.'
                            ) ?>

                        </h3>

                    </div>

                </div>

            </div>


            <!-- UTILIDAD -->

            <div class="col-md-3">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Utilidad
                        </h6>

                        <h3 class="fw-bold">

                            $<?= number_format(
                                $resultado['utilidad'],
                                0,
                                ',',
                                '.'
                            ) ?>

                        </h3>

                    </div>

                </div>

            </div>


            <!-- RENTABILIDAD -->

            <div class="col-md-3">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Rentabilidad
                        </h6>

                        <h3 class="fw-bold">

                            <?= number_format(
                                $resultado['rentabilidad'],
                                2,
                                ',',
                                '.'
                            ) ?>%

                        </h3>

                    </div>

                </div>

            </div>

        </div>


        <!-- DETALLE DE INDICADORES -->

        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <h5 class="mb-0">
                    Resultado del análisis
                </h5>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <p class="mb-2">
                            <strong>Índice de liquidez operativa:</strong>
                        </p>

                        <h4>
                            <?= number_format(
                                $resultado['liquidez'],
                                2,
                                ',',
                                '.'
                            ) ?>
                        </h4>

                        <small class="text-muted">
                            Relación entre los ingresos y los gastos registrados.
                        </small>

                    </div>


                    <div class="col-md-6">

                        <p class="mb-2">
                            <strong>Rentabilidad:</strong>
                        </p>

                        <h4>
                            <?= number_format(
                                $resultado['rentabilidad'],
                                2,
                                ',',
                                '.'
                            ) ?>%
                        </h4>

                        <small class="text-muted">
                            Porcentaje de utilidad respecto a los ingresos.
                        </small>

                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>


    <!-- HISTORIAL -->

    <div class="card shadow-sm">

        <div class="card-header">

            <h5 class="mb-0">
                Historial de indicadores
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>Empresa</th>
                            <th>Liquidez</th>
                            <th>Rentabilidad</th>
                            <th>Fecha</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($indicadores)): ?>

                            <?php foreach ($indicadores as $indicador): ?>

                                <tr>

                                    <td>
                                        <?= htmlspecialchars(
                                            $indicador['razon_social_empresa']
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= number_format(
                                            $indicador['liquidez'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= number_format(
                                            $indicador['rentabilidad'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>%
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            $indicador['fecha_calculo']
                                        ) ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="4"
                                    class="text-center text-muted">

                                    No existen indicadores calculados todavía.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>
