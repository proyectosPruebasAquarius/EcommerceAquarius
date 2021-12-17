<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Municipio;

class Municipios extends Component
{
    public $municipios = [];
    //public $id_departamento; 

    public function mount($id_departamento)
    {
        $this->municipios = Municipio::where('id_departamento', $id_departamento)->get();
    }

    public function render()
    {
        return view('livewire.municipios');
    }
}
