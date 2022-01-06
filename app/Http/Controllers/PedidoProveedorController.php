<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PedidoProveedor;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade as PDF;
use DB;

class PedidoProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = PedidoProveedor::join('productos','productos.id','=','pedidos_proveedores.id_producto')->join('inventarios','inventarios.id_producto','=','pedidos_proveedores.id_producto')
        ->join('proveedores','proveedores.id','=','productos.id_proveedor')->select('inventarios.codigo as codigo_producto','proveedores.nombre as proveedor','proveedores.direccion as direc_proveedor','proveedores.telefono as tel_proveedor',
        'proveedores.nombre_contacto as contacto','proveedores.tel_contacto','proveedores.estado as estado_proveedor','productos.nombre as producto','pedidos_proveedores.cantidad',
        'pedidos_proveedores.estado as estado_pedido','pedidos_proveedores.cantidad','pedidos_proveedores.fecha_entrega',
        'pedidos_proveedores.precio as precio_compra','pedidos_proveedores.id as id_pedido','pedidos_proveedores.created_at as fecha_registro')->get();
        //return $pedidos;
        return view('backend.pedidos.index')->with('pedidos',$pedidos);
        
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
    public function test()
    {
       /* $pedidos = PedidoProveedor::join('productos','productos.id','=','pedidos_proveedores.id_producto')->join('inventarios','inventarios.id_producto','=','pedidos_proveedores.id_producto')
        ->join('proveedores','proveedores.id','=','productos.id_proveedor')->select('productos.nombre as producto','inventarios.codigo as cod_prod','proveedores.nombre as proveedor',
        'proveedores.direccion','proveedores.telefono as tel_proveedor','pedidos_proveedores.cantidad','pedidos_proveedores.estado as estado_pedido',
        DB::raw('FORMAT(SUM(pedidos_proveedores.cantidad * pedidos_proveedores.precio),2) total_previsto'),
        DB::raw('FORMAT(pedidos_proveedores.cantidad * pedidos_proveedores.oommjj,2) total_unitario'))
        ->groupBy('productos.nombre')->get();

        return $pedidos;*/


        /*$pdf = PDF::loadView('pdf.pedido-proveedor')->setPaper('A4', 'landscape');
        return $pdf->stream();*/
       
      //return view('pdf.pedido-proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf(Request $request)
    {
        $rules = [];
        if ($request->fecha_fin == null) {
            $rules =[
                'fecha_inicio' => ['required','date'],    
            ];
        } else {
            $rules =[
                'fecha_inicio' => ['required','date'],
                'fecha_fin' => ['date']
            ];
        }
        $messages =[
            'fecha_incio.required' => 'La Fecha de Inicio es Obligatoria',
            'fecha_inicio.date' => 'El formato de la Fecha de Inicio es Invalido',
            'fecha_fin.date' => 'El formato de la Fecha de Inicio es Invalido',
        ];
       
        $this->validate($request, $rules, $messages);

        if ($request->fecha_fin == null) {  



            $pedidos = PedidoProveedor::join('productos','productos.id','=','pedidos_proveedores.id_producto')->join('inventarios','inventarios.id_producto','=','pedidos_proveedores.id_producto')
            ->join('proveedores','proveedores.id','=','productos.id_proveedor')->select('productos.nombre as producto','inventarios.codigo as cod_prod','proveedores.nombre as proveedor',
            'proveedores.direccion','proveedores.telefono as tel_proveedor','pedidos_proveedores.cantidad','pedidos_proveedores.estado as estado_pedido','pedidos_proveedores.precio as precio_unitario',
            DB::raw('FORMAT(pedidos_proveedores.cantidad * pedidos_proveedores.precio,2) total_unitario'))
            ->groupBy('productos.nombre')->whereDate('pedidos_proveedores.created_at',$request->fecha_incio)->get();
          
            $total_previsto = PedidoProveedor::whereDate('created_at','2022-01')->select(DB::raw('FORMAT(SUM(pedidos_proveedores.cantidad * pedidos_proveedores.precio),2) total_previsto'))
            ->get();

            if (sizeof($pedidos) == 0) {
                return redirect('admin/pedidos')->with('message', 'No hay registro en las Fechas selecionada '.$request->fecha_inicio)->with('alert', 'warning');
            } else {                              
                $pdf = PDF::loadView('pdf.pedido-proveedor',['pedidos' => $pedidos,'fecha_inicio' =>$request->fecha_inicio,'fecha_fin' =>$request->fecha_fin,'total_previsto' => $total_previsto])->setPaper('letter', 'landscape');
                return $pdf->stream('Pedido Proveedor '.$request->fecha_inico.'.pdf');
            }
            



        } else {
            
                $pedidos = PedidoProveedor::join('productos','productos.id','=','pedidos_proveedores.id_producto')->join('inventarios','inventarios.id_producto','=','pedidos_proveedores.id_producto')
                ->join('proveedores','proveedores.id','=','productos.id_proveedor')->select('productos.nombre as producto','inventarios.codigo as cod_prod','proveedores.nombre as proveedor',
                'proveedores.direccion','proveedores.telefono as tel_proveedor','pedidos_proveedores.cantidad','pedidos_proveedores.estado as estado_pedido',
                DB::raw('FORMAT(SUM(pedidos_proveedores.cantidad * pedidos_proveedores.precio),2) total_previsto'),
                DB::raw('FORMAT(pedidos_proveedores.cantidad * pedidos_proveedores.precio,2) total_unitario'))
                ->groupBy('productos.nombre')->whereBetween('pedidos_proveedores.created_at',[$request->fecha_inicio,$request->fecha_fin])->get();
                
                
               
                $total_previsto = PedidoProveedor::whereBetween('pedidos_proveedores.created_at',[$request->fecha_inicio,$request->fecha_fin])->select(DB::raw('FORMAT(SUM(pedidos_proveedores.cantidad * pedidos_proveedores.precio),2) total_previsto'))
                ->get();
                 //return $total_previsto;

            if (sizeof($pedidos) == 0 ) {
                return redirect('admin/pedidos')->with('message', 'No hay registro en las Fechas selecionadas '.$request->fecha_inicio.' hasta '.$request->fecha_fin)->with('alert', 'warning');
            } else {                
                $pdf = PDF::loadView('pdf.pedido-proveedor',['pedidos' => $pedidos,'fecha_inicio' =>$request->fecha_inicio,'fecha_fin' =>$request->fecha_fin,'total_previsto' => $total_previsto])->setPaper('letter', 'landscape');
                return $pdf->stream('Pedido Proveedor '.$request->fecha_inico.' hasta '.$request->fecha_fin.'.pdf');
            }                                  
        }            
        


        /*$pdf = PDF::loadView('pdf.pedido-proveedor')->setPaper('A4', 'landscape');
        return $pdf->stream();*/
       
      //return view('pdf.pedido-proveedor');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_decrypt = Crypt::decrypt($id);
        $pedidos = PedidoProveedor::join('productos','productos.id','=','pedidos_proveedores.id_producto')->join('inventarios','inventarios.id_producto','=','pedidos_proveedores.id_producto')
        ->join('proveedores','proveedores.id','=','productos.id_proveedor')->select('inventarios.codigo as codigo_producto','proveedores.nombre as proveedor','proveedores.direccion as direc_proveedor','proveedores.telefono as tel_proveedor',
        'proveedores.nombre_contacto as contacto','proveedores.tel_contacto','proveedores.estado as estado_proveedor','productos.nombre as producto','pedidos_proveedores.cantidad',
        'pedidos_proveedores.estado as estado_pedido','pedidos_proveedores.cantidad','pedidos_proveedores.fecha_entrega','pedidos_proveedores.precio as precio_compra','pedidos_proveedores.id as id_pedido')
        ->where('pedidos_proveedores.id','=',$id_decrypt)->get();

        return view('backend.pedidos.form')->with('pedidos',$pedidos);
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
        $rules = [];
        if ($request->fecha_entrega == null) {
            $rules = [
           
                'precio_compra' => ['required','regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
                          
                'estado_pedido' => ['required'],
                'cantidad' => ['required','numeric'],
                
            ];
    
        } else {
            $rules = [
           
                'precio_compra' => ['required','regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
                'fecha_entrega' => ['date'],           
                'estado_pedido' => ['required'],
                'cantidad' => ['required','numeric'],
                
            ];
    
        }
        
        
        $messages = [
            'precio_compra.required' => 'El Precio de Compra es Obligatorio.',
            'precio_compra.regex' => 'El formato del Precio de Compra es inválido.',
            'fecha_entrega.date' => 'Formato de Fecha no Valido',
            'estado_pedido.required' => 'El Estado del pedido es Obligatorio',
            'cantidad.required' => 'La Cantidad del Producto del Pedido es Obligatorio',
            'cantidad.numeric' => 'Formato de número no valido'
        ];
        $this->validate($request, $rules, $messages);

        PedidoProveedor::where('id','=',$id_decrypt)->update([
            'precio' => $request->precio_compra,
            'cantidad' => $request->cantidad,
            'estado' => $request->estado_pedido,
            'fecha_entrega' => $request->fecha_entrega
        ]);
        return redirect('admin/pedidos')->with('message', 'Pedido Actualizado Correctamente')->with('alert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
