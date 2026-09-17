<?php require_once "app/views/layouts/header.php"; ?>

<style>

    :root {
        --azul-siafe: #3157A4;
        --azul-oscuro: #244582;
        --azul-cielo: #66D9FF;
        --gris-fondo: #E9ECEF;
    }

    body {
        background-color: #ffffff;
        font-family: -apple-system, "Segoe UI", Arial, sans-serif;
    }

    /* ===== BARRA SUPERIOR ===== */

    .siafe-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 40px;
        border-bottom: 1px solid #eee;
    }

    .siafe-nav .marca {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        font-size: 1.3rem;
        color: var(--azul-siafe);
    }

    .siafe-nav .marca img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .siafe-nav .acciones a {
        margin-left: 12px;
        text-decoration: none;
    }

    .btn-outline-siafe {
        border: 1.5px solid var(--azul-siafe);
        color: var(--azul-siafe);
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-outline-siafe:hover {
        background: var(--azul-siafe);
        color: #fff;
    }

    .btn-siafe {
        background: var(--azul-siafe);
        color: #fff;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
    }

    .btn-siafe:hover {
        background: var(--azul-oscuro);
        color: #fff;
    }

    /* ===== HERO ===== */

    .hero {
        text-align: center;
        padding: 70px 20px 50px;
        background: linear-gradient(180deg, #ffffff 0%, var(--gris-fondo) 100%);
    }

    .hero h1 {
        font-size: 2.4rem;
        font-weight: 800;
        color: #1c2b4a;
        max-width: 720px;
        margin: 0 auto 18px;
    }

    .hero h1 span {
        color: var(--azul-siafe);
    }

    .hero p {
        max-width: 600px;
        margin: 0 auto 30px;
        color: #555;
        font-size: 1.1rem;
    }

    .hero .btn-siafe {
        padding: 12px 30px;
        font-size: 1.05rem;
    }

    /* ===== SECCIONES ===== */

    section {
        padding: 60px 40px;
        max-width: 1100px;
        margin: 0 auto;
    }

    section h2 {
        text-align: center;
        font-weight: 800;
        color: #1c2b4a;
        margin-bottom: 10px;
    }

    section > p.subtitulo {
        text-align: center;
        color: #666;
        max-width: 560px;
        margin: 0 auto 40px;
    }

    /* ===== TARJETAS DE MÓDULOS ===== */

    .grid-modulos {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }

    .tarjeta-modulo {
        background: var(--gris-fondo);
        border-radius: 14px;
        padding: 24px;
    }

    .tarjeta-modulo .icono {
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    .tarjeta-modulo h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1c2b4a;
        margin-bottom: 6px;
    }

    .tarjeta-modulo p {
        font-size: 0.92rem;
        color: #555;
        margin: 0;
    }

    /* ===== PLANES ===== */

    .grid-planes {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        align-items: stretch;
    }

    .tarjeta-plan {
        border: 1.5px solid #e2e2e2;
        border-radius: 16px;
        padding: 28px 24px;
        display: flex;
        flex-direction: column;
    }

    .tarjeta-plan.destacado {
        border-color: var(--azul-siafe);
        box-shadow: 0 10px 30px rgba(49, 87, 164, 0.15);
        position: relative;
    }

    .tarjeta-plan.destacado::before {
        content: "Más elegido";
        position: absolute;
        top: -13px;
        left: 24px;
        background: var(--azul-siafe);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
    }

    .tarjeta-plan h3 {
        font-weight: 800;
        color: #1c2b4a;
        margin-bottom: 4px;
    }

    .tarjeta-plan .descripcion-plan {
        font-size: 0.88rem;
        color: #666;
        margin-bottom: 16px;
        min-height: 40px;
    }

    .tarjeta-plan .precio {
        font-size: 2rem;
        font-weight: 800;
        color: var(--azul-siafe);
        margin-bottom: 2px;
    }

    .tarjeta-plan .precio small {
        font-size: 0.95rem;
        font-weight: 500;
        color: #777;
    }

    .tarjeta-plan .precio-anual {
        font-size: 0.82rem;
        color: #888;
        margin-bottom: 18px;
    }

    .tarjeta-plan ul {
        list-style: none;
        padding: 0;
        margin: 0 0 22px;
        flex-grow: 1;
    }

    .tarjeta-plan ul li {
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 10px;
        padding-left: 22px;
        position: relative;
    }

    .tarjeta-plan ul li::before {
        content: "✔";
        position: absolute;
        left: 0;
        color: var(--azul-siafe);
        font-weight: 700;
    }

    /* ===== CTA FINAL ===== */

    .cta-final {
        background: var(--azul-siafe);
        color: #fff;
        text-align: center;
        padding: 60px 20px;
        border-radius: 20px;
        margin: 0 40px 60px;
    }

    .cta-final h2 {
        color: #fff;
    }

    .cta-final .btn-siafe {
        background: #fff;
        color: var(--azul-siafe);
        padding: 12px 30px;
        font-size: 1.05rem;
    }

    .cta-final .btn-siafe:hover {
        background: var(--gris-fondo);
    }

    @media (max-width: 900px) {
        .grid-modulos, .grid-planes {
            grid-template-columns: 1fr;
        }
    }

</style>


<!-- ===== BARRA SUPERIOR ===== -->

<div class="siafe-nav">
    <div class="marca">
        <img src="public/img/logo.jpg" alt="Logo SIAFE">
        SIAFE
    </div>
    <div class="acciones">
        <a href="index.php?page=login" class="btn-outline-siafe">Iniciar sesión</a>
        <a href="index.php?page=registro" class="btn-siafe">Crear cuenta</a>
    </div>
</div>


<!-- ===== HERO ===== -->

<div class="hero">
    <h1>Organiza las finanzas de tu empresa con <span>SIAFE</span></h1>
    <p>
        Ventas, gastos, presupuestos e indicadores financieros en un solo lugar,
        con análisis inteligente para tomar mejores decisiones.
    </p>
    <a href="index.php?page=registro" class="btn-siafe">Crear mi cuenta gratis</a>
</div>


<!-- ===== QUÉ HACE SIAFE ===== -->

<section>
    <h2>¿Qué puedes hacer con SIAFE?</h2>
    <p class="subtitulo">
        Todo lo que tu empresa necesita para controlar su operación financiera del día a día.
    </p>

    <div class="grid-modulos">

        <div class="tarjeta-modulo">
            <div class="icono">🛒</div>
            <h3>Ventas y clientes</h3>
            <p>Registra tus ventas, controla tus clientes y lleva el inventario de productos al día.</p>
        </div>

        <div class="tarjeta-modulo">
            <div class="icono">💵</div>
            <h3>Ingresos y gastos</h3>
            <p>Lleva el control de todo lo que entra y sale de tu empresa, categorizado y a tiempo.</p>
        </div>

        <div class="tarjeta-modulo">
            <div class="icono">📊</div>
            <h3>Presupuestos</h3>
            <p>Define presupuestos por período y compáralos contra lo realmente ejecutado.</p>
        </div>

        <div class="tarjeta-modulo">
            <div class="icono">📈</div>
            <h3>Indicadores financieros</h3>
            <p>Visualiza la salud financiera de tu empresa con indicadores claros y actualizados.</p>
        </div>

        <div class="tarjeta-modulo">
            <div class="icono">🤝</div>
            <h3>Proveedores</h3>
            <p>Administra tus proveedores y mantén el control de tu cadena de abastecimiento.</p>
        </div>

        <div class="tarjeta-modulo">
            <div class="icono">🤖</div>
            <h3>Análisis Inteligente</h3>
            <p>Detecta tendencias, anomalías y recomendaciones automáticas sobre tu empresa.</p>
        </div>

    </div>
</section>


<!-- ===== PLANES Y PRECIOS ===== -->

<section id="planes">
    <h2>Planes para cada etapa de tu empresa</h2>
    <p class="subtitulo">
        Elige el plan que más se ajuste a tu negocio. Puedes pagar mes a mes o ahorrar pagando anual.
    </p>

    <```php
<div class="grid-planes">

    <?php foreach ($planes as $p): ?>

        <div class="tarjeta-plan">

            <h3>
                <?= htmlspecialchars($p["nombre_plan"]) ?>
            </h3>

            <p class="descripcion-plan">
                <?= htmlspecialchars($p["descripcion_plan"] ?? "Plan para administrar y analizar la información de tu empresa.") ?>
            </p>

            <div class="precio">

                <?php if ((float)$p["precio_plan"] == 0): ?>

                    Gratis

                <?php else: ?>

                    $<?= number_format((float)$p["precio_plan"], 0, ",", ".") ?>

                <?php endif; ?>

                <small>
                    <?= htmlspecialchars($p["periodo_plan"]) ?>
                </small>

            </div>

            <ul>

                <?php if ($p["nombre_plan"] === "Básico"): ?>

                    <li>Gestión financiera básica</li>
                    <li>Registro de ingresos y gastos</li>
                    <li>Control de información empresarial</li>

                <?php elseif ($p["nombre_plan"] === "Empresarial"): ?>

                    <li>Gestión de productos e inventario</li>
                    <li>Control de ventas y gastos</li>
                    <li>Reportes financieros</li>

                <?php elseif ($p["nombre_plan"] === "Inteligente"): ?>

                    <li>Análisis financiero avanzado</li>
                    <li>Indicadores financieros</li>
                    <li>Análisis inteligente con IA</li>

                <?php else: ?>

                    <li>Funciones incluidas según el plan</li>

                <?php endif; ?>

            </ul>

            <a
                href="index.php?page=registro&plan=<?= (int)$p["id_plan"] ?>"
                class="btn-siafe"
                style="text-align:center;"
            >
                Elegir <?= htmlspecialchars($p["nombre_plan"]) ?>
            </a>

        </div>

    <?php endforeach; ?>

</div>
</section>


<!-- ===== CTA FINAL ===== -->

<div class="cta-final">
    <h2>Empieza a usar SIAFE hoy mismo</h2>
    <p>Crea tu cuenta en minutos, elige tu plan y empieza a organizar tu empresa.</p>
    <a href="index.php?page=registro" class="btn-siafe">Crear mi cuenta</a>
</div>


<?php require_once "app/views/layouts/footer.php"; ?>
