<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;

class PedidoController extends Controller
{


    public function index()
    {
        $pedidos = Pedido::join('ventas','ventas.id','=','pedidos.id_venta')->join('detalle_ventas','detalle_ventas.id_venta','=','ventas.id')
        ->join('users','users.id','=','ventas.id_usuario')->join('direcciones','direcciones.id','=','ventas.id_direccion')
        ->join('direcciones_facturaciones','direcciones_facturaciones.id','=','ventas.id_facturacion')
        ->select('pedidos.id as id_pedido','ventas.id as id_venta','users.name as usuario','ventas.num_transaccion','direcciones.direccion as direccion',
        'direcciones_facturaciones.direccion as direccion_facturacion')->get();

        return view('backend.pedidos-ventas.index')->with('pedidos',$pedidos);
        
    }






















}
