<?php

namespace App\Http\Controllers;

use App\Product;
use App\Marca;
use App\Venta;
use App\DetalleVenta;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productos = Product::orderBy('id', 'asc');

        /* if (!empty($request->filter)) {
            $c = $productos->get();
            $p = $productos->where('nombre', 'like', '%'.$request->filter.'%')->get();            
            return view('frontend.product')->with('products', $p)->with('filterC', count($p))->with('filterA', count($c));
        } else {
            $p = $productos->paginate(9);
            return view('frontend.product')->with('products', $p)->with('filterC', count($p))->with('filterA', count($p));
        } */
        if (request()->session()->get('categoria')) {
            request()->session()->forget('categoria');
        }
        return view('frontend.product');
        
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($categoria)
    {
        $marcas = Product::join('categorias', 'productos.id_categoria', '=', 'categorias.id')->join('marcas', 'productos.id_marca', '=', 'marcas.id')
        ->where('categorias.nombre', $categoria)->select('marcas.nombre')->distinct()->get();
        return $marcas;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function test()
    {
       
       
       
       

        
    }
}
