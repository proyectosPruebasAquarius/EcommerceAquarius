<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SortBy extends Component
{

    public $order;

    public function updatedOrder()
    {
        $this->emit('sort', $this->order);
    }
    
    public function render()
    {
        return view('livewire.sort-by');
    }
}
