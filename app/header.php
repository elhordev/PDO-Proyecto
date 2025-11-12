<?php
// header_elhorshop.php (versión con Bootstrap)
if (session_status() !== PHP_SESSION_ACTIVE) {
session_start();
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
<a class="nav-link" href="/productos.php">Productos</a>
</li>
<li class="nav-item">
<a class="nav-link" href="../app/create.php">Crear producto</a>
</li>
</ul>


<!-- Usuario + botón cerrar sesión -->
<div class="d-flex align-items-center gap-2">
<?php if (!empty($_SESSION['user'])): ?>
<span class="text-white-50 small">Hola, <?= htmlspecialchars($_SESSION['user']) ?></span>
<?php endif; ?>


<form action="/logout.php" method="post" class="m-0">
<button type="submit" name="logout" class="btn btn-light btn-sm">Cerrar sesión</button>
</form>
</div>
</div>
</div>
</nav>


<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>