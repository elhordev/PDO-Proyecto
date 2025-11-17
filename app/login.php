<?php 

require_once __DIR__ . '\..\app\config\Config.php';
require_once __DIR__ . '\..\app\services\Userservice.php';
require_once __DIR__ . '\..\app\services\SessionService.php';
require __DIR__ . '\..\vendor\autoload.php';

use services\SessionService;
use config\Config;
use services\UsersService;
use models\User;

$config = Config::getInstance();
$userService = new UsersService($config->db);
$sessionService = SessionService::getInstance();

if (isset($_GET['usernull']) && $_GET['usernull'] == 1){
    echo '<div class="alert alert-danger text-center" role="alert">
    Usuario no encontrado
    </div>';
}

if (isset($_POST['user']) && isset($_POST['pass'])){
    
    $userName = $_POST['user'];
    $userPassword = $_POST['pass'];

    $user = $userService->authenticate($userName, $userPassword);
    if($user == null){
        header('location:../app/login.php?usernull=1');
        exit;
    }
    $sessionService->login($user);
    header('location:../public/index.php');


}



include __DIR__ . '\..\app\header.php';

?>

<form action="" method="post" class="w-50 mx-auto mt-5 p-4 border rounded shadow-sm">
    <h3 class="text-center mb-4">Inicio de Sesión</h3>

    <div class="mb-3">
        <label for="user" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="user" name="user" required>
    </div>

    <div class="mb-3">
        <label for="pass" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="pass" name="pass" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
</form>
<?php 
include __DIR__ . '\..\app\footer.php';

?>