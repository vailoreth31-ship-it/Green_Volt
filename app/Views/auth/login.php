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