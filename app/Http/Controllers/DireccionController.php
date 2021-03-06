<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Facturacion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show(Direccion $direccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Direccion $direccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $direccion = Direccion::findOrFail($id);
        $direccion->direccion = $request->direccion;
        $direccion->facturacion = $request->facturacion;
        $direccion->referencia = $request->referencia;
        $direccion->referencia_facturacion = $request->referencia_facturacion;
        $direccion->telefono = $request->telefono;
        $direccion->id_municipio = $request->id_municipio;
        $direccion->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Direccion::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function destroyFacturacion($id)
    {
        Facturacion::findOrFail($id)->delete();
        return redirect()->back();
    }
}
