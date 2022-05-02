<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\CuentaEliminada;

class EliminarForm extends Component
{
    public $motivo;
    public $descripcion;
    public $sugerencia;
    public $hideAndShow = false;

    protected $rules = [
        'motivo' => 'required|min:6|max:100',
        'descripcion' => 'required|min:6|max:100',
        'sugerencia' => 'nullable|min:6|max:250',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeForm()
    {
        $validatedData = $this->validate();

        try {
            //code...
            $validatedData['id_user'] = auth()->user()->id;
            CuentaEliminada::create($validatedData);
            $this->hideAndShow = true;
        } catch (\Exception $e) {
            //throw $th;
            if ($this->hideAndShow)
            $this->reset('hideAndShow');
        }
    }

    public function render()
    {
        return view('livewire.eliminar-form');
    }
}
