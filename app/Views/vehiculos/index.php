<style>
    .catalog-page {
        padding: 24px 0 40px;
        background: #f3f3f3;
    }

    .catalog-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .catalog-header h2 {
        margin: 0;
        font-size: clamp(2.2rem, 3vw, 3.4rem);
        line-height: 1.1;
        font-weight: 800;
        color: #111;
    }

    .catalog-subtitle {
        margin: 8px 0 0;
        color: #5e5e5e;
        font-size: 1.05rem;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #2f7edc;
        color: #fff;
        border-radius: 8px;
        padding: 0.8rem 1.2rem;
        text-decoration: none;
        font-weight: 700;
        box-shadow: 0 2px 0 rgba(0,0,0,0.08);
    }

    .btn-add:hover {
        color: #fff;
        text-decoration: none;
        background: #2468b6;
    }

    .catalog-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .catalog-card {
        background: #fff;
        border: 1px solid #d7d7d7;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    }

    .catalog-image {
        height: 220px;
        background: #eef4fb;
    }

    .catalog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .catalog-body {
        padding: 18px 18px 16px;
    }

    .catalog-name {
        margin: 0 0 10px;
        font-size: 1.15rem;
        font-weight: 800;
        color: #111;
    }

    .catalog-description {
        margin: 0 0 12px;
        font-size: 0.96rem;
        line-height: 1.5;
        color: #4d4d4d;
    }

    .catalog-meta {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .catalog-meta li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 7px 0;
        border-bottom: 1px solid #efefef;
        color: #2a2a2a;
        font-size: 0.96rem;
    }

    .catalog-meta li:last-child {
        border-bottom: none;
    }

    .catalog-meta span {
        color: #585d64;
    }

    .catalog-price {
        color: #1c8b3f;
        font-weight: 800;
    }

    @media (max-width: 900px) {
        .catalog-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .catalog-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .catalog-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- CONTENIDO PRINCIPAL -->
<div class="catalog-page">
    <div class="container">
        <div class="catalog-header">
            <div>
                <h2><?= $titulo ?? 'Catálogo de Vehículos Eléctricos' ?></h2>
                <p class="catalog-subtitle">Explora nuestra selección de modelos disponibles.</p>
            </div>
            <a href="/green_volt/vehiculos/crear" class="btn-add">
                <i class="fa-solid fa-plus me-1"></i>Agregar Vehículo
            </a>
        </div>

        <div class="catalog-grid">
            <?php if (!empty($vehiculos)): ?>
                <?php foreach ($vehiculos as $v): ?>
                    <article class="catalog-card">
                        <div class="catalog-image">
                            <?php if (!empty($v['imagen'])): ?>
                                <img src="<?= htmlspecialchars($v['imagen']) ?>" alt="<?= htmlspecialchars($v['nombre'] ?? $v['modelo'] ?? 'Vehículo Eléctrico') ?>">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                                    <i class="fa-solid fa-car-side fa-4x opacity-50"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="catalog-body">
                            <h3 class="catalog-name"><?= htmlspecialchars($v['nombre'] ?? $v['modelo'] ?? 'Vehículo Eléctrico') ?></h3>
                            <p class="catalog-description"><?= htmlspecialchars($v['descripcion'] ?? 'Sin descripción disponible.') ?></p>

                            <ul class="catalog-meta">
                                <li>
                                    <span>Precio:</span>
                                    <strong class="catalog-price">$<?= isset($v['precio']) ? number_format($v['precio'], 2) : '0.00' ?></strong>
                                </li>
                                <li>
                                    <span>Autonomía:</span>
                                    <strong><?= htmlspecialchars($v['autonomia'] ?? 0) ?> km</strong>
                                </li>
                                <li>
                                    <span>Modelo / Año:</span>
                                    <strong><?= htmlspecialchars($v['modelo'] ?? '') ?> (<?= htmlspecialchars($v['anio'] ?? '2024') ?>)</strong>
                                </li>
                            </ul>

                        </div>
                    </article>
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
</div>