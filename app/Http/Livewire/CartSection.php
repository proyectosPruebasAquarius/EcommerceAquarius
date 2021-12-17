<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartSection extends Component
{
    protected $listeners = ['cartRefresh' => '$refresh'];
    public $carritoItems = [];            

    /* public function updateCart($id, $qty)
    {
        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);
        \Debugbar::info($qty);
        $this->emit('cartRefresh');
    } */

    public function removeCart($id)
    {
        
          \Cart::remove($id);
  
          session()->flash('success', 'Item has removed !');
          $this->emit('cartUpdated');
    }

    public function clearCart()
    {
        \Cart::clear();

        return redirect()->to('/');
    }

    public function render()
    {
        $test = \Cart::getContent()->toArray();
        array_multisort(array_map(function($element) {
            return $element['attributes']['unid'];
        }, $test), SORT_DESC, $test);
        
        $this->carritoItems = $test /* \Cart::getContent()->toArray() */;
        
        return view('livewire.cart-section');
    }
}
