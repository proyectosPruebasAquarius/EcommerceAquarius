<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toast extends Component
{

    public $message;
    public $toggle = 'd-none';
    protected $listeners = [
        'show' => 'show',
        'hide' => 'hide',        
    ];

    public function show()
    {
        $this->toggle = '';

        $this->emit('show');
      
        /* $this->emit('hide'); */
    }

    public function hide()
    {
        sleep(1);
        $this->toggle = 'd-none';
    }

    public function mount()
    {
        $this->message = 'Producto Agregado al Carrito';
    }

    public function render()
    {
        return view('livewire.toast');
    }
}
