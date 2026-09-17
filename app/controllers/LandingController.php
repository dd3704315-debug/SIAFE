<?php

require_once "app/models/Plan.php";

class LandingController
{
    private $plan;

    public function __construct()
    {
        $this->plan = new Plan();
    }


    // ==========================================
    // MOSTRAR PÁGINA PÚBLICA (antes de iniciar sesión)
    // ==========================================

    public function index()
    {
        $planes = $this->plan->obtenerActivos();

        require "app/views/landing/index.php";
    }
}
