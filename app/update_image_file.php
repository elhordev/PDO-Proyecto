<?php 
require_once __DIR__ . '\..\app\config\Config.php';
require_once __DIR__ . '\..\app\services\Productoservice.php';
require_once __DIR__ . '\..\app\models\Producto.php';
require __DIR__ . '\..\vendor\autoload.php';

use config\Config;
use services\ProductosService;
use models\Producto;

$config = Config::getInstance();
$productoService = new ProductosService($config->db);


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $producto = $productoService->findById($id);
    if($producto === null){echo "Producto no encontrado";}
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha subido un archivo
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES['foto'];

        // Extraemos la información del archivo
        $nombre = $archivo['name'];
        $tipo = $archivo['type'];
        $tmpPath = $archivo['tmp_name'];
        $error = $archivo['error'];

        // Comprobar el tipo y la extensión del archivo
        $allowedTypes = ['image/jpeg', 'image/png'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedType = finfo_file($fileInfo, $tmpPath);
        $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

        if (in_array($detectedType, $allowedTypes) && in_array($extension, $allowedExtensions)) {
            // Generar un nuevo nombre de archivo basado en la hora Unix
            $nuevoNombre = $producto->uuid . '.' . $extension;

            // Ruta de destino donde se guardará el archivo
            $rutaDestino = '../app/uploads/' . $nuevoNombre;

            if (file_exists($rutaDestino)) {
                unlink($rutaDestino); // elimina la imagen existente
                }//https://www.forosdelweb.com/f18/como-hago-para-eliminar-imagen-por-php-carpeta-1143510/#post4762834

            // Mover el archivo a la ruta de destino
            if (move_uploaded_file($tmpPath, $rutaDestino)) {
                
                $producto->imagen = $rutaDestino;
                $productoService->updateProduct($producto);
                header("Location: ../app/update-image.php?id=".$producto->id);
                
                echo "El archivo se ha subido y guardado correctamente.";
            } else {
                echo "Error al mover el archivo a la ruta de destino.";
            }
        } else {
            echo "Tipo o extensión de archivo no permitido.";
        }
    } else {
        echo "No se ha subido ningún archivo o ha ocurrido un error.";
    }
}

?>