<?php

require_once "app/models/Producto.php";
require_once "app/models/Empresa.php";

class ProductoController
{
    private $producto;
    private $empresa;

    public function __construct()
    {
        $this->producto = new Producto();
        $this->empresa = new Empresa();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }


    // ==========================================================
    // LISTAR PRODUCTOS
    // ==========================================================

    public function index()
    {
        $idUsuario = $_SESSION["id_usuario"] ?? null;

        if (!$idUsuario) {
            header("Location: index.php?page=login");
            exit;
        }

        $empresaUsuario = $this->empresa->obtenerPorUsuario($idUsuario);

        if (!$empresaUsuario || empty($empresaUsuario["id_empresa"])) {
            die("El usuario no tiene una empresa asociada.");
        }

        $idEmpresa = $empresaUsuario["id_empresa"];

        $productos = $this->producto->obtenerTodos($idEmpresa);

        require_once "app/views/productos/index.php";
    }


    // ==========================================================
    // CREAR PRODUCTO
    // ==========================================================

    public function crear()
    {
        $empresas = $this->empresa->obtenerTodos();

        require_once "app/views/productos/crear.php";
    }

    // ==========================================================
    // GUARDAR PRODUCTO
    // ==========================================================

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=productos");
            exit;
        }

        try {

            $idEmpresa = $_POST["id_empresa"] ?? null;
            $idCategoria = $_POST["id_categoria_producto"] ?? null;

            $codigo = trim(
                $_POST["codigo_producto"] ?? ""
            );

            $nombre = trim(
                $_POST["nombre_producto"] ?? ""
            );

            $descripcion = trim(
                $_POST["descripcion_producto"] ?? ""
            );

            $categoria = trim(
                $_POST["categoria_producto"] ?? ""
            );

            $marca = trim(
                $_POST["marca_producto"] ?? ""
            );

            $unidad = trim(
                $_POST["unidad_medida_producto"] ?? ""
            );

            $stock = (int) (
                $_POST["stock_producto"] ?? 0
            );

            $stockMinimo = (int) (
                $_POST["stock_minimo_producto"] ?? 0
            );

            $precioCompra = (float) (
                $_POST["precio_compra_producto"] ?? 0
            );

            $precioVenta = (float) (
                $_POST["precio_venta_producto"] ?? 0
            );

            $estado = $_POST["estado_producto"] ?? "Activo";// ==================================================
// IMAGEN DEL PRODUCTO
// ==================================================

$imagen = null;

if (
    isset($_FILES["imagen_producto"]) &&
    $_FILES["imagen_producto"]["error"] !== UPLOAD_ERR_NO_FILE
) {

    // Comprobar error de subida
    if ($_FILES["imagen_producto"]["error"] !== UPLOAD_ERR_OK) {

        throw new Exception(
            "Error al subir la imagen. Código: " .
            $_FILES["imagen_producto"]["error"]
        );
    }

    // ==================================================
    // CARPETA DE DESTINO
    // ==================================================

    $carpeta = dirname(__DIR__, 2) .
        "/public/img/productos/";

    if (!is_dir($carpeta)) {

        if (!mkdir($carpeta, 0777, true)) {

            throw new Exception(
                "No se pudo crear la carpeta de imágenes."
            );
        }
    }

    if (!is_writable($carpeta)) {

        throw new Exception(
            "La carpeta de imágenes no tiene permisos de escritura."
        );
    }

    // ==================================================
    // OBTENER EXTENSIÓN
    // ==================================================

    $extension = strtolower(
        pathinfo(
            $_FILES["imagen_producto"]["name"],
            PATHINFO_EXTENSION
        )
    );

    // ==================================================
    // EXTENSIONES PERMITIDAS
    // ==================================================

    $extensionesPermitidas = [
        "jpg",
        "jpeg",
        "png",
        "webp"
    ];

    if (!in_array(
        $extension,
        $extensionesPermitidas,
        true
    )) {

        throw new Exception(
            "Formato de imagen no permitido. Use JPG, JPEG, PNG o WEBP."
        );
    }

    // ==================================================
    // COMPROBAR ARCHIVO
    // ==================================================

    if (!is_uploaded_file(
        $_FILES["imagen_producto"]["tmp_name"]
    )) {

        throw new Exception(
            "PHP no recibió correctamente el archivo."
        );
    }

    // ==================================================
    // GENERAR NOMBRE ÚNICO
    // ==================================================

    $nombreImagen =
        uniqid("producto_", true) .
        "." .
        $extension;

    $rutaDestino =
        $carpeta . $nombreImagen;

    // ==================================================
    // MOVER IMAGEN
    // ==================================================

    if (!move_uploaded_file(
        $_FILES["imagen_producto"]["tmp_name"],
        $rutaDestino
    )) {

        throw new Exception(
            "No fue posible guardar la imagen."
        );
    }

    // ==================================================
    // VERIFICAR ARCHIVO
    // ==================================================

    if (!file_exists($rutaDestino)) {

        throw new Exception(
            "La imagen no apareció en la carpeta de productos."
        );
    }

    // Guardar únicamente el nombre en la BD
    $imagen = $nombreImagen;
}

            if (!$idEmpresa) {
                throw new Exception(
                    "Debe seleccionar una empresa."
                );
            }

            if ($nombre === "") {
                throw new Exception(
                    "Debe ingresar el nombre del producto."
                );
            }

            if ($stock < 0) {
                throw new Exception(
                    "El stock no puede ser negativo."
                );
            }

            if ($stockMinimo < 0) {
                throw new Exception(
                    "El stock mínimo no puede ser negativo."
                );
            }

            if ($precioCompra < 0) {
                throw new Exception(
                    "El precio de compra no puede ser negativo."
                );
            }

            if ($precioVenta < 0) {
                throw new Exception(
                    "El precio de venta no puede ser negativo."
                );
            }


            // ==================================================
            // CREAR PRODUCTO
            // ==================================================

            $resultado = $this->producto->crear(
                $idEmpresa,
                $idCategoria,
                $codigo,
                $nombre,
                $descripcion,
                $categoria,
                $marca,
                $unidad,
                $stock,
                $stockMinimo,
                $precioCompra,
                $precioVenta,
                $imagen,
                $estado
            );


            if (!$resultado) {

                throw new Exception(
                    "No fue posible guardar el producto."
                );
            }


            $_SESSION["mensaje_producto"] =
                "Producto registrado correctamente.";

            header(
                "Location: index.php?page=productos"
            );

            exit;

        } catch (Exception $e) {

            $_SESSION["error_producto"] =
                $e->getMessage();

            header(
                "Location: index.php?page=crearProducto"
            );

            exit;
        }
    }


    // ==========================================================
    // EDITAR PRODUCTO
    // ==========================================================

    public function editar()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {

            header(
                "Location: index.php?page=productos"
            );

            exit;
        }


        $producto =
            $this->producto->obtenerPorId($id);


        if (!$producto) {

            $_SESSION["error_producto"] =
                "El producto no existe.";

            header(
                "Location: index.php?page=productos"
            );

            exit;
        }


        $empresas =
            $this->empresa->obtenerTodos();


        require_once
            "app/views/productos/editar.php";
    }


    // ==========================================================
    // ACTUALIZAR PRODUCTO
    // ==========================================================

    public function actualizar()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header(
                "Location: index.php?page=productos"
            );

            exit;
        }

        try {

            $idProducto =
                $_POST["id_producto"] ?? null;

                $productoAnterior = $this->producto->obtenerPorId($idProducto);

if (!$productoAnterior) {
    throw new Exception("El producto no existe.");
}

$imagenAnterior = $productoAnterior["imagen_producto"] ?? null;

            $idEmpresa =
                $_POST["id_empresa"] ?? null;

            $idCategoria =
                $_POST["id_categoria_producto"] ?? null;

            $codigo = trim(
                $_POST["codigo_producto"] ?? ""
            );

            $nombre = trim(
                $_POST["nombre_producto"] ?? ""
            );

            $descripcion = trim(
                $_POST["descripcion_producto"] ?? ""
            );

            $categoria = trim(
                $_POST["categoria_producto"] ?? ""
            );

            $marca = trim(
                $_POST["marca_producto"] ?? ""
            );

            $unidad = trim(
                $_POST["unidad_medida_producto"] ?? ""
            );

            $stock = (int) (
                $_POST["stock_producto"] ?? 0
            );

            $stockMinimo = (int) (
                $_POST["stock_minimo_producto"] ?? 0
            );

            $precioCompra = (float) (
                $_POST["precio_compra_producto"] ?? 0
            );

            $precioVenta = (float) (
                $_POST["precio_venta_producto"] ?? 0
            );

            $estado =
                $_POST["estado_producto"]
                ?? "Activo";


            // ==================================================
// IMAGEN DEL PRODUCTO
// ==================================================

$imagen = null;

if (isset($_FILES["imagen_producto"])) {

    // Comprobar error de subida
    if ($_FILES["imagen_producto"]["error"] !== UPLOAD_ERR_OK) {

        switch ($_FILES["imagen_producto"]["error"]) {

            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new Exception(
                    "La imagen supera el tamaño permitido por PHP."
                );

            case UPLOAD_ERR_PARTIAL:
                throw new Exception(
                    "La imagen se cargó parcialmente."
                );

            case UPLOAD_ERR_NO_FILE:
                throw new Exception(
                    "No se seleccionó ninguna imagen."
                );

            default:
                throw new Exception(
                    "Error al subir la imagen. Código: " .
                    $_FILES["imagen_producto"]["error"]
                );
        }
    }

    // ==================================================
    // CARPETA DE DESTINO
    // ==================================================

    $carpeta = dirname(__DIR__, 2)
        . "/public/img/productos/";

    // Crear carpeta si no existe
    if (!is_dir($carpeta)) {

        if (!mkdir($carpeta, 0777, true)) {

            throw new Exception(
                "No se pudo crear la carpeta de imágenes."
            );
        }
    }

    // Comprobar permisos de escritura
    if (!is_writable($carpeta)) {

        throw new Exception(
            "La carpeta de imágenes no tiene permisos de escritura."
        );
    }

    // ==================================================
    // OBTENER EXTENSIÓN
    // ==================================================

    $extension = strtolower(
        pathinfo(
            $_FILES["imagen_producto"]["name"],
            PATHINFO_EXTENSION
        )
    );

    // ==================================================
    // EXTENSIONES PERMITIDAS
    // ==================================================

    $extensionesPermitidas = [
        "jpg",
        "jpeg",
        "png",
        "webp"
    ];

    if (!in_array(
        $extension,
        $extensionesPermitidas,
        true
    )) {

        throw new Exception(
            "Formato de imagen no permitido. Use JPG, JPEG, PNG o WEBP."
        );
    }

    // ==================================================
    // COMPROBAR QUE REALMENTE SEA UNA IMAGEN
    // ==================================================

if (!is_uploaded_file($_FILES["imagen_producto"]["tmp_name"])) {
    throw new Exception(
        "PHP no recibió correctamente el archivo. " .
        "Error de subida: " .
        $_FILES["imagen_producto"]["error"]
    );
}

if (!is_writable($carpeta)) {
    throw new Exception(
        "La carpeta no tiene permisos de escritura: " .
        $carpeta
    );
}



    // ==================================================
    // GENERAR NOMBRE ÚNICO
    // ==================================================

    $nombreImagen =
        uniqid("producto_", true)
        . "."
        . $extension;

    $rutaDestino =
        $carpeta . $nombreImagen;

    // ==================================================
    // MOVER IMAGEN
    // ==================================================

    if (!move_uploaded_file(
        $_FILES["imagen_producto"]["tmp_name"],
        $rutaDestino
    )) {

        throw new Exception(
            "PHP recibió la imagen, pero no pudo guardarla en: "
            . $carpeta
        );
    }

    // ==================================================
    // VERIFICAR QUE EL ARCHIVO EXISTE
    // ==================================================

    if (!file_exists($rutaDestino)) {

        throw new Exception(
            "La imagen no apareció en la carpeta de productos."
        );
    }

    // Guardar únicamente el nombre en la BD
    $imagen = $nombreImagen;
}


            // ==================================================
            // VALIDACIONES
            // ==================================================

            if (!$idProducto) {

                throw new Exception(
                    "Producto inválido."
                );
            }

            if (!$idEmpresa) {

                throw new Exception(
                    "Debe seleccionar una empresa."
                );
            }

            if ($nombre === "") {

                throw new Exception(
                    "Debe ingresar el nombre del producto."
                );
            }

            if ($stock < 0) {

                throw new Exception(
                    "El stock no puede ser negativo."
                );
            }

            if ($stockMinimo < 0) {

                throw new Exception(
                    "El stock mínimo no puede ser negativo."
                );
            }

            if ($precioCompra < 0) {

                throw new Exception(
                    "El precio de compra no puede ser negativo."
                );
            }

            if ($precioVenta < 0) {

                throw new Exception(
                    "El precio de venta no puede ser negativo."
                );
            }


            // ==================================================
            // ACTUALIZAR PRODUCTO
            // ==================================================

            $resultado =
                $this->producto->actualizar(
                    $idProducto,
                    $idEmpresa,
                    $idCategoria,
                    $codigo,
                    $nombre,
                    $descripcion,
                    $categoria,
                    $marca,
                    $unidad,
                    $stock,
                    $stockMinimo,
                    $precioCompra,
                    $precioVenta,
                    $imagen,
                    $estado
                );


            if (!$resultado) {

                throw new Exception(
                    "No fue posible actualizar el producto."
                );
            }

            // ==================================================
// ELIMINAR IMAGEN ANTERIOR SI SE CAMBIÓ
// ==================================================

if (
    $imagen !== null &&
    !empty($imagenAnterior) &&
    $imagenAnterior !== $imagen
) {

    $rutaImagenAnterior =
        dirname(__DIR__, 2) .
        "/public/img/productos/" .
        basename($imagenAnterior);

    if (file_exists($rutaImagenAnterior)) {
        unlink($rutaImagenAnterior);
    }
}


            $_SESSION["mensaje_producto"] =
                "Producto actualizado correctamente.";


            header(
                "Location: index.php?page=productos"
            );

            exit;


        } catch (Exception $e) {

            $_SESSION["error_producto"] =
                $e->getMessage();

            header(
                "Location: index.php?page=productos"
            );

            exit;
        }
    }

    // ==========================================================
    // ELIMINAR PRODUCTO
    // ==========================================================
