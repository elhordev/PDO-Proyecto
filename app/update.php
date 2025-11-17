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
include __DIR__ . '\..\app\header.php';

echo '<div class="container mt-5">';
echo '<h1 class="mb-4">Edición del producto</h1>';

if(!isset($_COOKIE['rol']) || $_COOKIE['rol'] != 'ADMIN'){
    header('location:../public/index.php?rol=0');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $producto = $productoService->findById($id);
    $categorias = $categoriaService->findAll();

    echo'
        <form action="" method="post">
            <input type="hidden" name="id" value="' . $producto->id . '">

            <label class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control mb-3" value="'.$producto->marca.'">

            <label class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control mb-3" value="'.$producto->modelo.'">

            <label class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control mb-3" value="'.$producto->descripcion.'">

            <label class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control mb-3" value="'.$producto->precio.'">

            <label class="form-label">Imagen</label>
            <input type="text" name="imagen" class="form-control mb-3" value="'.$producto->imagen.'" readonly>

            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control mb-3" value="'.$producto->stock.'">

            <label class="form-label">Categoria</label>
            <select id="categoria" name="categoria" class="form-select mb-3" required>';
                foreach($categorias as $categoria){
                    echo '<option value="' . $categoria->nombre . '">' . htmlspecialchars($categoria->nombre) . '</option>';
                }
    echo '</select>

            <input type="submit" value="Actualizar Producto" class="btn btn-warning">
            <a href="../public" class="btn btn-secondary">Cancelar</a>
        </form>';

    if (isset($_POST['id'])){
        $id = $_POST['id'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $imagen = $_POST['imagen'];
        $stock = $_POST['stock'];
        $categoria = $_POST['categoria'];

        $id_categoria = $categoriaService->findByName($categoria)->id;

        $producto->marca = $marca;
        $producto->modelo = $modelo;
        $producto->descripcion = $descripcion;
        $producto->precio = $precio;
        $producto->imagen = $imagen;
        $producto->stock = $stock;
        $producto->categoriaId = $id_categoria;
            

        $productoService->updateProduct($producto);
    }
}

echo '</div>';
include __DIR__ . '\..\app\footer.php';
?>

