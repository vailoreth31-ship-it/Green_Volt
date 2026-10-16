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

        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h3 class="h5 mb-1 fw-bold">Recomendación</h3>
                        <p class="text-muted mb-0">Basada en lo que estés buscando.</p>
                    </div>
                    <div class="col-md-5">
                        <label for="tipoBusqueda" class="form-label fw-bold mb-1">Estoy buscando</label>
                        <select id="tipoBusqueda" class="form-select">
                            <option value="kilometraje">Más kilometraje</option>
                            <option value="precio">Menor precio</option>
                            <option value="comodidad">Más comodidad</option>
                            <option value="ciudad">Uso urbano</option>
                            <option value="rendimiento">Mejor rendimiento</option>
                        </select>
                    </div>
                </div>
                <div id="recomendacionTexto" class="mt-3 fw-semibold text-primary"></div>
            </div>
        </div>

        <script>
            const vehiculos = <?= json_encode($vehiculos, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
            const vehiculoA = document.getElementById('vehiculoA');
            const vehiculoB = document.getElementById('vehiculoB');
            const tabla = document.getElementById('tablaComparacion');
            const tipoBusqueda = document.getElementById('tipoBusqueda');
            const recomendacionTexto = document.getElementById('recomendacionTexto');

            function obtenerVehiculo(id) {
                return vehiculos.find(vehiculo => String(vehiculo.id) === String(id));
            }

            function formatearPrecio(valor) {
                return '$' + Number(valor || 0).toLocaleString('es-ES', { minimumFractionDigits: 2 });
            }

            function obtenerRecomendacion(primero, segundo, criterio) {
                const a = primero;
                const b = segundo;

                switch (criterio) {
                    case 'kilometraje':
                        return Number(a.autonomia || 0) >= Number(b.autonomia || 0) ? a : b;
                    case 'precio':
                        return Number(a.precio || 0) <= Number(b.precio || 0) ? a : b;
                    case 'comodidad':
                        if ((String(a.descripcion || '') + ' ' + String(a.nombre || '')).toLowerCase().includes('scooter') || (String(a.descripcion || '') + ' ' + String(a.nombre || '')).toLowerCase().includes('urbana')) {
                            return a;
                        }
                        if ((String(b.descripcion || '') + ' ' + String(b.nombre || '')).toLowerCase().includes('scooter') || (String(b.descripcion || '') + ' ' + String(b.nombre || '')).toLowerCase().includes('urbana')) {
                            return b;
                        }
                        return Number(a.autonomia || 0) >= Number(b.autonomia || 0) ? a : b;
                    case 'ciudad':
                        if ((String(a.descripcion || '') + ' ' + String(a.nombre || '')).toLowerCase().includes('scooter') || (String(a.descripcion || '') + ' ' + String(a.nombre || '')).toLowerCase().includes('urbana')) {
                            return a;
                        }
                        if ((String(b.descripcion || '') + ' ' + String(b.nombre || '')).toLowerCase().includes('scooter') || (String(b.descripcion || '') + ' ' + String(b.nombre || '')).toLowerCase().includes('urbana')) {
                            return b;
                        }
                        return Number(a.autonomia || 0) >= Number(b.autonomia || 0) ? a : b;
                    case 'rendimiento':
                        return Number(a.autonomia || 0) >= Number(b.autonomia || 0) ? a : b;
                    default:
                        return Number(a.autonomia || 0) >= Number(b.autonomia || 0) ? a : b;
                }
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
                        <td>${esPrecio ? formatearPrecio(valorA) : (valorA || 'No disponible')}${etiqueta === 'Autonomía' ? ' km' : ''}</td>
                        <td>${esPrecio ? formatearPrecio(valorB) : (valorB || 'No disponible')}${etiqueta === 'Autonomía' ? ' km' : ''}</td>
                    </tr>
                `).join('');

                const recomendado = obtenerRecomendacion(primero, segundo, tipoBusqueda.value);
                const nombreRecomendado = recomendado.nombre ?? recomendado.modelo ?? 'Vehículo recomendado';
                const valorRecomendado = recommended => {
                    if (tipoBusqueda.value === 'precio') return formatearPrecio(recommended.precio || 0);
                    if (tipoBusqueda.value === 'kilometraje' || tipoBusqueda.value === 'rendimiento') return `${recommended.autonomia || 0} km de autonomía`;
                    if (tipoBusqueda.value === 'comodidad' || tipoBusqueda.value === 'ciudad') return 'mejor equilibrio para uso diario';
                    return recomendacionTexto.textContent;
                };

                const textos = {
                    kilometraje: 'Para más kilometraje, te recomendamos ' + nombreRecomendado + ' porque ofrece ' + (recomendado.autonomia || 0) + ' km de autonomía.',
                    precio: 'Si buscas ahorrar, te recomendamos ' + nombreRecomendado + ' con un precio de ' + formatearPrecio(recomendado.precio || 0) + '.',
                    comodidad: 'Para mayor comodidad en uso diario, te recomendamos ' + nombreRecomendado + ', que ofrece una experiencia más equilibrada para desplazamientos frecuentes.',
                    ciudad: 'Para uso urbano, te recomendamos ' + nombreRecomendado + ' por su mejor maniobrabilidad y adaptabilidad en ciudad.',
                    rendimiento: 'Para mejor rendimiento, te recomendamos ' + nombreRecomendado + ' por su autonomía y equilibrio general entre potencia y eficiencia.'
                };

                recomendacionTexto.textContent = textos[tipoBusqueda.value] || textos.kilometraje;
            }

            vehiculoA.addEventListener('change', mostrarComparacion);
            vehiculoB.addEventListener('change', mostrarComparacion);
            tipoBusqueda.addEventListener('change', mostrarComparacion);
            mostrarComparacion();
        </script>
    <?php endif; ?>
</main>