public function eliminar()
{
    $id = $_GET["id"] ?? null;

    if (!$id) {
        header(
            "Location: index.php?page=productos"
        );
        exit;
    }

    try {

        // ==================================================
        // OBTENER PRODUCTO ANTES DE ELIMINARLO
        // ==================================================

        $producto = $this->producto->obtenerPorId($id);

        if (!$producto) {
            throw new Exception(
                "El producto no existe."
            );
        }

        // ==================================================
        // ELIMINAR IMAGEN FÍSICA
        // ==================================================

        if (
            isset($producto["imagen_producto"]) &&
            !empty($producto["imagen_producto"])
        ) {

            $rutaImagen =
                dirname(__DIR__, 2) .
                "/public/img/productos/" .
                $producto["imagen_producto"];

            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }

        // ==================================================
        // ELIMINAR PRODUCTO DE LA BASE DE DATOS
        // ==================================================

        $resultado =
            $this->producto->eliminar($id);

        if (!$resultado) {
            throw new Exception(
                "No fue posible eliminar el producto."
            );
        }

        $_SESSION["mensaje_producto"] =
            "Producto eliminado correctamente.";

    } catch (Exception $e) {

        $_SESSION["error_producto"] =
            $e->getMessage();
    }

    header(
        "Location: index.php?page=productos"
    );

    exit;
}
}