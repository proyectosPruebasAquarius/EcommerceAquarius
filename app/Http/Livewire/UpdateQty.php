<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UpdateQty extends Component
{
    public $cartItems = [];
    public $quantity = 1;
    public $maxQuantity = 1000;

    public function mount($item)
    {
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];

        $this->maxQuantity = \DB::table('inventarios')->where('id', $item['id'])->value('stock');
    }

    public function updateCart()
    {
        if ($this->corroborate($this->cartItems['id'], $this->quantity)) {
            \Cart::update($this->cartItems['id'], [
                'quantity' => [
                    'relative' => false,
                    'value' => (int)$this->quantity
                ]
            ]);
    
            $this->emit('cartRefresh');
        } else {
            $this->alert('warning', 'Ocurrió un Error.', [
                'position' => 'bottom'
            ]);
        }
        
        
    }

    public function corroborate($id, $qty) 
    {
        $stock = \DB::table('inventarios')->where('id', $id)->value('stock');

        if ($qty <= $stock) {
            return true;
        } else {
            return false;
        }
    }

    public function render()
    {
        return view('livewire.update-qty');
    }
}
