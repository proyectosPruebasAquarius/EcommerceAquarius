<div>
    <div class="checkout-sidebar-price-table mt-30">
        <h5 class="title">Compra Total:</h5>
        <div class="sub-total-price">
            @forelse ($contentCart as $content)
            <div class="total-price">
                <p class="value">Producto:</p>
                <p class="price">{{ $content['name'] }} x {{ $content['quantity'] }}</p>
            </div>
            @empty
                {{ __('Ocurrio un error inesperado') }}
            @endforelse
            
            {{-- <div class="total-price shipping">
                <p class="value">Subotal Price:</p>
                <p class="price">$10.50</p>
            </div>
            <div class="total-price discount">
                <p class="value">Subotal Price:</p>
                <p class="price">$10.00</p>
            </div> --}}
        </div>
        <div class="total-payable">
            <div class="payable-price">
                <p class="value">Precio Subotal:</p>
                <p class="price">${{ Cart::getTotal() }}</p>
            </div>
        </div>
        {{-- <div class="price-table-btn button">
            <a href="javascript:void(0)" class="btn btn-alt">Finalizar Compra</a>
        </div> --}}
    </div>
</div>
