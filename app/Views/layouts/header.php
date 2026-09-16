<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Green Volt' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/green_volt/">
            <i class="fa-solid fa-bolt text-warning me-2"></i>Green Volt
        </a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="/green_volt/"><i class="fa-solid fa-house me-1"></i>Inicio</a>
            <a class="nav-link" href="/green_volt/vehiculos"><i class="fa-solid fa-car me-1"></i>Catálogo</a>
            <a class="nav-link active" href="/green_volt/comprador"><i class="fa-solid fa-cart-shopping me-1"></i>Comprar</a>
            <a class="nav-link" href="/green_volt/comparador"><i class="fa-solid fa-code-compare me-1"></i>Comparador</a>
        </div>
        <a href="/green_volt/auth/login" class="btn btn-outline-light btn-sm">
            <i class="fa-solid fa-user me-1"></i>Iniciar Sesión
        </a>
    </div>
</nav>
