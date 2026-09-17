<?php

/**
 * =====================================================================
 * CONFIGURACIÓN DEL MÓDULO DE IA
 * =====================================================================
 *
 * Aquí se centralizan los parámetros que antes estaban "hardcodeados"
 * dentro de IA.php: cuántos meses analizar, qué umbrales disparan una
 * alerta, y si se activa la narrativa generada por un LLM externo.
 *
 * IMPORTANTE: nunca subas una API key real a un repositorio público.
 * En producción, léela desde una variable de entorno, no desde este
 * archivo (usa getenv('ANTHROPIC_API_KEY') en vez de escribirla aquí).
 * =====================================================================
 */

return [

    // Cuántos meses hacia atrás se usan para calcular tendencias
    "meses_historico" => 6,

    // Umbrales de alerta (ajustables sin tocar código)
    "umbrales" => [
        "liquidez_critica"        => 1.0,   // ingresos/gastos < 1 = alerta roja
        "liquidez_baja"           => 1.2,
        "rentabilidad_critica"    => 0.0,   // % utilidad sobre ingresos
        "rentabilidad_baja"       => 5.0,
        "desviacion_presupuesto"  => 15.0,  // % de desviación gasto real vs presupuestado
        "anomalia_zscore"         => 2.0,   // desviaciones estándar para marcar un gasto atípico
    ],

    // ------------------------------------------------------------------
    // NARRATIVA CON IA GENERATIVA (OPCIONAL)
    // ------------------------------------------------------------------
    // Si "activo" está en false, el sistema genera el resumen ejecutivo
    // con plantillas locales (sigue siendo dinámico según los datos,
    // solo que sin lenguaje natural generado por un LLM).
    //
    // Si lo activas, necesitas tu propia API key de Anthropic
    // (https://console.anthropic.com) y revisar el nombre de modelo
    // vigente en https://docs.claude.com — no lo dejes fijo aquí sin
    // confirmarlo, los nombres de modelo cambian con el tiempo.
    // ------------------------------------------------------------------
    "narrativa_ia" => [
        "activo"    => false,
        "api_key"   => getenv("ANTHROPIC_API_KEY") ?: "",
        "modelo"    => "claude-sonnet-4-6", // verifica el nombre vigente en docs.claude.com
        "timeout_s" => 8,
    ],

];
