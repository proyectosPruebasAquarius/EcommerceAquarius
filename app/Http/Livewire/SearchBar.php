<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public $fill =  '';

    public function render()
    {
        return view('livewire.search-bar');
    }
}
