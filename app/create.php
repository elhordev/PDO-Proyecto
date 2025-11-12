<?php 
require_once __DIR__ . '\..\app\services\Productoservice.php';
require_once __DIR__ . '\..\app\config\Config.php';
require_once __DIR__ . '\..\app\services\Categoriasservice.php';

use models\Categoria;
use services\CategoriasService;
use config\Config;

$config = Config::getInstance();
$categoriaService = new CategoriasService($config->db);
include __DIR__ . '\..\app\header.php';
?>

<div class="container mt-5">
  <h1 class="text-center mb-4">Crear Producto</h1>
  <h5 class="text-center mb-5 text-muted">Rellena el formulario con los detalles de tu producto</h5>

  <form action="" method="post" class="bg-dark text-light p-4 rounded shadow-lg">
    <div class="mb-3">
      <label for="marca" class="form-label">Marca</label>
      <input type="text" class="form-control" id="marca" name="marca" required>
    </div>

    <div class="mb-3">
      <label for="modelo" class="form-label">Modelo</label>
      <input type="text" class="form-control" id="modelo" name="modelo" required>
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion">
    </div>

    <div class="mb-3">
      <label for="precio" class="form-label">Precio (€)</label>
      <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
    </div>

    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen (URL)</label>
      <input type="text" class="form-control" id="imagen" name="imagen">
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="number" class="form-control" id="stock" name="stock" required>
    </div>

    <div class="mb-4">
      <label for="categoria" class="form-label">Categoría</label>
      <select id="categoria" name="categoria" class="form-select" required>
        <?php
        $categorias = $categoriaService->findAll();
        foreach($categorias as $categoria){
            echo '<option value="' . $categoria->id . '">' . htmlspecialchars($categoria->nombre) . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="text-center">
      <input type="submit" value="Crear Producto" class="btn btn-success btn-lg px-5">
    </div>
  </form>
</div>

<?php
include __DIR__ . '\..\app\footer.php';
?>
