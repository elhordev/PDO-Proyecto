<?php
require_once __DIR__ . '\..\app\services\Productoservice.php';
require_once __DIR__ . '\..\app\config\Config.php';
require_once __DIR__ . '\..\app\services\Categoriasservice.php';
require_once __DIR__ . '\..\app\models\Producto.php';
require __DIR__ . '\..\vendor\autoload.php';


use services\CategoriasService;
use config\Config;
use services\ProductosService;


$config = Config::getInstance();
$categoriaService = new CategoriasService($config->db);
$productoService = new ProductosService($config->db);
include __DIR__ . '\..\app\header.php';



if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $producto = $productoService->findById($id);
    $idCategoria = $categoriaService->findById($producto->categoriaId);
    



    echo '<h1 class="mb-4">Detalles del producto</h1>
    <table class="table table-striped">
        <tr>
            <td>
            ID:
            </td>
            <td>
            ' . $producto->id . '
            </td>
        </tr>
        <tr>
            <td>
            Marca:
            </td>
            <td>
            ' . $producto->marca . '
            </td>
        </tr>
        <tr>
            <td>
            Modelo
            </td>
            <td>
            ' . $producto->modelo . '
            </td>
        </tr>
        <tr>
            <td>
            Descripción
            </td>
            <td>
            ' . $producto->descripcion . '
            </td>
        </tr>
        <tr>
            <td>
            Precio
            </td>
            <td>
            ' . $producto->precio . '
            </td>
        </tr>
        <tr>
            <td>
            Imagen
            </td>
            <td>
            <img src='.$producto->imagen.' "class = "img-fluid" alt='.$producto->descripcion.'>'. '
            </td>
        </tr>
        <tr>
            <td>
            Stock
            </td>
            <td>
            ' . $producto->stock . '
            </td>
        </tr>
        <tr>
            <td>
            Categoría
            </td>
            <td>
            ' . $idCategoria->nombre . '
            </td>
        </tr>
    
    </table>
    <a href="../public" class="btn btn-warning">Volver</a>
    </div>' ;
            }else 
                {echo '<div class="alert alert-danger text-center">Producto no encontrado.</div>';};

include __DIR__ . '\..\app\footer.php';
