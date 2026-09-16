<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Catálogo - Green Volt' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para Iconos -->
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
                <li class="nav-item">
                    <a class="nav-link" href="/green_volt/comparador"><i class="fa-solid fa-code-compare me-1"></i>Comparador</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <a href="/green_volt/vehiculos/crear" class="btn btn-outline-success btn-sm">
                    <i class="fa-solid fa-plus me-1"></i>Nuevo Vehículo
                </a>
                <a href="/green_volt/auth/login" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-user me-1"></i>Iniciar Sesión
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- CONTENIDO PRINCIPAL -->
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><?= $titulo ?? 'Catálogo de Vehículos Eléctricos' ?></h2>
            <p class="text-muted mb-0">Explora nuestra selección de modelos disponibles.</p>
        </div>
        <a href="/green_volt/vehiculos/crear" class="btn btn-success">
            <i class="fa-solid fa-plus me-1"></i>Agregar Vehículo
        </a>
    </div>

    <div class="row g-4">
        <?php if (!empty($vehiculos)): ?>
            <?php foreach ($vehiculos as $v): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        
                        <!-- IMAGEN DEL VEHÍCULO -->
                        <div style="height: 200px; overflow: hidden; background-color: #f8f9fa;">
                            <?php if (!empty($v['imagen'])): ?>
                                <img src="<?= htmlspecialchars($v['imagen']) ?>" 
                                    class="card-img-top w-100 h-100" 
                                    style="object-fit: cover;" 
                                    alt="<?= htmlspecialchars($v['nombre']) ?>">
                            <?php else: ?>
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center h-100">
                                    <i class="fa-solid fa-car-side fa-4x opacity-50"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($v['nombre'] ?? $v['modelo'] ?? 'Vehículo Eléctrico') ?></h5>
                            <p class="card-text text-muted flex-grow-1 small">
                                <?= htmlspecialchars($v['descripcion'] ?? 'Sin descripción disponible.') ?>
                            </p>
                            
                            <ul class="list-group list-group-flush my-3 small">
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span class="text-muted">Precio:</span>
                                    <strong class="text-success">$<?= isset($v['precio']) ? number_format($v['precio'], 2) : '0.00' ?></strong>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span class="text-muted">Autonomía:</span>
                                    <strong><?= htmlspecialchars($v['autonomia'] ?? 0) ?> km</strong>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span class="text-muted">Modelo / Año:</span>
                                    <span><?= htmlspecialchars($v['modelo'] ?? '') ?> (<?= htmlspecialchars($v['anio'] ?? '2024') ?>)</span>
                                </li>
                            </ul>

                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-eye me-1"></i>Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No hay vehículos registrados en la base de datos.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>