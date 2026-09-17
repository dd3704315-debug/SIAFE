<style>

    :root {
        --azul-siafe: #3157A4;
        --azul-oscuro: #244582;
        --gris-fondo: #E9ECEF;
    }

    body {
        background-color: var(--gris-fondo);
        font-family: -apple-system, "Segoe UI", Arial, sans-serif;
    }

    .asistente-contenedor {
        max-width: 640px;
        margin: 40px auto 60px;
        padding: 0 20px;
    }

    .asistente-logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .asistente-logo img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
    }

    .asistente-pasos {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 30px;
    }

    .asistente-pasos .paso-punto {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        color: #888;
        width: 90px;
        text-align: center;
    }

    .asistente-pasos .paso-punto .circulo {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #999;
    }

    .asistente-pasos .paso-punto.activo .circulo {
        border-color: var(--azul-siafe);
        color: var(--azul-siafe);
    }

    .asistente-pasos .paso-punto.completado .circulo {
        background: var(--azul-siafe);
        border-color: var(--azul-siafe);
        color: #fff;
    }

    .asistente-pasos .paso-punto.activo,
    .asistente-pasos .paso-punto.completado {
        color: #1c2b4a;
        font-weight: 600;
    }

    .asistente-tarjeta {
        background: #fff;
        border-radius: 16px;
        padding: 32px 30px;
        box-shadow: 0 6px 24px rgba(0,0,0,0.06);
    }

    .asistente-tarjeta h2 {
        font-weight: 800;
        color: #1c2b4a;
        margin-bottom: 4px;
    }

    .asistente-tarjeta > p.ayuda {
        color: #666;
        font-size: 0.92rem;
        margin-bottom: 22px;
    }

    .asistente-tarjeta label {
        font-weight: 600;
        font-size: 0.88rem;
        color: #333;
        margin-bottom: 4px;
    }

    .asistente-tarjeta .form-control {
        border-radius: 8px;
        padding: 9px 12px;
        margin-bottom: 14px;
    }

    .asistente-tarjeta .form-control:focus {
        border-color: var(--azul-siafe);
        box-shadow: 0 0 0 0.15rem rgba(49,87,164,0.15);
    }

    .btn-siafe {
        background: var(--azul-siafe);
        color: #fff;
        border: none;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-siafe:hover {
        background: var(--azul-oscuro);
        color: #fff;
    }

    .btn-volver {
        color: var(--azul-siafe);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .aviso-error {
        background: #fdecea;
        color: #b3261e;
        border: 1px solid #f5c2c0;
        padding: 10px 14px;
        border-radius: 8px;
        font-size: 0.88rem;
        margin-bottom: 18px;
    }

    .plan-opcion {
        border: 1.5px solid #e2e2e2;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 14px;
        cursor: pointer;
        display: block;
    }

    .plan-opcion input {
        margin-right: 10px;
    }

    .plan-opcion .nombre-plan {
        font-weight: 700;
        color: #1c2b4a;
    }

    .plan-opcion .precio-plan {
        color: var(--azul-siafe);
        font-weight: 700;
        float: right;
    }

    .ciclo-opciones {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .ciclo-opciones label {
        flex: 1;
        border: 1.5px solid #e2e2e2;
        border-radius: 10px;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        font-size: 0.88rem;
        font-weight: 600;
        color: #444;
    }

    .resumen-linea {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        font-size: 0.92rem;
    }

    .resumen-linea:last-of-type {
        border-bottom: none;
        font-weight: 700;
        font-size: 1.05rem;
        color: var(--azul-siafe);
    }

</style>
