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
    <div class="d-flex justify-content-center mb-4">
        <div class="input-group" style="max-width: 500px;">
            <input 
                type="text" 
                class="form-control form-control-lg rounded-start-pill" 
                placeholder="🔍 Introduce nombre o marca..."
                aria-label="Buscar producto"
            >
            <button 
                class="btn btn-primary rounded-end-pill px-4" 
                type="button"
            >
                Buscar
            </button>
        </div>
    </div>
    <table class="table table-dark table-striped table-hover align-middle text-center">
        <thead class="table-secondary text-dark">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio (€)</th>
                <th>Stock</th>
                <th style="width: 100px;">Imagen</th>
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
                        <td class="text-center align-middle">' . '<img src='.$producto->imagen.' class="img-fluid" style="max-width: 200px; max-height: 200px;" alt='.$producto->descripcion.'>' . '</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <form action="../app/update.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Editar"class="btn btn-outline-warning btn-sm"></form>
                                <form action="../app/details.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Detalles"class="btn btn-outline-info btn-sm"></form>
                                <form action="../app/update-image.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Imagen"class="btn btn-outline-success btn-sm"></form>
                                <form action="../app/delete.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Eliminar"class="btn btn-outline-danger btn-sm"></form>
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
