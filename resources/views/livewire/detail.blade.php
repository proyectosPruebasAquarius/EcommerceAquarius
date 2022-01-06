<div>
    <div class="top-area border-0">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="product-images">
                    <main id="gallery">
                        <div class="main-img">
                            {{-- <img src="{{ json_decode($productos->imagen)[0] }}" id="current" alt="Product Image"> --}}
                            @livewire('photo', ['productos' => json_decode($productos->imagen)])
                        </div>
                        <div class="images">
                            {{-- <img src="assets/images/product-details/01.jpg" class="img" alt="#">
                            <img src="assets/images/product-details/02.jpg" class="img" alt="#">
                            <img src="assets/images/product-details/03.jpg" class="img" alt="#">
                            <img src="assets/images/product-details/04.jpg" class="img" alt="#">
                            <img src="assets/images/product-details/05.jpg" class="img" alt="#"> --}}
                            @forelse (json_decode($productos->imagen) as $k => $image)
                            <img src="{{ $image }}" class="img" alt="Product Image" wire:click="$emit('changeValue', {{ $k }})">
                            @empty

                            @endforelse
                        </div>
                    </main>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="product-info">
                    @if(strtolower($productos->tipo_oferta) == 'descuento' && $productos->state == 1 || strtolower($productos->tipo_oferta) == 'descuentos' && $productos->state == 1)
                    <h2 class="title">{{ $productos->producto }} <span class="badge bg-danger"><i class="lni lni-tag"></i> {{ $productos->oferta }}%</span></h2>
                    @else
                    <h2 class="title">{{ $productos->producto }}</h2>
                    @endif
                    <p class="category"><i class="lni lni-tag"></i> {{ $productos->categoria }}:<span>{{ $productos->sub_categoria }}</span></p>
                    <h3 class="price">
                        @if(strtolower($productos->tipo_oferta) == 'descuento' && $productos->state == 1 || strtolower($productos->tipo_oferta) == 'descuentos' && $productos->state == 1)
                        ${{ number_format($productos->precio_venta * (('100' - number_format($productos->oferta)) / '100'), 2, '.', '') }}
                        @else
                        ${{ $productos->precio_venta }}
                        @endif
                        @if(strtolower($productos->tipo_oferta) == 'descuento' && $productos->state == 1 || strtolower($productos->tipo_oferta) == 'descuentos' && $productos->state == 1)
                            <span>${{ $productos->precio_venta }}</span>
                        @endif
                    </h3>
                    {{-- <p class="info-text">
                        {{ $productos->descripcion }}
                    </p> --}}
                    <div class="row">
                        {{-- <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group color-option">
                                <label class="title-label" for="size">Choose color</label>
                                <div class="single-checkbox checkbox-style-1">
                                    <input type="checkbox" id="checkbox-1" checked>
                                    <label for="checkbox-1"><span></span></label>
                                </div>
                                <div class="single-checkbox checkbox-style-2">
                                    <input type="checkbox" id="checkbox-2">
                                    <label for="checkbox-2"><span></span></label>
                                </div>
                                <div class="single-checkbox checkbox-style-3">
                                    <input type="checkbox" id="checkbox-3">
                                    <label for="checkbox-3"><span></span></label>
                                </div>
                                <div class="single-checkbox checkbox-style-4">
                                    <input type="checkbox" id="checkbox-4">
                                    <label for="checkbox-4"><span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group">
                                <label for="color">Battery capacity</label>
                                <select class="form-control" id="color">
                                    <option>5100 mAh</option>
                                    <option>6200 mAh</option>
                                    <option>8000 mAh</option>
                                </select>
                            </div>
                        </div> --}}

                        {{-- input cantidad --}}
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="form-group quantity">
                                @php
                                    if (!\Cart::isEmpty()) {
                                        $localCartU = \Cart::get($productos->id);
                                        if ($localCartU) {
                                            $localCart = \Cart::get($productos->id)->toArray();
                                        }
                                    }
                                @endphp
                                <label for="color">Cantidad:</label>
                                @if ($productos->stock > 0)
                                    @if (isset($localCart))
                                        @if($localCart['quantity'] < $productos->stock)
                                            {{-- <input class="form-control" type="number" min="1" max="{{ $productos->stock }}" name="quantity" id="quantity" value="1" wire:model.debounce.500ms="qty"> --}}
                                            <div class="qtyI text-center">
                                                <span class="minus bg-dark">-</span>
                                                <input type="number" class="count w-50" min="1" max="{{ $productos->stock }}" name="quantity" id="quantity" value="1">
                                                <span class="plus bg-dark">+</span>
                                            </div>
                                        @endif
                                    @else
                                    {{-- <input class="form-control" type="number" min="1" max="{{ $productos->stock }}" name="quantity" id="quantity" value="1" wire:model.debounce.500ms="qty"> --}}
                                    <div class="qtyI text-center">
                                                <span class="minus bg-dark">-</span>
                                                <input type="number" class="count w-50" min="1" max="{{ $productos->stock }}" name="quantity" id="quantity" value="1">
                                                <span class="plus bg-dark">+</span>
                                            </div>
                                    @endif
                                   
                                @endif
                            </div>
                        </div>
                        {{-- input cantidad end --}}

                        {{-- En Stock box --}}
                        @if ($productos->stock <= 10)
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label>En Stock:</label>
                                    <p class="text-center text-danger form-control">{{ $productos->stock }}</p>
                                </div>
                            </div>
                        @endif
                        {{-- En Stock box end --}}
                    </div>
                    <div class="bottom-content">
                        <div class="row align-items-end">
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="button cart-button">
                                    @if ($productos->stock > 0)
                                        @if (isset($localCart))
                                            @if($localCart['quantity'] < $productos->stock)
                                                <button class="btn bg-white text-dark border" style="width: 100%;" wire:click="addToCart({{ $productos }}, document.querySelector('.count').value)">Agregar al Carrito</button>
                                            @else
                                                <button class="btn bg-white text-dark border" style="width: 100%;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                            @endif
                                        @else
                                            <button class="btn bg-white text-dark border" style="width: 100%;" wire:click="addToCart({{ $productos }}, document.querySelector('.count').value)">Agregar al Carrito</button>
                                        @endif
                                    @else
                                    <button class="btn bg-white text-dark border" style="width: 100%;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12 d-none d-md-block">
                                <div class="button cart-button">
                                    @if ($productos->stock > 0)
                                        @if (isset($localCart))
                                            @if($localCart['quantity'] < $productos->stock)
                                                <button class="btn" style="width: 100%" wire:click="addAndRedirect({{ $productos }}, document.querySelector('.count').value)">Comprar -></button>
                                            @endif
                                        @else
                                            <button class="btn" style="width: 100%" wire:click="addAndRedirect({{ $productos }}, document.querySelector('.count').value)">Comprar -></button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-4 col-12">
                                <div class="wish-button">
                                    <button class="btn"><i class="lni lni-reload"></i> Compare</button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="wish-button">
                                    <button class="btn"><i class="lni lni-heart"></i> To Wishlist</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function(){
		    $('.count').prop('disabled', true);
   			$(document).on('click','.plus',function(){
				if (parseInt(document.querySelector('.count').value) < parseInt(document.querySelector('.count').max)) {
                    $('.count').val(parseInt($('.count').val()) + 1 );
                }
    		});
        	$(document).on('click','.minus',function(){
    			$('.count').val(parseInt($('.count').val()) - 1 );
    				if ($('.count').val() == 0) {
						$('.count').val(1);
					}
    	    	});
 		});
    </script>
    @endpush
</div>
