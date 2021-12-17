<div>
    <label for="sorting">Ordenar por:</label>
    <select class="form-control" id="sorting" wire:model="order">
        <option value="productos.nombre, asc">Orden A - Z</option>
        <option value="productos.nombre, desc">Orden Z - A</option>
        {{-- <option>Popularity</option> --}}
        <option value="inventarios.precio_venta, asc">Menor - Mayor Precio</option>
        <option value="inventarios.precio_venta, desc">Mayor - Menor Precio</option>
        {{-- <option>AverageRating</option> --}}
    </select>
</div>