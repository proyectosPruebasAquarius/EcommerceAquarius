<div>
    <div class="modal fade" id="uriTrashModal" tabindex="-1" aria-labelledby="uriTrashModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="uriTrashModalLabel">{{ $whileMount ? 'Generando URL para '. $email : 'URL Generada para '. $email }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($whileMount)
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <p style="text-align: justify; text-justify: inter-word;">
                                    Copia y envia el enlace generado al usuario {{ $email }}, una vez enviado recuerda confirmar el enlace en el boton <b>Confirmar Enlace Generado</b>.
                                </p>
                            </div>
                            <div class="col-12">
                                <div class="pt-3 pb-2 ps-2 pe-2 badge text-wrap text-break text-dark text-start" style="background-color: #ebeef3">
                                    <p>
                                        {{ $url }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-12 mx-auto text-center mt-2">
                                <button class="btn btn-primary" wire:click="confirmURI()" wire:target="confirmURI" wire:loading.attr="disabled">
                                    Confirmar Enlace Generado
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer d-none">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    @push('partial-scripts')
        <script>
            'use strict';
            var myModalEl = document.getElementById('uriTrashModal');
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                @this.willMount();
            });

            myModalEl.addEventListener('hide.bs.modal', function (event) {
                @this.whileMount = true;
                @this.email = null;
            });
            
            window.addEventListener('close-urimodal', event => {
                /* var myModal = new bootstrap.Modal(document.getElementById('uriTrashModal'));
                myModal.hide(); */
                location.reload();
            }); 
        </script>
    @endpush
</div>