<div class="container my-5">
    <h2>Registrar Nuevo Vehículo Eléctrico</h2>
    <form action="/green_volt/vehiculos/guardar" method="POST" class="mt-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre del Vehículo</label>
                <input type="text" name="nombre" class="form-control" required placeholder="Ej. BYD Seal">
            </div>
            <div class="col-md-6">
                <label class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" required placeholder="Ej. AWD Excellence">
            </div>
            <div class="col-md-4">
                <label class="form-label">Año</label>
                <input type="number" name="anio" class="form-control" value="2024" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Precio ($ USD)</label>
                <input type="number" step="0.01" name="precio" class="form-control" required placeholder="0.00">
            </div>
            <div class="col-md-4">
                <label class="form-label">Autonomía (km)</label>
                <input type="number" name="autonomia" class="form-control" required placeholder="Ej. 500">
            </div>
            <div class="col-md-6">
                <label class="form-label">ID Marca</label>
                <input type="number" name="marca_id" class="form-control" value="1" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Stock Inicial</label>
                <input type="number" name="stock" class="form-control" value="1" required>
            </div>
            <div class="col-12">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" required></textarea>
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-success">Guardar Vehículo</button>
                <a href="/green_volt/vehiculos" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
</div>