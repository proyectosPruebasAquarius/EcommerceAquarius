<div>
    <div class="select-items">
        <select class="form-control" name="id_municipio">
            <option value="0" disabled>Municipio</option>
            @forelse ($municipios as $municipio)
            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
            @empty
            <option disabled selected>Seleccione un departamento</option>
            @endforelse
        </select>
    </div>
</div>
