<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Categoria;

class FooterCategory extends Component
{
    public $categorys = array();    

    public function render()
    {        
        $this->categorys = Categoria::where('estado', 1)->select('id', 'nombre')->limit(5)->latest()->get();
        return view('livewire.footer-category');
    }
}
