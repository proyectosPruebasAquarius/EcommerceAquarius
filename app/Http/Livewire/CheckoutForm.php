<?php

namespace App\Http\Livewire;

use App\Direccion;
use App\Facturacion;
use App\MetodoPago;
use App\Departamento;
use App\Municipio;
use Livewire\Component;

class CheckoutForm extends Component
{
    public $direcciones = array();
    public $facturaciones = array();
    public $metodos_pagos = array();
    public $departamentos = array();
    public $departamento;
    public $municipios = array();
    protected $listeners = ['refreshList' => '$refresh'];

    public function updatedDepartamento()
    {
        $this->municipios = Municipio::where('id_departamento', $this->departamento)->get(['id', 'nombre', 'id_departamento']);
    }
    
    public function render()
    {

        $this->direcciones = Direccion::where('direcciones.id_user', auth()->user()->id)
        ->join('municipios', 'direcciones.id_municipio', '=', 'municipios.id')
        ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')
        ->join('users', 'direcciones.id_user', '=', 'users.id')
        ->select('departamentos.nombre as departamento', 'municipios.nombre as municipio', 'users.name as user', 'direcciones.first_name', 'direcciones.last_name', 
        'direcciones.email', 'direcciones.telefono', 'direcciones.direccion', 'direcciones.id', 'direcciones.facturacion', 'direcciones.referencia', 'direcciones.referencia_facturacion', 'departamentos.id as id_departamento', 'municipios.id as id_municipio')
        ->get();
    
        $this->facturaciones = Facturacion::where('direcciones_facturaciones.id_user', auth()->user()->id)->join('municipios', 'direcciones_facturaciones.id_municipio', '=', 'municipios.id')
        ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')->select('departamentos.nombre as departamento', 'municipios.nombre as municipio', 'direcciones_facturaciones.direccion',
        'direcciones_facturaciones.referencia', 'direcciones_facturaciones.id', 'departamentos.id as id_departamento', 'municipios.id as id_municipio')->get();
    
        $this->metodos_pagos = MetodoPago::get();
        
        $this->departamentos = Departamento::get(['id', 'nombre']);

        return view('livewire.checkout-form');
    }
}
