<div>
    <div class="row mt-5">
        <div class="col-12 col-md-6">
            <button class="btn btn-danger" wire:click="trashAll()" >Eliminar toda la lista <i class="fas fa-trash-alt"></i></button>
            <button class="btn btn-success mt-2 mt-md-2 mt-lg-0" wire:click="addToCartAll()" >Agregar toda la lista al carrito <i class="fas fa-cart-plus"></i></button>
        </div>
        {{-- <div class="col-12 col-md-6">
            <button class="btn btn-success text-end" wire:click="addToCartAll()" >Agregar toda la lista al carrito</button>
        </div> --}}
    </div>
    <div class="row mt-3">
        @forelse ($whishlist as $wl)
            <div class="col-12 col-md-4 col-lg-3 mt-2">
                <div class="card text-center">
                <img class="card-img-top" src="{{ asset(json_decode($wl->imagen)[0]) }}" alt="Product Image">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="card-title"><a href="{{ route('detalle', Crypt::encrypt($wl->id_producto)) }}">{{ $wl->nombre }}</a></h6>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-sm rounded-pill btn-danger" wire:click="trash(@js($wl->id))" style="font-size: 12px">
                                Remover de lista
                            </button>
                        </div>
                    </div>
                    {{-- <p class="card-text">Body</p> --}}
                </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No se encontraron productos en la lista</p>
            </div>
        @endforelse
    </div>
</div>
