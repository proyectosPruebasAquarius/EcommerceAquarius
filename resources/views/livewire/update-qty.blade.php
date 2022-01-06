<div>
    <div class="qtyI ">
        <span class="minus bg-dark" id="minus{{ $cartItems['id'] }}" onclick="decrementButton(@js($cartItems['id']))">-</span>
        {{-- <input class="form-control border-0 mx-auto" type="number" min="1" max="{{ $maxQuantity }}" name="" id="" wire:model.debounce.900ms="quantity" wire:change="updateCart" style="width: 100px" > --}}
        <input type="number" class="count" name="qty" min="1" max="{{ $maxQuantity }}" value="{{ $cartItems['quantity'] }}" wire:change="updateCart" id="count{{ $cartItems['id'] }}">
        <span class="plus bg-dark" id="plus{{ $cartItems['id'] }}" onclick="incrementButton(@js($cartItems['id']))">+</span>
    </div>
@push('scripts')
    <script>        
        $(document).ready(function(){
		    $('.count').prop('disabled', true);
   			/* $(document).on('click','.plus',function(){
				if (parseInt(document.querySelector('.count').value) < parseInt(document.querySelector('.count').max)) {
                    $('.count').val(parseInt($('.count').val()) + 1 );
                    Livewire.emit('updateQty', parseInt(document.querySelector('.count').value))
                }
    		});
        	$(document).on('click','.minus',function(){
    			$('.count').val(parseInt($('.count').val()) - 1 );
                Livewire.emit('updateQty', parseInt(document.querySelector('.count').value))
    				if ($('.count').val() == 0) {
                        Livewire.emit('updateQty', 1)
						$('.count').val(1);
					}
    	    	}); */
 		});
         
         function decrementButton (btn) {
            document.getElementById('count'+btn).value = parseInt(document.getElementById('count'+btn).value) - 1; 
            Livewire.emit('updateQty', parseInt(document.getElementById('count'+btn).value), btn)
            if (document.getElementById('count'+btn).value <= 0) {
                Livewire.emit('updateQty', 1, btn)
                document.getElementById('count'+btn).value = 1
            }
         };

         function incrementButton (btn) {
            if (parseInt(document.getElementById('count'+btn).value) < parseInt(document.getElementById('count'+btn).max)) {
                document.getElementById('count'+btn).value = parseInt(document.getElementById('count'+btn).value) + 1; 
                Livewire.emit('updateQty', parseInt(document.getElementById('count'+btn).value), btn)
            }
         };

         /* Livewire.on('updateQty', () => {
            console.log(@js($cartItems['quantity']));
        }) */
    </script>
@endpush
</div>
