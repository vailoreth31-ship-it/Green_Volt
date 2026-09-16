<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Green Volt</title>
    <!-- Bootstrap CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<!-- BARRA DE NAVEGACIÓN -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/green_volt/">
            <i class="fa-solid fa-bolt text-warning me-2"></i>Green Volt
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="/green_volt/"><i class="fa-solid fa-house me-1"></i>Volver al Inicio</a>
        </div>
    </div>
</nav>

<!-- FORMULARIO DE LOGIN -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-circle-user fa-3x text-primary mb-2"></i>
                        <h4 class="fw-bold">Iniciar Sesión</h4>
                        <p class="text-muted small">Ingresa tus credenciales para acceder</p>
                    </div>

                    <!-- Mensaje de Error -->
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger py-2 small" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Mensaje de Éxito -->
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success py-2 small" role="alert">
                            <i class="fa-solid fa-circle-check me-1"></i> <?= htmlspecialchars($success) ?>
                        </div>
                    <?php endif; ?>

                    <form action="/green_volt/auth/processLogin" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label font-weight-bold">Correo Electrónico:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">
                                <i class="fa-solid fa-right-to-bracket me-2"></i>Ingresar
                            </button>
                        </div>
                    </form>

                    <p class="text-center mt-3 mb-0 small">
                        ¿No tienes una cuenta? <a href="/green_volt/auth/register" class="text-decoration-none fw-bold">Regístrate aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>