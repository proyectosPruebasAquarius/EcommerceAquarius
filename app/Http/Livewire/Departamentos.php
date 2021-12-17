<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Departamento;

class Departamentos extends Component
{
    public $departamentos = [];
    public $id_departamento;

    public function value($value) 
    {

        $this->id_departamento = $value;
        
    }

    public function render()
    {
        $this->departamentos = Departamento::get();

        return view('livewire.departamentos');
    }
}
