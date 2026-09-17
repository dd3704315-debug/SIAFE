<?php

require_once "app/models/IA.php";
require_once "app/services/BusquedaInternet.php";

class IAController
{
    private $ia;

    public function __construct()
    {
        $this->ia = new IA();
    }

    // ==========================================
    // MOSTRAR ANÁLISIS DE IA
    // ==========================================

public function index()
{
    if (!isset($_SESSION["id_empresa"]) || empty($_SESSION["id_empresa"])) {
        $_SESSION["error_ia"] = "No se encontró una empresa asociada al usuario.";
        header("Location: index.php?page=dashboard");
        exit;
    }

    $idEmpresa = (int) $_SESSION["id_empresa"];

    $analisis = $this->ia->analizarEmpresa($idEmpresa);

    require "app/views/ia/index.php";
}

    // ==========================================
    // BUSCAR PRODUCTO EN INTERNET
    // ==========================================

    public function buscarInternet()
    {
        $producto = trim($_GET["producto"] ?? "");

        if ($producto === "") {
            $_SESSION["error_ia"] = "Debes escribir el nombre de un producto.";
            header("Location: index.php?page=ia");
            exit;
        }

        $busqueda = new BusquedaInternet();
        $resultados = $busqueda->buscarProducto($producto);

        $_SESSION["producto_busqueda_ia"] = $producto;
        $_SESSION["resultados_busqueda_ia"] = $resultados;

        header("Location: index.php?page=ia");
        exit;
    }
}