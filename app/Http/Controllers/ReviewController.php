<?php

namespace App\Http\Controllers;

use App\Review;
use App\Product;
use App\Inventario;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $data = Crypt::decrypt($id);
        $hasOfferta = Inventario::where('id_producto', $data)->value('id_oferta');
        $productos = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->join('sub_categorias', 'productos.id_subcat', '=', 'sub_categorias.id')
        ->select('productos.nombre as producto', 'productos.imagen', 'productos.descripcion', 'inventarios.*', 'categorias.nombre as categoria', 'sub_categorias.nombre as sub_categoria')
        ->when($hasOfferta, function($query) {
            $query->join('ofertas', 'inventarios.id_oferta', '=', 'ofertas.id')->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
            ->addSelect('tipos_ofertas.nombre as tipo_oferta', 'ofertas.nombre as oferta', 'ofertas.estado as state');
        })
        ->where('id_producto', $data)->first();
        if (auth()->check()) {
            
            $comentarios = Review::join('users', 'users.id', '=', 'opiniones.id_usuario')->select('opiniones.*', 'users.image', 'users.name')
                                    ->whereNotIn('opiniones.id_usuario', [auth()->user()->id])->orderBy('opiniones.rating', 'desc')->where('opiniones.id_producto', $data)->simplePaginate(5);

        } else {
            $comentarios = Review::join('users', 'users.id', '=', 'opiniones.id_usuario')->select('opiniones.*', 'users.image', 'users.name')
            ->orderBy('opiniones.rating', 'desc')->where('opiniones.id_producto', $data)->simplePaginate(5);
        }

        if ($request->ajax()) {
            return ['coments' => $comentarios];
        }
       
        return view('frontend.product-detail')->with('productos', $productos)->with('coments', $comentarios)->with('data', $data);
        
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
        $opinion = new Review;
        $opinion->title = $request->title;
        $opinion->descripcion = $request->descripcion;
        $opinion->id_usuario = auth()->user()->id;
        $opinion->rating = $request->rating;
        $opinion->id_producto = $request->id_producto;
        $opinion->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $review = Review::findOrFail($id);
        $review->title = $request->title;
        $review->descripcion = $request->descripcion;
        $review->id_usuario = auth()->user()->id;
        $review->rating = $request->rating;
        $review->id_producto = $review->id_producto;
        $review->update();
        
        return back()->withMessage('Opinón actualizada');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $review = Review::findOrFail($id)->delete();

        return back()->withMessage('Elemento eliminado con éxito.');

    }
}
