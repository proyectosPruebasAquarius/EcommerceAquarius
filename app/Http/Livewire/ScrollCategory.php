<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Categoria;

class ScrollCategory extends Component
{

    public $categorias = [];

    public function redirectNewRender($nombre, $categoria)
    {
        session(['newSubCat' => $nombre]);
        return redirect()->to('/productos/'.$categoria);
    }

    public function render()
    {
        $this->categorias = Categoria::all();
        return view('livewire.scroll-category');
    }
}
