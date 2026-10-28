<main class="container my-5">
    <h1 class="h2">Editar vehículo</h1>
    <form action="/green_volt/vehiculos/actualizar/<?= rawurlencode((string) $vehiculo['id']) ?>" method="POST" class="mt-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="nombre">Nombre del vehículo</label>
                <input id="nombre" type="text" name="nombre" class="form-control" required value="<?= htmlspecialchars($vehiculo['nombre'] ?? '') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="modelo">Modelo</label>
                <input id="modelo" type="text" name="modelo" class="form-control" required value="<?= htmlspecialchars($vehiculo['modelo'] ?? '') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="anio">Año</label>
                <input id="anio" type="number" name="anio" class="form-control" min="1" required value="<?= htmlspecialchars((string) ($vehiculo['anio'] ?? '')) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="precio">Precio ($ USD)</label>
                <input id="precio" type="number" step="0.01" min="0" name="precio" class="form-control" required value="<?= htmlspecialchars((string) ($vehiculo['precio'] ?? '0')) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="autonomia">Autonomía (km)</label>
                <input id="autonomia" type="number" min="0" name="autonomia" class="form-control" required value="<?= htmlspecialchars((string) ($vehiculo['autonomia'] ?? '0')) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="marca_id">ID de marca</label>
                <input id="marca_id" type="number" min="1" name="marca_id" class="form-control" required value="<?= htmlspecialchars((string) ($vehiculo['marca_id'] ?? '1')) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="stock">Stock</label>
                <input id="stock" type="number" min="0" name="stock" class="form-control" required value="<?= htmlspecialchars((string) ($vehiculo['stock'] ?? '0')) ?>">
            </div>
            <div class="col-12">
                <label class="form-label" for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?= htmlspecialchars($vehiculo['descripcion'] ?? '') ?></textarea>
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="/green_volt/vehiculos" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</main>
