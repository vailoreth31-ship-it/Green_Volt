<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5">
                <p class="text-uppercase fw-bold text-primary mb-2">Servicios y Soporte</p>
                <h1 class="display-5 fw-bold">Green Volt</h1>
                <p class="lead text-muted">Asistencia técnica y mantenimiento para tu movilidad eléctrica.</p>
            </div>

            <?php if (!empty($_SESSION['soporte_message'] ?? '')): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['soporte_message']); ?>
                </div>
                <?php unset($_SESSION['soporte_message']); ?>
            <?php endif; ?>

            <div class="row g-4">
                <?php foreach ($servicios ?? [] as $servicio): ?>
                    <div class="col-md-6 col-xl-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <div class="mb-3 text-primary fs-2">
                                    <i class="fa-solid fa-screwdriver-wrench"></i>
                                </div>
                                <h3 class="card-title h4"><?= htmlspecialchars($servicio['nombre'] ?? 'Servicio') ?></h3>
                                <p class="card-text text-muted flex-grow-1">
                                    <?= htmlspecialchars($servicio['descripcion'] ?? 'Servicio disponible para clientes de Green Volt.') ?>
                                </p>
                                <div class="mt-3 d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-success">
                                        <?= !empty($servicio['precio']) ? '$' . number_format((float) $servicio['precio'], 2) : 'Consultar precio' ?>
                                    </span>
                                    <button class="btn btn-primary btn-sm" type="button">Solicitar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-5 card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h3 mb-3">Agendar servicio</h2>
                    <form action="/green_volt/soporte/agendar" method="POST">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Servicio</label>
                                <select name="servicio_id" class="form-select" required>
                                    <option value="">Selecciona</option>
                                    <option value="1">Mantenimiento Preventivo Especializado</option>
                                    <option value="2">Diagnóstico Electrónico y Escáner</option>
                                    <option value="3">Instalación y Revisión de Cargadores Domiciliarios</option>
                                    <option value="4">Inspección y Balanceo de Batería (SoH)</option>
                                    <option value="5">Revisión de Sistema de Frenos y Neumáticos</option>
                                    <option value="6">Soporte de Garantía y Repuestos</option>
                                    <option value="7">Asistencia Técnica en Carretera / Consulta General</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha</label>
                                <input type="date" name="fecha_cita" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Hora</label>
                                <input type="time" name="hora_cita" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Comentarios</label>
                                <textarea name="comentario" class="form-control" rows="4" placeholder="Describe el problema o la necesidad del servicio..."></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Agendar atención</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
