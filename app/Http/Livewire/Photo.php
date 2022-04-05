<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Photo extends Component
{
    public $productos;
    public $img;
    public $photo = 0;

    protected $listeners = ['changeValue'];

    public function changeValue($photo)
    {
        
        $this->photo = $photo;

    }

    public function render()
    {
        return view('livewire.photo');
    }
}
