<?php

namespace App\Http\Livewire;

use App\Facturacion;
use App\Direccion;
use App\Departamento;
use App\Municipio;
use Livewire\Component;

class ModalDirecciones extends Component
{

    public $title;
    public $telefono;
    public $direccion;
    public $referencia;
    public $id_user;
    public $id_municipio;
    public $departamentos = [];
    public $id_direccion;
    public $municipios = [];

    protected $listeners = ['newValues' => 'assignValues', 'resetDirModal' => 'resetState'];

    protected $rules = [

        'direccion' => 'required|min:6|max:500',

        'referencia' => 'nullable|min:6|max:200',

        'telefono' => 'required|min:8|max:12',

        'id_user' => 'required',
        
        'id_municipio' => 'required',

        'id_direccion' => 'required',
    ];

    protected $messages = [

        'id_municipio.required' => 'El campo municipio es obligatorio.',

        'id_direccion.required' => 'El campo departamento es obligatorio.',

        /* 'email.email' => 'The Email Address format is not valid.', */

    ];

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);

    }

    public function updatedIdDireccion()
    {

        $this->municipios = Municipio::where('id_departamento', $this->id_direccion)->get(['id', 'nombre', 'id_departamento']);

    }

    /* public function updatedIdMunicipio()
    {

        \Debugbar::info($this->id_municipio);

    } */

    public function createNewData()
    {
        /* \Debugbar::info($this->validate()); */
        $validatedData = $this->validate();

        /* \Debugbar::info($validatedData); */

        if ($this->title === 'Agregar Dirección de Facturacion') {
            Facturacion::create($validatedData);
        } else {
            Direccion::create($validatedData);
        }
        
        $this->emit('refreshList');
    }

    public function assignValues($e)
    {
        if ($e == 'facturacion') {
            $this->title = 'Agregar Dirección de Facturacion';
            $this->telefono = 'letmepass';           
        } else {
            $this->title = 'Agregar Dirección de envío';
        }

        $this->departamentos = Departamento::get(['id', 'nombre']);
        $this->id_user = auth()->user()->id;
    }

    public function resetState()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->reset(['direccion', 'referencia', 'id_municipio', 'id_direccion', 'telefono']);
    }

    public function render()
    {
        return view('livewire.modal-direcciones');
    }
}
