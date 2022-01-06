<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UpdateQty extends Component
{
    use LivewireAlert;
    public $cartItems = [];
    public $quantity = 1;
    public $maxQuantity = 1000;

    protected $listeners = ['realod' => '$refresh', 'updateQty' => 'updateCart'];

    public function mount($item)
    {
        /* \Debugbar::info('$qty'); */
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];

        $this->maxQuantity = \DB::table('inventarios')->where('id', $item['id'])->value('stock');
    }

    public function updateCart($qty, $id)
    {
        
        /* $this->quantity = $qty; */
        if ($this->corroborate($id, $qty)) {
            if ($id == $this->cartItems['id']) {
                $this->cartItems['quantity'] = $qty;
            }
            \Cart::update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => (int)$qty
                ]
            ]);
    
            $this->emit('cartRefresh');

            /* return redirect(request()->header('Referer')); */
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
