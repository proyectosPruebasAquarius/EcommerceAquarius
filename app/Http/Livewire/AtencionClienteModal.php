<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AtencionClienteModal extends Component
{
    public $type;

    protected $listeners = ['changeModalType' => 'fillValue', 'cleanModalType' => 'clearValue'];

    public function fillValue($value) 
    {
        $this->type = $value;
    }

    public function clearValue() 
    {
        $this->reset('type');
    }

    public function render()
    {
        return view('livewire.atencion-cliente-modal');
    }
}
