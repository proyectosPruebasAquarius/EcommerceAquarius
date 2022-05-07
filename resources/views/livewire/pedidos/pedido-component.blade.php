<div>
    <div class="modal fade" id="pedidoModal" tabindex="-1" aria-labelledby="pedidoModalLabel" aria-hidden="true" wire:ignore.self> 
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title col-11 text-center" id="pedidoModalLabel">Estado del pedido</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-sm-6">
                      <div class="card" >
                        <div class="card-body">
                          <h5 class="card-title">En preparación</h5>
                          <p class="card-text"><i class="bi bi-box-seam fs-1"></i></p>
                            <button class="btn  @if ($preparacion == 1) btn-success @else  btn-primary  @endif     @if ($preparacion == 1) disabled @else    @endif">
                                <i class="bi bi-check2-all fs-4 @if ($preparacion == 1) text-light @else    @endif"  wire:click="preparacionQuestion"  ></i>
                            </button>                          
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">En revisión</h5>
                          <p class="card-text">
                              <i class="bi bi-eye fs-1"></i>
                             
                            </p>
                            <button class="btn @if ($revision == 1) btn-success @else  btn-primary  @endif     @if ($revision == 1) disabled @else    @endif    @if ($preparacion == 0) disabled @else    @endif">
                                <i class="bi bi-check2-all fs-4  @if ($revision == 1) text-light @else    @endif" wire:click="revisionQuestion" ></i>
                            </button>                       
                        </div>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">En envio</h5>
                          <p class="card-text"><i class="bi bi-truck fs-1"></i></p>
                          <button class="btn @if ($envio == 1) btn-success @else  btn-primary  @endif     @if ($envio == 1) disabled @else    @endif   @if ($revision == 0) disabled @else    @endif">
                            <i class="bi bi-check2-all fs-4 @if ($envio == 1) text-light @else    @endif" wire:click="envioQuestion"></i>
                        </button>                       
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Entregado</h5>
                          <p class="card-text"><i class="bi bi-house-door fs-1"></i></p>
                          <button class="btn @if ($entrega == 1) btn-success @else  btn-primary  @endif     @if ($entrega == 1) disabled @else    @endif  @if ($envio == 0) disabled @else    @endif">
                            <i class="bi bi-check2-all fs-4 @if ($entrega == 1) text-light @else    @endif" wire:click="entregaQuestion"></i>
                        </button>                       
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              
            </div>
          </div>
        </div>
      </div>
</div>
