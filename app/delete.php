<?php
require_once __DIR__ . '\..\app\services\Productoservice.php';
require_once __DIR__ . '\..\app\config\Config.php';
require_once __DIR__ . '\..\app\services\Categoriasservice.php';
require_once __DIR__ . '\..\app\models\Producto.php';
require __DIR__ . '\..\vendor\autoload.php';

use services\CategoriasService;
use config\Config;
use services\ProductosService;
use models\Producto;

$config = Config::getInstance();
$categoriaService = new CategoriasService($config->db);
$productoService = new ProductosService($config->db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $producto = $productoService->deleteByID($id);




}

?>