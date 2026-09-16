<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? 'Comparador - Green Volt') ?></title>
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
            <a class="nav-link" href="/green_volt/comprador"><i class="fa-solid fa-cart-shopping me-1"></i>Comprar</a>
            <a class="nav-link active" href="/green_volt/comparador"><i class="fa-solid fa-code-compare me-1"></i>Comparador</a>
        </div>
        <div class="d-flex gap-2">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="navbar-text text-white">Hola, <?= htmlspecialchars($_SESSION['user_nombre'] ?? 'Usuario') ?></span>
                <a href="/green_volt/auth/logout" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
            <?php else: ?>
                <a href="/green_volt/auth/login" class="btn btn-outline-light btn-sm">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="container my-5">
    <div class="mb-4">
        <h1 class="fw-bold"><i class="fa-solid fa-code-compare text-primary me-2"></i><?= htmlspecialchars($titulo ?? 'Comparador') ?></h1>
        <p class="text-muted">Selecciona dos vehículos para comparar sus características.</p>
    </div>

    <?php if (count($vehiculos ?? []) < 2): ?>
        <div class="alert alert-warning">Se necesitan al menos dos vehículos registrados para comparar.</div>
    <?php else: ?>
        <div class="row g-3 mb-4">
            <div class="col-md-5">
                <label for="vehiculoA" class="form-label fw-bold">Primer vehículo</label>
                <select id="vehiculoA" class="form-select">
                    <?php foreach ($vehiculos as $vehiculo): ?>
                        <option value="<?= (int) $vehiculo['id'] ?>">
                            <?= htmlspecialchars($vehiculo['nombre'] ?? $vehiculo['modelo'] ?? 'Vehículo') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end justify-content-center pb-2">
                <span class="badge rounded-pill text-bg-primary fs-6">VS</span>
            </div>
            <div class="col-md-5">
                <label for="vehiculoB" class="form-label fw-bold">Segundo vehículo</label>
                <select id="vehiculoB" class="form-select">
                    <?php foreach ($vehiculos as $indice => $vehiculo): ?>
                        <option value="<?= (int) $vehiculo['id'] ?>" <?= $indice === 1 ? 'selected' : '' ?>>
                            <?= htmlspecialchars($vehiculo['nombre'] ?? $vehiculo['modelo'] ?? 'Vehículo') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-bordered align-middle mb-0 bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>Característica</th>
                        <th id="nombreA">Vehículo 1</th>
                        <th id="nombreB">Vehículo 2</th>
                    </tr>
                </thead>
                <tbody id="tablaComparacion"></tbody>
            </table>
        </div>

        <script>
            const vehiculos = <?= json_encode($vehiculos, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
            const vehiculoA = document.getElementById('vehiculoA');
            const vehiculoB = document.getElementById('vehiculoB');
            const tabla = document.getElementById('tablaComparacion');

            function obtenerVehiculo(id) {
                return vehiculos.find(vehiculo => String(vehiculo.id) === String(id));
            }

            function mostrarComparacion() {
                const primero = obtenerVehiculo(vehiculoA.value);
                const segundo = obtenerVehiculo(vehiculoB.value);
                const nombrePrimero = primero.nombre ?? primero.modelo ?? 'Vehículo 1';
                const nombreSegundo = segundo.nombre ?? segundo.modelo ?? 'Vehículo 2';

                document.getElementById('nombreA').textContent = nombrePrimero;
                document.getElementById('nombreB').textContent = nombreSegundo;
                tabla.innerHTML = [
                    ['Precio', primero.precio, segundo.precio, true],
                    ['Autonomía', primero.autonomia, segundo.autonomia, false],
                    ['Modelo', primero.modelo, segundo.modelo, false],
                    ['Año', primero.anio, segundo.anio, false],
                    ['Descripción', primero.descripcion, segundo.descripcion, false]
                ].map(([etiqueta, valorA, valorB, esPrecio]) => `
                    <tr>
                        <th>${etiqueta}</th>
                        <td>${esPrecio ? '$' + Number(valorA || 0).toLocaleString('es-ES', { minimumFractionDigits: 2 }) : (valorA || 'No disponible')}${etiqueta === 'Autonomía' ? ' km' : ''}</td>
                        <td>${esPrecio ? '$' + Number(valorB || 0).toLocaleString('es-ES', { minimumFractionDigits: 2 }) : (valorB || 'No disponible')}${etiqueta === 'Autonomía' ? ' km' : ''}</td>
                    </tr>
                `).join('');
            }

            vehiculoA.addEventListener('change', mostrarComparacion);
            vehiculoB.addEventListener('change', mostrarComparacion);
            mostrarComparacion();
        </script>
    <?php endif; ?>
</main>
</body>
</html>
