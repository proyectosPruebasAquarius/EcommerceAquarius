<div>
    <div class="shopping-cart section">
        <div class="container">
            <div class="row">                
                    <div class="button">
                        <a href="{{ route('productos') }}" class="btn btn-alt float-md-start mb-1">Seguir Comprando</a>
                    </div>                
                <div class="col-12 col-md-8">
                    <div class="cart-list-head">

                        <div class="cart-list-title d-none d-md-block">
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-12">
                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <p>Producto</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>Cantidad</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>Precio</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>Total</p>
                                </div>
                                {{--<div class="col-lg-2 col-md-2 col-12">
                                    <p>Discount</p>
                                </div>--}}
                                <div class="col-lg-1 col-md-2 col-12">
                                    <p>Remover</p>
                                </div>
                            </div>
                        </div>
        
                        @forelse ($carritoItems as $c)
                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-md-1 col-12">
                                    <a href="{{ route('detalle', Crypt::encrypt($c['attributes']['id_producto'])) }}"><img src="{{ $c['attributes']['image'] }}" alt="Product Image"></a>
                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <h5 class="product-name"><a href="{{ route('detalle', Crypt::encrypt($c['attributes']['id_producto'])) }}">
                                        {{ $c['name'] }}</a></h5>
                                    {{--<p class="product-des">
                                        <span><em>Type:</em> Mirrorless</span>
                                        <span><em>Color:</em> Black</span>
                                    </p>--}}
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <div class="count-input">
                                        {{--<select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>--}}
                                        <livewire:update-qty :item="$c" :key="$c['id']"/>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>${{ number_format($c['price'], 2, '.', '') }}</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>${{ number_format($c['price']*$c['quantity'], 2, '.', '') }}</p>
                                </div>
                                {{--<div class="col-lg-2 col-md-2 col-12">
                                    <p>$29.00</p>
                                </div>--}}
                                <div class="col-lg-1 col-md-2 col-12">
                                    <a class="remove-item" href="javascript:void(0)" wire:click.prevent="removeCart('{{$c['id']}}')"><i class="fal fa-trash-alt"></i>{{-- <i class="lni lni-close"></i> --}}</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="row align-items-center text-center">
                            <span>{{ __('Carrito vacio') }}</span> <a href="{{ route('productos') }}">Ir a productos</a>
                        </div>
                        @endforelse               
                        
        
                    </div>
                    {{-- offset-4 offset-md-0 --}}
                    {{-- offset-1 offset-md-0 --}}
                    <div class="button">
                        <a wire:click="clearCart" class="btn btn-alt float-md-start mt-1"><i class="fal fa-trash-alt"></i> Vaciar Carrito</a>
                        {{-- <a href="{{ route('productos') }}" class="btn btn-alt float-md-end mt-1">Seguir Comprando</a> --}}
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="total-amount sticky-top">
                        <div class="right">
                            <ul>
                                <li>Total:<span>${{ number_format(Cart::getTotal(), 2, '.', '') }}</span></li>
                                <hr class="bg-gray-500 border-2 border-top border-gray-500">
                                {{--  <li>Shipping<span>Free</span></li>
                                <li>You Save<span>$29.00</span></li>
                                <li class="last">You Pay<span>$2531.00</span></li> --}}
                            </ul>
                            <div class="button">
                                
                                    @if(!\Cart::isEmpty())
                                        <a href="{{ route('checkout') }}" class="btn">{{ __('Finalizar Compra') }}</a>
                                    @endif
                                
                                {{-- <a href="{{ route('productos') }}" class="btn btn-alt">Seguir Comprando</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.onscroll = () => {
            if (window.pageYOffset > document.querySelector('.total-amount').offsetTop) {
                document.querySelector('.total-amount').classList.add('pt-2');
            } else {
                document.querySelector('.total-amount').classList.remove('pt-2');
            }
        }
    </script>
@endpush