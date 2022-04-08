<div>
    <a href="javascript:void(0)" class="main-btn">
        {{-- <i class="lni lni-cart"></i> --}}
        <i class="far fa-shopping-cart"></i>
        <span class="total-items">{{ Cart::getTotalQuantity()}}</span>
    </a>
    
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ Cart::getTotalQuantity()}} Productos</span>
            @if(count($cartItems) > 0)
                <a href="{{ url('/carrito') }}">Ver Carrito</a>
            @endif        
        </div>
        <ul class="shopping-list">
            @forelse ($cartItems as $item)
                <li>
                    <button class="remove" title="Remove this item" wire:click.prevent="removeCart('{{$item['id']}}')"><i class="lni lni-close"></i></button>
                    <div class="cart-img-head">
                        <a class="cart-img" href="{{ route('detalle', Crypt::encrypt($item['attributes']['id_producto'])) }}"><img src="{{ $item['attributes']['image'] }}" alt="#"></a>
                    </div>
                    <div class="content">
                        <h4><a href="{{ route('detalle', Crypt::encrypt($item['attributes']['id_producto'])) }}">
                            {{ $item['name'] }}</a></h4>
                        <p class="quantity">{{ $item['quantity'] }}x - <span class="amount">${{ number_format($item['price'], 2, '.', '') }}</span></p>
                    </div>
                </li>
            @empty
               <p class="text-center">{{ __('Carrito Vacio') }} </p>
            @endforelse               
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">${{ number_format(Cart::getTotal(), 2, '.', '') }}</span>
            </div>
            
                @if(!\Cart::isEmpty())
                <div class="button">
                    <a href="{{ route('checkout') }}" class="btn animate">Finalizar Compra</a>
                </div>
                @endif            
            
        </div>
    </div>
</div>
