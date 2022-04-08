<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Categoria;
use App\Producto;
use App\Venta;
use App\Inventario;
use App\User;
use App\TrackService;
use App\DetalleVenta;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $productOfert = Inventario::where('estado','=', 1)->whereNotNull('id_oferta')->select('id_oferta as cuenta')->count();
       $notifications = auth()->user()->unreadNotifications;

        $bestSellingProduct =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('ventas','detalle_ventas.id_venta','=','ventas.id')->where('ventas.estado','=',1)
        ->select('productos.nombre as producto',DB::raw('COUNT(detalle_ventas.id_producto) AS cuentaTotal'))
        ->groupBy('detalle_ventas.id_producto')->orderBy('cuentaTotal','DESC')->limit(1)->get();
        $bestSellingProducts =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')
        ->join('ventas','detalle_ventas.id_venta','=','ventas.id')->where('ventas.estado','=',1)
        ->select('productos.imagen','productos.nombre as producto',DB::raw('COUNT(detalle_ventas.id_producto) AS cuentaTotal'))
        ->groupBy('detalle_ventas.id_producto')->orderBy('cuentaTotal','DESC')->limit(5)->get();


       $MaxBuyerCostumer = Venta::join('users','users.id','=','ventas.id_usuario')->where('ventas.estado','=',1)->select('users.name as nombre','users.email as correo',DB::raw('FORMAT(SUM(ventas.total),2) AS sumtotal'))->groupBy('users.name')
       ->orderBy('sumtotal','desc')->distinct()->limit(1)->get();
       $MaxBuyerCostumers = Venta::join('users','users.id','=','ventas.id_usuario')->where('ventas.estado','=',1)->select('users.name as nombre','users.email as correo',DB::raw('FORMAT(SUM(ventas.total),2) sumtotal'),DB::raw('COUNT(ventas.id_usuario) as cuentaCompras'))
       ->groupBy('users.name')
       ->orderBy('cuentaCompras','desc')->distinct()->limit(5)->get();


       $MinBuyerCostumers = Venta::join('users','users.id','=','ventas.id_usuario')->where('ventas.estado','=', 1)->select('users.name as nombre','users.email as correo',DB::raw('FORMAT(SUM(ventas.total),2) sumtotal'),DB::raw('COUNT(ventas.id_usuario) as cuentaCompras'))
       ->groupBy('users.name')
       ->orderBy('cuentaCompras','asc')->distinct()->limit(5)->get();
       
        $bestSellingCategory =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('categorias','categorias.id','=','productos.id_categoria')
        ->join('ventas','detalle_ventas.id_venta','=','ventas.id')->where('ventas.estado','=',1)
        ->select('categorias.nombre as categoria',DB::raw('COUNT(productos.id_categoria) AS cuentaTotal'))
        ->groupBy('productos.id_categoria')->orderBy('cuentaTotal','DESC')->limit(1)->get();

        
        $bestSellingCategories =  DetalleVenta::join('productos','productos.id','=','detalle_ventas.id_producto')->join('ventas','detalle_ventas.id_venta','=','ventas.id')
        ->join('categorias','categorias.id','=','productos.id_categoria')->where('ventas.estado','=',1)
        ->select('categorias.nombre as categoria',DB::raw('COUNT(productos.id_categoria) AS cuentaTotal'))
        ->groupBy('productos.id_categoria')->orderBy('cuentaTotal','DESC')->limit(5)->get();

    
        $today =date("Y-m-d");
        $year = date("Y");
        $month = date("m");

        $lastUserRegister = TrackService::whereMonth('created_at',$month)->count();

        $DailySales =  Venta::select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))
        ->whereDate('ventas.created_at','=',$today)->where('ventas.estado','=',1)->get();


        $MonthSales =  Venta::select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))
        ->whereMonth('ventas.created_at', $month)->where('ventas.estado','=',1)->get();
        $YearSales =  Venta::select(DB::raw('FORMAT(SUM(ventas.total),2) AS cuentaTotal'))
        ->whereYear('ventas.created_at', $year)->where('ventas.estado','=',1)->get();



        
      // return $YearSales;
        return view('backend.home')->with('sellingProduct',$bestSellingProduct)->with('ventaAnual',$YearSales)->with('ventaDiaria',$DailySales)
        ->with('ventaMensual',$MonthSales)->with('hoy',$today)->with('mes',$month)->with('ano',$year)->with('maxBuyer',$MaxBuyerCostumer)->with('maxCat',$bestSellingCategory)
        ->with('lastUser',$lastUserRegister)->with('maxProducts',$bestSellingProducts)->with('maxCategories',$bestSellingCategories)->with('maxBuyers',$MaxBuyerCostumers)
        ->with('minBuyers',$MinBuyerCostumers)->with('notifications', $notifications);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function ventaxfecha(Request $request)
    {
        $fecha = $request->venta_fecha;

        $DateSale = Venta::whereDate('created_at', $fecha)->sum('ventas.total');

        return redirect('/admin/inicio')->with('date',$DateSale)->with('fecha',$fecha);
       // return $DateSale;
    }
    public function test()
    {

        return view('emails.contactuser');

        
    }
}
