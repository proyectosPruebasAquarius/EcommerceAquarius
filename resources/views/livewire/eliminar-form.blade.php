<div>
    @if($hideAndShow)
        <h3>Verifica tú correo eléctronico</h3>
        <h6 class="fw-bold text-dark mt-3">
            Nuestro equipo enviará un enlace a tú correo en un maximo de 5 días, por favor verifique en la bandeja de spam. 
            Si el correo no es recibido en el tiempo previamente descrito, contactenos por nuestros diferentes medios de contacto o rellene nuevamente el formulario.
        </h6>
    @else
        <h5 class="card-title">Motivo de Eliminado de cuenta</h5>
        <form wire:submit.prevent="storeForm">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo por el cual desea eliminar su cuenta</label>
                        <input type="text" class="form-control @error ('motivo') is-invalid @enderror" id="motivo" name="motivo" maxlength="100" wire:model.lazy="motivo">
                        @error('motivo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control @error ('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" maxlength="250" wire:model.lazy="descripcion">
                        @error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Sugerencias</label>
                        <textarea class="form-control @error ('sugerencia') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" maxlength="250" wire:model.lazy="sugerencia"></textarea>
                        @error('sugerencia') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-12">
                    <p class="fw-bold text-dark">
                        Al eliminar tú cuenta no podras registrarte haciendo uso del mismo correo. Un enlace de confirmación
                        será enviado por nuestro equipo a tú correo eléctronico,
                        para confirmar tú identidad y la autorización que aceptas eliminar tú cuenta. Como {{
                        env('APP_NAME') }} lamentamos que te vayas, esperamos mejorar cada dia más por la sastifación de
                        nuestros clientes, esperamos que vuelvas. <br />
                        - ATT: El equipo de {{ env('APP_NAME') }}
                    </p>
                </div>
                <div class="col-12 text-center mx-auto">
                    <button type="submit" class="btn btn-secondary" wire:target="storeForm" wire:loading.attr="disabled">
                        <div wire:target="storeForm" wire:loading.class="d-none">
                            Enviar
                        </div>

                        <div wire:loading wire:target="storeForm">
                            Enviando...
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>                        
                        </div>
                    </button>
                </div>
            </div>
        </form>
    @endif    
</div>