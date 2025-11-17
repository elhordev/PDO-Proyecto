<?php
require_once __DIR__ . '\..\app\config\Config.php';
require_once __DIR__ . '\..\app\models\Categoria.php';
require_once __DIR__ . '\..\app\services\Categoriasservice.php';
require_once __DIR__ . '\..\app\services\Productoservice.php';
require __DIR__ . '\..\vendor\autoload.php';


use config\Config;
use models\Categoria;
use models\Producto;
use services\CategoriasService;
use services\ProductosService;

$config = Config::getInstance();
$categoriaService = new CategoriasService($config->db);
$productoService = new ProductosService($config->db);

include __DIR__ . '\..\app\header.php';

$productosList = '';

if (isset($_GET['deleted']) && $_GET['deleted'] == 1){
    echo '<div class="alert alert-success text-center" role="alert">
    Producto eliminado correctamente.
    </div>';
}
if (isset($_GET['rol']) && $_GET['rol'] == 0 ){
echo '<div class="alert alert-danger text-center" role="alert">
    No tienes permisos para acceder, solo un usuario ADMIN puede acceder.
    </div>';

}
if (isset($_GET['buscar']) && $_GET != ""){
    $productoabuscar = $_GET['buscar'];
    $productosList = $productoService->findAllWithCategoryName($productoabuscar);
    if ($_GET['buscar'] == ""){
        $productosList= $productoService->findAll();

    }

}else{
    $productosList= $productoService->findAll();
}


?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Listado de Productos</h1>
    
    <div class="container mb-4">
    <form class="d-flex justify-content-center" method="get" action="">
        <input class="form-control me-2 w-50" type="text" name="buscar" placeholder="Buscar por categoría o modelo" value="<?php echo isset($_GET['buscar']) ? ($_GET['buscar']) : ''; ?>">
        <button class="btn btn-primary" type="submit">Buscar</button>
    </form>
    </div>

    <table class="table table-dark table-striped table-hover align-middle text-center">
        <thead class="table-secondary text-dark">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Categoria</th>
                <th>Precio (€)</th>
                <th>Stock</th>
                <th style="width: 100px;">Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
        if($productosList == null ){
        echo '<div class="alert alert-success text-center" role="alert">
                        Producto no encontrado.
                        </div>';
                    }else{
            foreach($productosList as $producto){
                $idCategoria = $categoriaService->findById($producto->categoriaId);
                echo '<tr>
                        <td>' . htmlspecialchars($producto->id) . '</td>
                        <td>' . htmlspecialchars($producto->marca) . '</td>
                        <td>' . htmlspecialchars($producto->modelo) . '</td>
                        <td>' . htmlspecialchars($idCategoria->nombre) . '</td>
                        <td>' . htmlspecialchars($producto->precio) . '€</td>
                        <td>' . htmlspecialchars($producto->stock) . '</td>
                        <td class="text-center align-middle">' . '<img src='.$producto->imagen.' class="img-fluid" style="max-width: 200px; max-height: 200px;" alt='.$producto->descripcion.'>' . '</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Acciones">
                                <form action="../app/update.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Editar"class="btn btn-outline-warning btn-sm me-2"></form>
                                <form action="../app/details.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Detalles"class="btn btn-outline-info btn-sm me-2"></form>
                                <form action="../app/update-image.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Imagen"class="btn btn-outline-success btn-sm me-2 "></form>
                                <form action="../app/delete.php" method="get">    
                                    <input name="id" value="'.$producto->id.'" style="display:none"/>
                                    <input type="submit" value="Eliminar"class="btn btn-outline-danger btn-sm"></form>
                            </div>
                        </td>
                      </tr>';
            }}
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
