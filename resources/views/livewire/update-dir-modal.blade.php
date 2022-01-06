<div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Dirección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="updateDir" wire:submit.prevent="validateForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-floating">
                                    <input class="form-control @error('direccion') is-invalid @enderror" type="text" placeholder="Dirección de envío"
                                        name="direccion" id="direccion" wire:model.lazy="direccion" required>                                        
                                        @error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                                    <label for="direccion">Dirección de envío</label>
                                </div>
                            </div>
                           
                            @if($telefono !== "letmepass")
                            <div class="col-md-12 mb-2">
                                <div class="form-floating">
                                    <input class="form-control @error('telefono') is-invalid @enderror" type="text" placeholder="Teléfono" name="telefono"
                                        id="telefono" wire:model.lazy="telefono" required>
                                    @error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                                    <label for="telefono">Teléfono</label>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-12 mb-2">
                                {{-- @livewire('departamentos') --}}                            
                                <div class="form-floating">
                                    
                                  <select class="form-control form-select" name="departamento" id="departamento" wire:model="departamento">                                    
                                        @forelse ($departamentos as $depart)
                                           {{--  @if ($depart->id == $departamento)
                                                <option value="{{ $depart->id }}" selected>{{ $depart->nombre }}</option>
                                            @else
                                                <option value="{{ $depart->id }}" >{{ $depart->nombre }}</option>
                                            @endif   --}}
                                            <option value="{{ $depart->id }}" >{{ $depart->nombre }}</option>
                                        @empty
                                            {{ __('No se encontraron departamentos') }}
                                        @endforelse
                                  </select> 
                                  <label for="departamento" class="form-label">Departamento</label>
                                </div>                               
                            </div>
                            <div class="col-md-12 mb-2">                                                              
                                <div class="form-floating">
                                <select class="form-control form-select @error('id_municipio') is-invalid @enderror" name="id_municipio" id="municipio" wire:model="id_municipio">
                                    @forelse ($municipios as $municipio)
                                    <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                                    @empty
                                    <option disabled selected>Seleccione el departamento</option>
                                    @endforelse                                    
                                    </select> 
                                    @error('id_municipio') <span class="error text-danger">{{ $message }}</span> @enderror
                                    <label for="municipio" class="form-label">Municipio</label> 
                                </div>                          
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-floating">
                                    <input class="form-control @error('referencia') is-invalid @enderror" type="text" placeholder="Punto de referencia de envío"
                                        name="referencia" id="referencia" wire:model.lazy="referencia">
                                    @error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                                    <label for="referencia">Punto de referencia de envío</label>
                                </div>
                            </div>

                            {{-- <div class="col-md-12">
                                <div class="alert alert-light" role="alert">

                                </div>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="updateDir">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var logModal = document.getElementById('exampleModal')
            logModal.addEventListener('hidden.bs.modal', function () {
                var form = logModal.querySelector('form'); 
                Livewire.emit('resetV')
                /* form.querySelectorAll('input', 'select').forEach(element => {
                    if (element.classList.contains('is-invalid')) {
                        element.classList.remove('is-invalid')
                    }
                }); */
            })
        </script>
    @endpush
</div>