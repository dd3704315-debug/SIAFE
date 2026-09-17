<?php

require_once "app/models/Indicador.php";

class IndicadorController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Indicador();
    }

    public function index()
    {
        $empresas = $this->modelo->obtenerEmpresas();
        $indicadores = $this->modelo->obtenerUltimos();

        $resultado = null;
        $idEmpresaSeleccionada = null;

        if (isset($_GET["id_empresa"]) && !empty($_GET["id_empresa"])) {

            $idEmpresaSeleccionada = (int) $_GET["id_empresa"];

            $resultado = $this->modelo->calcular($idEmpresaSeleccionada);

            $this->modelo->guardar(
                $idEmpresaSeleccionada,
                $resultado["liquidez"],
                $resultado["rentabilidad"]
            );

            $indicadores = $this->modelo->obtenerUltimos();
        }

        require "app/views/indicadores/index.php";
    }
}
