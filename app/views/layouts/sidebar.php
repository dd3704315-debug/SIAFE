<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION["rol"] ?? null;
$nombre = $_SESSION["nombre"] ?? "";
$apellido = $_SESSION["apellido"] ?? "";

?>

<div class="bg-dark text-white vh-100 p-3">

    <h3>SIAFE</h3>
    <hr>

    <p>
        <?= htmlspecialchars($nombre . " " . $apellido); ?>
    </p>

    <ul class="nav flex-column">

        <!-- DASHBOARD -->
        <li class="nav-item mb-2">
            <a class="nav-link text-white" href="index.php?page=dashboard">
                🏠 Dashboard
            </a>
        </li>

        <!-- ROLES - SOLO SUPERADMIN -->
        <?php if ($rol == 1): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=roles">
                    🔐 Gestión de Roles
                </a>
            </li>
        <?php endif; ?>

        <!-- USUARIOS - SUPERADMIN Y ADMIN -->
        <?php if (in_array($rol, [1, 2])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=usuarios">
                    👥 Gestión de Usuarios
                </a>
            </li>
        <?php endif; ?>

        <!-- EMPRESAS - SUPERADMIN Y ADMIN -->
        <?php if (in_array($rol, [1, 2])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=empresas">
                    🏢 Gestión de Empresas
                </a>
            </li>
        <?php endif; ?>

        <!-- PRODUCTOS - LOS 3 ROLES -->
        <?php if (in_array($rol, [1, 2, 3])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=productos">
                    📦 Productos
                </a>
            </li>
        <?php endif; ?>

        <!-- CLIENTES - LOS 3 ROLES -->
        <?php if (in_array($rol, [1, 2, 3])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=clientes">
                    👥 Gestión de Clientes
                </a>
            </li>
        <?php endif; ?>

        <!-- VENTAS - LOS 3 ROLES -->
        <?php if (in_array($rol, [1, 2, 3])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=ventas">
                    💰 Ventas
                </a>
            </li>
        <?php endif; ?>

        <!-- INGRESOS - SUPERADMIN Y ADMIN -->
        <?php if (in_array($rol, [1, 2])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=ingresos">
                    💵 Gestión de Ingresos
                </a>
            </li>
        <?php endif; ?>

        <!-- GASTOS - SUPERADMIN Y ADMIN -->
        <?php if (in_array($rol, [1, 2])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=gastos">
                    💸 Gestión de Gastos
                </a>
            </li>
        <?php endif; ?>

        <!-- INTELIGENCIA ARTIFICIAL - SUPERADMIN Y ADMIN -->
<?php if (in_array($rol, [1, 2])): ?>
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="index.php?page=ia">
            🤖 Inteligencia Artificial
        </a>
    </li>
<?php endif; ?>

        <!-- PRESUPUESTOS - SUPERADMIN Y ADMIN -->
        <?php if (in_array($rol, [1, 2])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=presupuestos">
                    📊 Presupuestos
                </a>
            </li>
        <?php endif; ?>

        <!-- REPORTES - SUPERADMIN Y ADMIN -->
        <?php if (in_array($rol, [1, 2])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=reportes">
                    📑 Reportes
                </a>
            </li>
        <?php endif; ?>

        <!-- INDICADORES - SUPERADMIN Y ADMIN -->
        <?php if (in_array($rol, [1, 2])): ?>
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="index.php?page=indicadores">
                    📈 Indicadores
                </a>
            </li>
        <?php endif; ?>

        <hr>

        <!-- CERRAR SESIÓN -->
        <li class="nav-item">
            <a class="nav-link text-danger" href="index.php?page=logout"
               onclick="return confirm('¿Desea cerrar sesión?');">
                🚪 Cerrar sesión
            </a>
        </li>

    </ul>
</div>