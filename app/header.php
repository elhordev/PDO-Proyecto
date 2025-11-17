<?php
require_once dirname(__FILE__) . "\services\Sessionservice.php";
use services\SessionService;

$sessionService = SessionService::getInstance();

if(isset($_COOKIE['usuario'])){
    $userlogged = 'd-inline';
    $nouser = 'd-none';
    $nousertext = 'Cerrar sesión';
    $url_button = '../app/logout.php';
}else{
    $userlogged = 'd-none';
    $nouser = 'd-inline';
    $nousertext = 'Iniciar sesión';
    $url_button = '../app/login.php';
}

$rol = "Invitado";

if(isset($_COOKIE['rol'])){
    $rol = $_COOKIE['rol'];
}



?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Elhorshop</title>


<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../src/favicon/mantenimiento.png" rel="icon" type="image/png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
<div class="container-fluid">
<!-- Título / Marca -->
<a class="navbar-brand fw-bold" href="\..\PDO-Proyecto\public">Elhorshop</a>


<!-- Botón responsive -->
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>


<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item">
<a class="nav-link" href="/PDO-Proyecto/public">Todos los productos</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../app/create.php">Crear producto</a>
</li>
</ul>



<div class="d-flex align-items-center gap-2">
<?php if (!empty($_COOKIE['usuario'])): ?>
<span class="navbar-brand fw-bold">Hola, <?= htmlspecialchars($_COOKIE['usuario']) ?></span>
<?php endif; ?>


<form action="<?php echo $url_button;?>" method="post" class="m-0">
    <?php echo $rol . " - ";?>
<button type="submit" name="logout" class="btn btn-light btn-sm"><?php echo $nousertext;?></button>
</form>
</div>
</div>
</div>
</nav>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>