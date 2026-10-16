<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Green Volt' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php $cssVersion = filemtime(__DIR__ . '/../../../public/css/style.css'); ?>
    <link rel="stylesheet" href="/green_volt/public/css/style.css?v=<?= htmlspecialchars((string)$cssVersion) ?>">
</head>
<body class="bg-light">
<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$currentPath = rtrim($currentPath, '/');
$baseUrl = defined('URLROOT') ? URLROOT : '/green_volt';
$navActive = function ($path) use ($currentPath) {
    $path = rtrim($path, '/');
    return $currentPath === $path;
};
?>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= htmlspecialchars($baseUrl) ?>/">
            <span class="brand-bolt"><i class="fa-solid fa-bolt"></i></span>
            <span>Green Volt</span>
        </a>

        <div class="navbar-nav me-auto ms-auto">
            <a class="nav-link <?= $navActive($baseUrl) ? 'active' : '' ?>" href="<?= htmlspecialchars($baseUrl) ?>/"><i class="fa-solid fa-house me-1"></i>Inicio</a>
            <a class="nav-link <?= $navActive($baseUrl . '/vehiculos') ? 'active' : '' ?>" href="<?= htmlspecialchars($baseUrl) ?>/vehiculos"><i class="fa-solid fa-car me-1"></i>Catálogo</a>
            <a class="nav-link <?= $navActive($baseUrl . '/comprador') ? 'active' : '' ?>" href="<?= htmlspecialchars($baseUrl) ?>/comprador"><i class="fa-solid fa-cart-shopping me-1"></i>Comprar</a>
            <a class="nav-link <?= $navActive($baseUrl . '/comparador') ? 'active' : '' ?>" href="<?= htmlspecialchars($baseUrl) ?>/comparador"><i class="fa-solid fa-code-compare me-1"></i>Comparador</a>
            <a class="nav-link <?= $navActive($baseUrl . '/soporte') ? 'active' : '' ?>" href="<?= htmlspecialchars($baseUrl) ?>/soporte"><i class="fa-solid fa-headset me-1"></i>Servicios y Soporte</a>
            <button class="nav-link border-0 bg-transparent" type="button" data-bs-toggle="modal" data-bs-target="#tratamientoDatosModal">
                <i class="fa-solid fa-shield-halved me-1"></i>Tratamiento de datos
            </button>
            <a class="nav-link <?= $navActive($baseUrl . '/informacion/quienesSomos') ? 'active' : '' ?>" href="<?= htmlspecialchars($baseUrl) ?>/informacion/quienesSomos">
                <i class="fa-solid fa-circle-info me-1"></i>Quiénes somos
            </a>
        </div>

        <div class="nav-actions">
            <a href="<?= htmlspecialchars($baseUrl) ?>/dashboard" class="btn btn-dashboard">
                <i class="fa-solid fa-gauge me-2"></i>Dashboard
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= htmlspecialchars($baseUrl) ?>/auth/logout" class="btn btn-login">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>Cerrar sesión
                </a>
            <?php else: ?>
                <a href="<?= htmlspecialchars($baseUrl) ?>/auth/login" class="btn btn-login">
                    <i class="fa-solid fa-user me-2"></i>Iniciar sesión
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
