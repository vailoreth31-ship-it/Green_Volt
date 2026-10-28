<main class="catalog-page">
    <div class="container">
        <header class="catalog-header">
            <div>
                <p class="catalog-eyebrow"><i class="fa-solid fa-bolt"></i> Green Volt</p>
                <h1><?= htmlspecialchars($titulo ?? 'Catálogo de Vehículos Eléctricos') ?></h1>
                <p class="catalog-subtitle">Explora nuestra selección de modelos disponibles.</p>
            </div>
            <a href="/green_volt/vehiculos/crear" class="btn-add">
                <i class="fa-solid fa-plus me-1"></i>Agregar Vehículo
            </a>
        </header>

        <section class="catalog-panel" aria-label="Listado de vehículos">
            <div class="catalog-toolbar">
                <label class="catalog-page-size">
                    Mostrar
                    <select id="catalogPageSize" aria-label="Vehículos por página">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                    </select>
                    registros
                </label>
                <label class="catalog-search">
                    <span>Buscar:</span>
                    <input id="catalogSearch" type="search" placeholder="Nombre, modelo..." autocomplete="off">
                </label>
            </div>

            <div class="catalog-table-wrap">
                <table class="catalog-table">
                    <thead>
                        <tr>
                            <th scope="col">Vehículo</th>
                            <th scope="col">Modelo / Año</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Autonomía</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="catalogTableBody">
                        <?php if (!empty($vehiculos)): ?>
                            <?php foreach ($vehiculos as $v): ?>
                                <?php
                                    $nombre = $v['nombre'] ?? $v['modelo'] ?? 'Vehículo eléctrico';
                                    $modelo = trim(($v['modelo'] ?? '') . ' ' . (isset($v['anio']) ? '(' . $v['anio'] . ')' : ''));
                                    $stock = (int) ($v['stock'] ?? 0);
                                ?>
                                <tr class="catalog-row">
                                    <td data-label="Vehículo">
                                        <div class="catalog-vehicle">
                                            <?php if (!empty($v['imagen'])): ?>
                                                <img src="<?= htmlspecialchars($v['imagen']) ?>" alt="<?= htmlspecialchars($nombre) ?>" loading="lazy">
                                            <?php else: ?>
                                                <span class="catalog-vehicle-placeholder" aria-hidden="true"><i class="fa-solid fa-car-side"></i></span>
                                            <?php endif; ?>
                                            <strong><?= htmlspecialchars($nombre) ?></strong>
                                        </div>
                                    </td>
                                    <td data-label="Modelo / Año"><?= htmlspecialchars($modelo !== '' ? $modelo : 'No especificado') ?></td>
                                    <td data-label="Descripción" class="catalog-description-cell"><?= htmlspecialchars($v['descripcion'] ?? 'Sin descripción disponible.') ?></td>
                                    <td data-label="Autonomía"><?= htmlspecialchars((string) ($v['autonomia'] ?? 0)) ?> km</td>
                                    <td data-label="Stock"><span class="catalog-stock<?= $stock < 1 ? ' is-empty' : '' ?>"><?= $stock ?></span></td>
                                    <td data-label="Precio" class="catalog-price">$<?= isset($v['precio']) ? number_format((float) $v['precio'], 2) : '0.00' ?></td>
                                    <td data-label="Acciones">
                                        <div class="catalog-actions">
                                            <a class="catalog-action-button is-edit" href="/green_volt/vehiculos/editar/<?= rawurlencode((string) ($v['id'] ?? '')) ?>">
                                                <i class="fa-solid fa-pen-to-square" aria-hidden="true"></i>
                                                <span>Editar</span>
                                            </a>
                                            <form action="/green_volt/vehiculos/eliminar/<?= rawurlencode((string) ($v['id'] ?? '')) ?>" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este vehículo?');">
                                                <button class="catalog-action-button is-delete" type="submit">
                                                    <i class="fa-solid fa-trash-can" aria-hidden="true"></i>
                                                    <span>Eliminar</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="catalog-empty-row">
                                <td colspan="7">No hay vehículos registrados en la base de datos.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <footer class="catalog-table-footer">
                <p id="catalogResults" aria-live="polite"></p>
                <nav class="catalog-pagination" aria-label="Paginación del catálogo">
                    <button type="button" id="catalogPrevious" disabled>Anterior</button>
                    <span id="catalogCurrentPage" aria-current="page">1</span>
                    <button type="button" id="catalogNext" disabled>Siguiente</button>
                </nav>
            </footer>
        </section>
    </div>
</main>

<script>
    (() => {
        const tableBody = document.getElementById('catalogTableBody');
        const rows = Array.from(tableBody.querySelectorAll('.catalog-row'));
        const searchInput = document.getElementById('catalogSearch');
        const pageSizeSelect = document.getElementById('catalogPageSize');
        const resultsLabel = document.getElementById('catalogResults');
        const currentPageLabel = document.getElementById('catalogCurrentPage');
        const previousButton = document.getElementById('catalogPrevious');
        const nextButton = document.getElementById('catalogNext');
        let currentPage = 1;

        function renderCatalog() {
            const query = searchInput.value.trim().toLocaleLowerCase();
            const matchingRows = rows.filter((row) => row.textContent.toLocaleLowerCase().includes(query));
            const pageSize = Number(pageSizeSelect.value);
            const pageCount = Math.max(1, Math.ceil(matchingRows.length / pageSize));
            currentPage = Math.min(currentPage, pageCount);

            rows.forEach((row) => {
                row.hidden = true;
            });

            const firstIndex = (currentPage - 1) * pageSize;
            matchingRows.slice(firstIndex, firstIndex + pageSize).forEach((row) => {
                row.hidden = false;
            });

            const firstResult = matchingRows.length === 0 ? 0 : firstIndex + 1;
            const lastResult = Math.min(firstIndex + pageSize, matchingRows.length);
            resultsLabel.textContent = `Mostrando ${firstResult} a ${lastResult} de ${matchingRows.length} vehículos`;
            currentPageLabel.textContent = String(currentPage);
            previousButton.disabled = currentPage <= 1;
            nextButton.disabled = currentPage >= pageCount;
        }

        searchInput.addEventListener('input', () => {
            currentPage = 1;
            renderCatalog();
        });
        pageSizeSelect.addEventListener('change', () => {
            currentPage = 1;
            renderCatalog();
        });
        previousButton.addEventListener('click', () => {
            currentPage -= 1;
            renderCatalog();
        });
        nextButton.addEventListener('click', () => {
            currentPage += 1;
            renderCatalog();
        });

        renderCatalog();
    })();
</script>
