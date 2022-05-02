<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use App\Venta;
use App\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $ventas = DetalleVenta::join('ventas', 'detalle_ventas.id_venta', 'ventas.id')->join('productos',  'detalle_ventas.id_producto', '=', 'productos.id')
        ->select('detalle_ventas.cantidad', 'detalle_ventas.created_at', 'ventas.total', 'ventas.num_transaccion', 'productos.nombre', 'productos.imagen')->where('ventas.id_usuario', auth()->user()->id)->get(); */

        $ventas = Venta::where('id_usuario', auth()->user()->id)->get();

        return view('frontend.profile')->with('ventas', $ventas);
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
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        
        if ($user) {
            
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->hasFile('image')) {

                if ($request->file('image')->isValid()) {
                    $request->validate([
                        'image' => 'mimes:jpeg,png,jpg,gif,svg|max:5048'
                    ]);

                    $imagen = $request->file('image')->store('public/frontend/client/'.auth()->user()->id);
                    $url = Storage::url($imagen);
                    $user->image = $url;
                }
            }

            $user->update();

            return back()->withMessage('Perfil actualizado con éxito');

        } else {
            return back()->withErrors(['message', 'Este perfil no puede ser actualizado.']);
        }
        
    }

    public function showInvoice($venta)
    {
        $ventaI = Venta::where('id', $venta)->select('created_at', 'total')->first();

        $detalles = DetalleVenta::join('ventas', 'detalle_ventas.id_venta', 'ventas.id')
                    ->join('productos', 'detalle_ventas.id_producto', '=', 'productos.id')
                    ->select('detalle_ventas.cantidad', 'detalle_ventas.created_at', 'ventas.total', 'ventas.num_transaccion', 'productos.nombre', 
                    'productos.imagen', 'detalle_ventas.id_producto as product')
                    ->where('detalle_ventas.id_venta', $venta)->get();
        $pdf = PDF::loadView('pdf.invoice', ['detalles' => $detalles, 'created_at' =>  $ventaI])->setPaper('a4', 'landscape');
        return $pdf->stream('Detalle de Venta-');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
