<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConditionsModal extends Component
{
    public $condition;
    protected $listeners = ['conditionChanger' =>  'changeValueCondition'];

    public function changeValueCondition($param)
    {
        $this->condition = $param;
    }

    public function render()
    {
        return view('livewire.conditions-modal');
    }
}
