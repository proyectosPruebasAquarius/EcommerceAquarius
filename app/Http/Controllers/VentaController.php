<?php

namespace App\Http\Controllers;

use App\DatoVenta;
use App\DetalleVenta;
use App\Direccion;
use App\Inventario;
use App\Producto;
use App\Mail\ContactUser;
use App\Notifications\EstadoVenta;
use App\Notifications\MinStock;
use App\User;
use App\Venta;
use App\PedidoProveedor;
use App\Facturacion;
use App\EncargadoRetiro;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Pedido;

class VentaController extends Controller
{
   


    public function printPDF(Request $request)
    {
        $rules = [
            'fecha' => 'required',

        ];

        $messages = [
            'fecha.required' => 'La fecha es Obligatoria.',
        ];
        $this->validate($request, $rules, $messages);
        $detail = Venta::join('detalle_ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->join('inventarios', 'inventarios.id_producto', '=', 'productos.id')->where('ventas.estado', '=', 1)->whereDate('ventas.created_at', $request->fecha)
            ->select('productos.nombre as producto','detalle_ventas.precio_venta', 'inventarios.codigo',
                DB::raw('SUM(detalle_ventas.cantidad) AS cantidadTotal'))->groupBy('productos.nombre')->orderBy('cantidadTotal', 'DESC')->get();
        $sumTotal = Venta::select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))
            ->whereDate('ventas.created_at', $request->fecha)->where('ventas.estado', '=', 1)->get();
        //return $detail;
        if ($sumTotal[0]->cuentaTotal == null) {
            return redirect()->back()->with('message', 'No hay Ventas registradas con la Fecha: ' . $request->fecha)->with('alert', 'warning');
        } else {
            $pdf = PDF::loadView('pdf.venta-detail', ['sumTotal' => $sumTotal, 'detail' => $detail, 'fecha' => $request->fecha]);
            return $pdf->stream('Detalle de Venta-'.$request->fecha.".pdf");
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::join('direcciones', 'direcciones.id', '=', 'ventas.id_direccion')->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')->join('users','users.id','=','ventas.id_usuario')
            ->select('direcciones.direccion', 'metodos_pagos.nombre as metodo_pago', 'ventas.estado as estado', 'ventas.id', 'ventas.total', 'ventas.created_at as fecha','users.name as cliente')
            ->orderBy('ventas.id', 'ASC')->get();
        
        return view('backend.ventas.index')->with('ventas', $ventas);
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

       /* $all = $request->all();

        return $all;*/


        $contentCart = \Cart::getContent();
        $totalCart = \Cart::getTotal();
        $id_direccion;

        try {
            \DB::beginTransaction();
            $id_direccion = null;
            $facturacion = null;
            if (empty($request->recoger_tienda)) {
                /* direccion de envio */
                if ($request->id_direccion == "on" || empty($request->id_direccion)) {
                    $direccion = new Direccion;
                    $direccion->direccion = $request->direccion;
                    $direccion->first_name = $request->first_name;
                    $direccion->last_name = $request->last_name;
                    $direccion->email = $request->email;
                    $direccion->telefono = $request->telefono;
                    $direccion->id_user =  auth()->user()->id;
                    $direccion->id_municipio = $request->id_municipio;
                    /* $direccion->facturacion = $request->facturacion; */
                    $direccion->referencia = $request->referencia;
                    /* $direccion->referencia_facturacion = $request->referencia_facturacion; */
                    $direccion->save();
                    $id_direccion = $direccion->id;
                } else {
                    $id_direccion = $request->id_direccion;
                }
                
                /* direccion facturacion */
                if ($request->id_facturacion) {
                    $facturacion = $request->id_facturacion;
                } else {
                    $fct = new Facturacion;
                    $fct->direccion = $request->facturacion;
                    $fct->id_municipio = $request->municipio_facturacion;
                    $fct->id_user = auth()->user()->id;
                    $fct->referencia = $request->referencia_facturacion;
                    $fct->save();
    
                    $facturacion = $fct->id;
                }
            } else {
                if ($request->typeOfRetiro === 'other') {
                    $encargado = new EncargadoRetiro;
                    $encargado->nombre = $request->nombre_encargado;
                    $encargado->dui = $request->dui_encargado;
                    $encargado->saveOrFail();
                }
            }

            /* venta */
            $venta = new Venta;
            $venta->id_usuario = auth()->user()->id;
            $venta->total = $totalCart;
            $venta->num_transaccion = sha1(time());
            $venta->id_direccion = $id_direccion;
            $venta->id_metodo_pago = $request->id_metodo_pago;
            $venta->estado = $request->nombre_metodo_pago == "Chivo Wallet" || $request->nombre_metodo_pago == "Banco Agricola" ? 0 : 1;
            $venta->id_facturacion = $facturacion;
            $venta->recoger_tienda = $request->recoger_tienda;
            $venta->save();

            foreach ($contentCart as $ct ) {
               $detail = new DetalleVenta;
               $detail->id_producto = $ct['attributes']['id_producto'];
               $detail->id_venta = $venta->id;
               $detail->cantidad = $ct->quantity;
               $detail->precio_venta = $ct->price;
               $oferta = null;
               $oferta = Inventario::join('ofertas','ofertas.id','=','inventarios.id_oferta')->select('ofertas.nombre as ofertas')->where('inventarios.id',$ct->id)->first();
              
               if ($oferta <> null) {
                  $detail->oferta = $oferta->ofertas;
               }else{
                   $detail->oferta = $oferta;
               }

               
              $detail->save();
             
            }
            if ($request->nombre_metodo_pago == "Chivo Wallet" || $request->nombre_metodo_pago == "Banco Agricola") {
                
                if ($request->hasfile('imagen')) {                    
                    $datoVenta = new DatoVenta;
                    $datoVenta->numero = $request->numero;
                    $imageExt = time().'.'.$request->imagen->extension();
                    $imageName = $request->imagen->move(public_path('storage/imagenes/datosCliente/'.auth()->user()->id), $imageExt);
                    //$url = \Storage::url($imageName);
                    
                    $datoVenta->imagen = $imageExt;
                    $datoVenta->id_venta = $venta->id;
                    $datoVenta->save();
                }

            }

            $admins = User::where('id_tipo_usuario', 1)->get();

            \Notification::send($admins, new EstadoVenta($venta));
            \Cart::clear();
            \DB::commit();
            return redirect('/profile')->with('correlative',$venta->num_transaccion);
        } catch (Throwable $e) {
            \DB::rollback();
            throw $e;
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $id_decrypt = Crypt::decrypt($id);
        $venta = Venta::join('detalle_ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->join('users', 'users.id', '=', 'ventas.id_usuario')->join('direcciones', 'direcciones.id', 'ventas.id_direccion')
        ->join('municipios','municipios.id','=','direcciones.id_municipio')->join('departamentos','departamentos.id','=','municipios.id_departamento')
            ->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')->join('datos_ventas', 'datos_ventas.id_venta', '=', 'ventas.id')->join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->select('direcciones.direccion', 'direcciones.telefono', 'direcciones.facturacion', 'direcciones.referencia', 'ventas.total as totalVenta', 'ventas.estado as estadoVenta', 'datos_ventas.numero as numeroTransaccion',
                'datos_ventas.imagen as imagenDatoVenta', 'ventas.id as id_venta', 'users.id as id_usuario','users.name as cliente','users.email as correo','municipios.nombre as municipio','departamentos.nombre as departamento',
                'direcciones.referencia_facturacion','metodos_pagos.nombre as metodo_pago','ventas.num_transaccion as numeroTransaccionVenta')->where('ventas.id', '=', $id_decrypt)->distinct()->first();
        $productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->select('productos.nombre','detalle_ventas.precio_venta','detalle_ventas.oferta','productos.imagen','detalle_ventas.cantidad')
        ->where('detalle_ventas.id_venta', '=', $id_decrypt)->get();
        //return $productosVenta;
       return view('backend.ventas.form2')->with('ventas', $venta)->with('productos', $productosVenta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notify($id, $notify)
    {
        $id_decrypt = Crypt::decrypt($id);

        if ($notify !== null) {
            DB::table('notifications')->where('id', '=', $notify)->update(['read_at' => now()]);

        }
        $venta = Venta::join('detalle_ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->join('users', 'users.id', '=', 'ventas.id_usuario')->join('direcciones', 'direcciones.id', 'ventas.id_direccion')
        ->join('municipios','municipios.id','=','direcciones.id_municipio')->join('departamentos','departamentos.id','=','municipios.id_departamento')
            ->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')->join('datos_ventas', 'datos_ventas.id_venta', '=', 'ventas.id')->join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->select('direcciones.direccion', 'direcciones.telefono', 'direcciones.facturacion', 'direcciones.referencia', 'ventas.total as totalVenta', 'ventas.estado as estadoVenta', 'datos_ventas.numero as numeroTransaccion',
                'datos_ventas.imagen as imagenDatoVenta', 'ventas.id as id_venta', 'users.id as id_usuario','users.name as cliente','users.email as correo','municipios.nombre as municipio','departamentos.nombre as departamento',
                'direcciones.referencia_facturacion','metodos_pagos.nombre as metodo_pago','ventas.num_transaccion as numeroTransaccionVenta')->where('ventas.id', '=', $id_decrypt)->distinct()->first();
                $productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->select('productos.nombre','detalle_ventas.precio_venta','detalle_ventas.oferta','productos.imagen','detalle_ventas.cantidad')
                ->where('detalle_ventas.id_venta', '=', $id_decrypt)->get();
        //return $venta;
        return view('backend.ventas.form2')->with('ventas', $venta)->with('productos', $productosVenta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id_decrypt = Crypt::decrypt($id);
        if ($request->aprobacion == 1) {
            $productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->select('detalle_ventas.id_producto', 'detalle_ventas.cantidad')->where('detalle_ventas.id_venta', '=', $id_decrypt)->get();
            \Config::set('firts', 0); //$firts = 0;
            foreach ($productosVenta as $key => $p) {

                $inventarioStock = Inventario::select('id as id_inventario', 'stock', 'min_stock','precio_compra')->where('id_producto', '=', $p->id_producto)->first();
               
              
                $id_notify = $inventarioStock->id_inventario;
                if ($inventarioStock->stock == $inventarioStock->min_stock || $inventarioStock->stock < $inventarioStock->min_stock) {
                    $admins = User::where('id_tipo_usuario', 1)->get();
                    // return $id_test;
                   

                    \Notification::send($admins, new MinStock($id_notify));
                    
                    $pedido_proveedor = new PedidoProveedor;
                    $pedido_proveedor->id_producto =  $p->id_producto;                    
                    $pedido_proveedor->precio = $inventarioStock->precio_compra;
                    $pedido_proveedor->created_at = date("Y-m-d");
                    $pedido_proveedor->save();
                }
                if ($p->cantidad > $inventarioStock->stock) {
                    \Config::set('firts', 1);

                }

                if ($key === array_key_last($productosVenta->toArray())) {
                    if (\Config::get('firts') > 0) {
                        \Config::set('firts', 0);
                        Venta::where('id', '=', $id_decrypt)->update(['estado' => 2]);
                        return redirect('/admin/ventas')->with('alert', 'warning')->with('message', 'El stock del producto es menos que la cantidad seleccionada del producto');
                    } else {
                        $newStock = $inventarioStock->stock - $p->cantidad;
                        Inventario::where('id', '=', $inventarioStock->id_inventario)->update(['stock' => $newStock]);
                        Venta::where('id', '=', $id_decrypt)->update(['estado' => 1]);

                        $pedido = new Pedido;
                        $pedido->id_venta = $id_decrypt;
                        $pedido->save();
                        return redirect('/admin/ventas')->with('message', 'La Venta fue Aprobada Correctamente')->with('alert', 'success');
                    }
                }
            }

        } else {
            Venta::where('id', '=', $id_decrypt)->update(['estado' => 3]);
            return redirect('/admin/ventas')->with('message', 'La Venta fue Rechazada Correctamente')->with('alert', 'success');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manualupd($id, Request $request)
    {
        $id_venta = Crypt::decrypt($id);

        $venta = Venta::where('id', '=', $id_venta)->get();
        $productos = $request->producto;
        $newTotal = $venta[0]->total - $request->descuento;
        if ($request->descuento > $venta[0]->total) {
            return redirect()->back()->with('message', 'El Descuento no puede ser mayor que el total de la Venta')->with('type', 'danger');
        } else {
            Venta::where('id', '=', $id_venta)->update(['total' => $newTotal, 'estado' => 4]);

            foreach ($productos as $key => $p) {
                DetalleVenta::where('id_venta', '=', $id_venta)->where('id_producto', '=', $p)->delete();
                if ($key === array_key_last($productos)) {
                    return redirect()->back()->with('message', 'Productos Eliminados de la Venta Correctamente')->with('type', 'success');

                }
            }
        }

    }

    public function manual($id)
    {
        $id_decrypt = Crypt::decrypt($id);
        $venta = Venta::join('detalle_ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->join('users', 'users.id', '=', 'ventas.id_usuario')->join('direcciones', 'direcciones.id', 'ventas.id_direccion')
            ->join('metodos_pagos', 'metodos_pagos.id', '=', 'ventas.id_metodo_pago')->join('datos_ventas', 'datos_ventas.id_venta', '=', 'ventas.id')->join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')
            ->select('direcciones.direccion', 'direcciones.telefono', 'direcciones.facturacion', 'direcciones.referencia', 'ventas.total as totalVenta', 'ventas.estado as estadoVenta', 'datos_ventas.numero as numeroTransaccion',
                'datos_ventas.imagen as imagenDatoVenta', 'ventas.id as id_venta', 'users.id as id_usuario', 'users.name as cliente')->where('ventas.id', '=', $id_decrypt)->distinct()->first();

        $productosVenta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->join('inventarios', 'inventarios.id_producto', '=', 'productos.id')
            ->select('productos.nombre', 'productos.id as id_prod', 'inventarios.stock', 'detalle_ventas.cantidad')->where('detalle_ventas.id_venta', '=', $id_decrypt)->get();
        return view('backend.ventas.manual')->with('ventas', $venta)->with('productos', $productosVenta);
    }

    public function mailuser(Request $request)
    {

        $data = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.id_producto')->join('inventarios', 'inventarios.id_producto', '=', 'productos.id')
            ->join('ventas', 'ventas.id', '=', 'detalle_ventas.id_venta')->join('users', 'users.id', '=', 'ventas.id_usuario')
            ->select('productos.nombre', 'productos.id as id_prod', 'inventarios.stock', 'detalle_ventas.cantidad', 'users.email as correo', 'ventas.created_at as fecha')->where('detalle_ventas.id_venta', '=', $request->id_venta)->get();
        // return $data[0]->correo;
        \Mail::to($data[0]->correo)->send(new ContactUser($data));
        return redirect()->back()->with('message', 'Corrreo enviado Correctamente a la direcci??n: ' . $data[0]->correo);
    }
}
