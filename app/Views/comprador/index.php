<main class="container-xxl my-5 px-3 px-xl-4">
    <div class="mb-4 mb-lg-4">
        <h1 class="fw-bold"><i class="fa-solid fa-cart-shopping text-success me-2"></i><?= htmlspecialchars($titulo ?? 'Comprar un Vehículo') ?></h1>
        <p class="text-muted">Elige un vehículo y déjanos tus datos para recibir asesoría de compra.</p>
    </div>

    <?php if (!empty($confirmacion)): ?>
        <div class="alert alert-success shadow-sm" role="alert">
            <h4 class="alert-heading"><i class="fa-solid fa-circle-check me-2"></i>Solicitud enviada</h4>
            <p class="mb-0">Gracias, <?= htmlspecialchars($confirmacion['nombre']) ?>. Recibimos tu solicitud para <strong><?= htmlspecialchars($confirmacion['vehiculo']) ?></strong>. Te contactaremos en <?= htmlspecialchars($confirmacion['correo']) ?>.</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row g-4 g-xl-5 align-items-start">
        <div class="col-lg-8">
            <div class="row g-3">
                <?php if (!empty($vehiculos)): ?>
                    <?php foreach ($vehiculos as $vehiculo): ?>
                        <div class="col-md-6 col-xl-4">
                            <?php $seleccionado = (int) ($vehiculoSeleccionado ?? 0) === (int) $vehiculo['id']; ?>
                            <div class="card h-100 shadow-sm <?= $seleccionado ? 'border border-success border-2' : 'border-0' ?>">
                                <?php if (!empty($vehiculo['imagen'])): ?>
                                    <img src="<?= htmlspecialchars($vehiculo['imagen']) ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="<?= htmlspecialchars($vehiculo['nombre'] ?? $vehiculo['modelo'] ?? 'Vehículo') ?>">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;"><i class="fa-solid fa-car-side fa-4x text-secondary"></i></div>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold"><?= htmlspecialchars($vehiculo['nombre'] ?? $vehiculo['modelo'] ?? 'Vehículo eléctrico') ?></h5>
                                    <?php if ($seleccionado): ?>
                                        <span class="badge text-bg-success align-self-start mb-2">Vehículo seleccionado</span>
                                    <?php endif; ?>
                                    <p class="text-muted small flex-grow-1"><?= htmlspecialchars($vehiculo['descripcion'] ?? 'Vehículo eléctrico disponible.') ?></p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <strong class="text-success">$<?= number_format((float) ($vehiculo['precio'] ?? 0), 2) ?></strong>
                                        <span class="badge text-bg-light"><?= htmlspecialchars($vehiculo['autonomia'] ?? 0) ?> km</span>
                                    </div>
                                    <a href="<?= htmlspecialchars($baseUrl) ?>/comprador?vehiculo=<?= (int) $vehiculo['id'] ?>#solicitud" class="btn <?= $seleccionado ? 'btn-success' : 'btn-outline-success' ?> w-100">
                                        <i class="fa-solid <?= $seleccionado ? 'fa-circle-check' : 'fa-cart-shopping' ?> me-1"></i><?= $seleccionado ? 'Vehículo elegido' : 'Elegir vehículo' ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12"><div class="alert alert-warning">No hay vehículos disponibles para comprar.</div></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-4" id="solicitud">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="h4 fw-bold mb-3">Solicita información</h3>
                    <?php if (!empty($vehiculoSeleccionado)): ?>
                        <div class="alert alert-success py-2" role="status">
                            <i class="fa-solid fa-circle-check me-1"></i>Vehículo seleccionado. Completa tus datos para continuar.
                        </div>
                    <?php endif; ?>
                    <form action="/green_volt/comprador/solicitar" method="POST">
                        <div class="mb-3">
                            <label for="vehiculo_id" class="form-label">Vehículo</label>
                            <select id="vehiculo_id" name="vehiculo_id" class="form-select" required>
                                <option value="">Selecciona un modelo</option>
                                <?php foreach (($vehiculos ?? []) as $vehiculo): ?>
                                    <option value="<?= (int) $vehiculo['id'] ?>" <?= (int) ($vehiculoSeleccionado ?? 0) === (int) $vehiculo['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($vehiculo['nombre'] ?? $vehiculo['modelo'] ?? 'Vehículo eléctrico') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= htmlspecialchars($formulario['nombre'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" id="correo" name="correo" class="form-control" value="<?= htmlspecialchars($formulario['correo'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" class="form-control" value="<?= htmlspecialchars($formulario['telefono'] ?? '') ?>" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa-solid fa-paper-plane me-1"></i>Enviar solicitud
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>