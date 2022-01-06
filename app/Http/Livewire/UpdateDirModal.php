<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Departamento;
use App\Municipio;
use App\Direccion;
use App\Facturacion;

class UpdateDirModal extends Component
{

    public $direccion;
    public $facturacion;
    public $telefono;
    public $referencia;
    public $referencia_facturacion;
    public $departamentos = array();
    public $departamento;
    public $municipios = array();
    public $id_municipio;
    public $idDir;
    public $hola = 'hola';

    protected $listeners = ['resetV' => 'resetState', 'updateModalDir' => 'mountValues'];

    protected $rules = [

        'direccion' => 'required|min:6',

        /* 'facturacion' => 'required|min:6', */

        'telefono' => 'required|min:8|max:12',

        'id_municipio' => 'required',

        'referencia' => 'nullable|min:6|max:200',

        /* 'referencia_facturacion' => 'nullable|min:6|max:200', */
        

    ];

    public function updated($propertyName)
    {
        /* \Debugbar::info('cambie'); */
        $this->validateOnly($propertyName);

    }

    public function updatedDepartamento()
    {
        /* \Debugbar::info($this->departamento); */        
        $this->municipios = Municipio::where('id_departamento', $this->departamento)->get();
        /* \Debugbar::info($this->municipios[0]['id']); */
        $this->id_municipio = $this->municipios[0]['id'];
    }

    public function mountValues($e)
    {
         /* \Debugbar::info($e); */
        $this->direccion = $e['direccion'];
        /* $this->facturacion = $e['facturacion']; */
        if (array_key_exists('telefono', $e)) {
            $this->telefono = $e['telefono'];
        } else {
            $this->telefono = 'letmepass';
        }
        
        $this->referencia = $e['referencia'];
        /* $this->referencia_facturacion = $e['referencia_facturacion']; */
        $this->departamentos = Departamento::get();
        $this->departamento = $e['id_departamento'];
        $this->municipios = Municipio::where('id_departamento', $e['id_departamento'])->get();
        $this->id_municipio = $e['id_municipio'];
        $this->idDir = $e['id'];
    }

    public function validateForm()
    {
        $validatedData = $this->validate();

        if ($this->telefono === "letmepass") {
            $facturacion = Facturacion::findOrFail($this->idDir);
            $facturacion->update($validatedData);
        } else {
            $direccion = Direccion::findOrFail($this->idDir);
            $direccion->update($validatedData);
        }
        
        /* return redirect(request()->header('Referer')); */
        $this->emit('refreshList');
    }

    public function resetState()
    {
        $this->resetErrorBag();

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.update-dir-modal');
    }
}
