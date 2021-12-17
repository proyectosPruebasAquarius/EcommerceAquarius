<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $contentCart = []; 

    public function render()
    {
        $this->contentCart = \Cart::getContent()->toArray();

        return view('livewire.checkout');
    }
}
