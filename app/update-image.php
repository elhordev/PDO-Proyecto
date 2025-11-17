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

if(!isset($_COOKIE['rol']) || $_COOKIE['rol'] != 'ADMIN'){
    header('location:../public/index.php?rol=0');

    }else{

        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $producto = $productoService->findById($id);

            if ($producto !== null) {

                $idCategoria = $categoriaService->findById($producto->categoriaId);

                echo '<h1 class="mb-4">Detalles del producto</h1>
                <table class="table table-striped">
                    <tr>
                        <td>ID:</td>
                        <td>' . $producto->id . '</td>
                    </tr>
                    <tr>
                        <td>Marca:</td>
                        <td>' . $producto->marca . '</td>
                    </tr>
                    <tr>
                        <td>Modelo:</td>
                        <td>' . $producto->modelo . '</td>
                    </tr>
                    <tr>
                        <td>Descripción:</td>
                        <td>' . $producto->descripcion . '</td>
                    </tr>
                    <tr>
                        <td>Precio:</td>
                        <td>' . $producto->precio . '</td>
                    </tr>
                    <tr>
                        <td>Imagen:</td>
                        <td><img src="' . $producto->imagen . '"class = "img-fluid" alt="' . $producto->descripcion . '"></td>
                    </tr>
                    <tr>
                        <td>Stock:</td>
                        <td>' . $producto->stock . '</td>
                    </tr>
                    <tr>
                        <td>Categoría:</td>
                        <td>' . $idCategoria->nombre . '</td>
                    </tr>
                </table>
                
                </div>';

            } else {
                    
                echo '<div class="alert alert-danger text-center">Producto no encontrado.</div>';        
                header('location:../public/index.php');
                
                

            }
        }

    } 
?>
<form action="../app/update_image_file.php" method="post" enctype="multipart/form-data" 
      class="p-4 border rounded shadow-sm bg-light" style="max-width: 450px;">

    <input type="hidden" name="id" value="<?php echo $producto->id; ?>">

    <h4 class="mb-3">Cambiar foto del producto</h4>

    <div class="mb-3">
        <label for="foto" class="form-label">Nueva imagen</label>
        <input class="form-control" type="file" name="foto" id="foto" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Actualizar foto</button>
</form>
<a href="../public" class="btn btn-warning">Volver</a>

