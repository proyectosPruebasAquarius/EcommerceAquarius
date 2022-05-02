<?php

namespace App\Http\Controllers;

use App\CuentaEliminada;
use Illuminate\Http\Request;

class CuentaEliminadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CuentaEliminada::join('users', 'users.id', '=', 'cuentas_eliminadas.id_user')->select('cuentas_eliminadas.*', 'users.email')->get();

        return view('backend.peticiones-account.peticiones-index')->with('peticiones', $data);
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
     * @param  \App\CuentaEliminada  $cuentaEliminada
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaEliminada $cuentaEliminada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentaEliminada  $cuentaEliminada
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaEliminada $cuentaEliminada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentaEliminada  $cuentaEliminada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaEliminada $cuentaEliminada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaEliminada  $cuentaEliminada
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaEliminada $cuentaEliminada)
    {
        //
    }
}
