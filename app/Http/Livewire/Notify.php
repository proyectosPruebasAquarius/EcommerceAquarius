<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notify extends Component
{
    public $notifications = array();

    public function render()
    {
        $this->notifications = auth()->user()->unreadNotifications;

        return view('livewire.notify');
    }
}
