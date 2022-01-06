<div>
    <!-- Modal -->
    <div class="modal fade" id="modalDirecciones" tabindex="-1" aria-labelledby="modalDireccionesLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalDireccionesLabel">{{ $title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form wire:submit.prevent="createNewData" id="createNewDir">
                <div class="col">
                    <div class="form-floating mb-3">
                        <select class="form-control form-select
                        @error('id_direccion')
                        is-invalid
                        @enderror
                        " wire:model="id_direccion">
                            @forelse ($departamentos as $departamento)
                            @if($loop->first)
                            <option>Seleccione un departamento</option>
                            @endif
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                            @empty
                            <option value="0">Ocurrio un error</option>
                            @endforelse
                             
                        </select>
                        <label for="departamentoD">Departamento</label>
                        @error('id_direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <select class="form-control form-select
                        @error('id_municipio')
                        is-invalid
                        @enderror
                        " wire:model="id_municipio">
                            @forelse ($municipios as $municipio)
                            @if($loop->first)
                            <option>Seleccione un municipio</option>
                            @endif
                            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                            @empty
                            <option >Seleccione un departamento</option>
                            @endforelse
                             
                        </select>
                        <label for="departamentoD">Municipio</label>
                        @error('id_municipio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control
                        @error('direccion')
                            is-invalid
                        @enderror
                        " id="direccionD" placeholder="Dirección" maxlength="500" wire:model="direccion">
                        <label for="direccionD">Dirección de {{ $title === 'Agregar Dirección de Facturacion' ? 'Facturación' : 'Envío' }}</label>
                        @error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                      </div>
                </div>

                @if($title !== 'Agregar Dirección de Facturacion')
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control
                        @error('telefono')
                            is-invalid
                        @enderror
                        " id="telefonoD" placeholder="61111111" wire:model="telefono">
                        <label for="telefonoD">Teléfono</label>
                        @error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                      </div>
                </div>
                @endif

                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control
                        @error('referencia')
                            is-invalid
                        @enderror
                        " id="referenciaD" placeholder="61111111" wire:model="referencia" maxlength="200">
                        <label for="referenciaD">Referencia de {{ $title === 'Agregar Dirección de Facturacion' ? 'Facturación' : 'Envío' }}</label>
                        @error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                      </div>
                </div>

                {{-- <div class="col">
                    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
                </div> --}}
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" form="createNewDir">Guardar</button>
            </div>
        </div>
        </div>
    </div>
    <!-- end Modal -->

    @push('scripts')
    <script>
        Livewire.on('refreshList', function() {
           /*  var modalHide = new bootstrap.Modal(document.getElementById('myModal'))

            modalHide.hide() */
            console.log('yeah');
            Livewire.emit('resetDirModal');
        })
    </script>
    @endpush
</div>
