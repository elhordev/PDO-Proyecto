<?php
require_once __DIR__ . '\..\app\config\Config.php';
require_once __DIR__ . '\..\app\models\Categoria.php';
require_once __DIR__ . '\..\app\services\Categoriasservice.php';
require_once __DIR__ . '\..\app\services\Productoservice.php';
require __DIR__ . '\..\vendor\autoload.php';
include __DIR__ . '\..\app\header.php';

use config\Config;
use models\Categoria;
use models\Producto;
use services\CategoriasService;
use services\ProductosService;

$config = Config::getInstance();
$categoriaService = new CategoriasService($config->db);
$productoService = new ProductosService($config->db);
$productosList = $productoService->findAll();
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Listado de Productos</h1>

    <table class="table table-dark table-striped table-hover align-middle text-center">
        <thead class="table-secondary text-dark">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio (€)</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($productosList as $producto){
                echo '<tr>
                        <td>' . htmlspecialchars($producto->id) . '</td>
                        <td>' . htmlspecialchars($producto->marca) . '</td>
                        <td>' . htmlspecialchars($producto->modelo) . '</td>
                        <td>' . htmlspecialchars($producto->precio) . '</td>
                        <td>' . htmlspecialchars($producto->stock) . '</td>
                        <td>' . 
                        '<img src='.$producto->imagen.' alt='.$producto->descripcion.'/>' . '</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <button type="button" class="btn btn-outline-info btn-sm">Detalles</button>
                                <button type="button" class="btn btn-outline-warning btn-sm">Editar</button>
                                <button type="button" class="btn btn-outline-secondary btn-sm">Imagen</button>
                                <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
                            </div>
                        </td>
                      </tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="../app/create.php"><button class="btn btn-success btn-lg">Crear Producto</button></a>
    </div>
</div>

<?php
include __DIR__ . '\..\app\footer.php';
?>
