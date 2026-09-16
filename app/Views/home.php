<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Green Volt</title>
    <!-- Bootstrap CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<!-- BARRA DE NAVEGACIÓN PRINCIPAL -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/green_volt/">
            <i class="fa-solid fa-bolt text-warning me-2"></i>Green Volt
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/green_volt/"><i class="fa-solid fa-house me-1"></i>Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/green_volt/vehiculos"><i class="fa-solid fa-car me-1"></i>Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/green_volt/comprador"><i class="fa-solid fa-cart-shopping me-1"></i>Comprar</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="navbar-text text-white">
                        Hola, <?= htmlspecialchars($_SESSION['user_nombre'] ?? 'Usuario') ?>
                    </span>
                    <a href="/green_volt/auth/logout" class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket me-1"></i>Cerrar Sesión
                    </a>
                <?php else: ?>
                    <a href="/green_volt/auth/login" class="btn btn-outline-light btn-sm">
                        <i class="fa-solid fa-user me-1"></i>Iniciar Sesión
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- HERO SECTION / INICIO -->
<div class="bg-dark text-white text-center py-5 mb-5 shadow-sm">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Bienvenido a <span class="text-warning">Green Volt</span></h1>
        <p class="lead text-secondary my-3">La plataforma líder en exploración, comparación y gestión de vehículos eléctricos.</p>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <div class="text-warning mb-3">
                    <i class="fa-solid fa-bolt fa-3x"></i>
                </div>
                <h4 class="fw-bold">100% Eléctricos</h4>
                <p class="text-muted small">Explora la última tecnología en movilidad sostenible e híbrida/eléctrica.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <div class="text-primary mb-3">
                    <i class="fa-solid fa-scale-balanced fa-3x"></i>
                </div>
                <h4 class="fw-bold">Comparador</h4>
                <p class="text-muted small">Compara precios, rango de batería y especificaciones de diferentes marcas.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <div class="text-success mb-3">
                    <i class="fa-solid fa-leaf fa-3x"></i>
                </div>
                <h4 class="fw-bold">Cero Emisiones</h4>
                <p class="text-muted small">Contribuye al medio ambiente eligiendo la mejor opción para tu transporte.</p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>