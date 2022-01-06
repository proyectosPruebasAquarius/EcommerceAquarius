<div>
    <div class="col-md-12">
        <div class="single-form form-default">
            <label>Departamento</label>
            <div class="form-input form">
                <div class="select-items">
                    <select class="form-control" name="departamento" wire:model="id_departamento">
                        <option value="0" selected>Departamento</option>
                        @forelse ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}" >{{ $departamento->nombre }}</option>  
                        @empty
                            {{ __('No se encontraron departamentos') }}
                        @endforelse              
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="single-form form-default">
            <label>Municipio</label>
            <div class="form-input form">
                <livewire:municipios :id_departamento="$id_departamento" :key="$id_departamento"/>                
            </div>
        </div>
    </div>    
</div>
