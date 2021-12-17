<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Inventario;
use App\Marca;

class TrendingProducts extends Component
{
    public $trending = [];
    public $offerts = [];

    public function addToCart($p) {


        \Cart::add([
            'id' => $p['id'],
            'name' => $p['nombre'],
            'price' => strtolower($p['tipo_oferta']) == 'descuento' && $p['state'] == 1 || strtolower($p['tipo_oferta']) == 'descuentos' && $p['state'] == 1 ? $p['precio_venta'] * ((100 - number_format($p['oferta'])) / 100) : $p['precio_venta'],
            'quantity' => 1,
            'attributes' => array(
                'image' => json_decode($p['imagen'])[0],
                'id_producto' => $p['id_producto']
            )
        ]);

        $this->emit('cartUpdated');
        $this->alert('success', 'Producto Agregado al Carrito', [
            'position' => 'bottom'
        ]);
    }

    public function render()
    {
        $this->trending = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->join('ofertas', 'inventarios.id_oferta', '=', 'ofertas.id')
        ->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
        ->select('inventarios.*', 'productos.nombre', 'productos.imagen', 'categorias.nombre as categoria', 'ofertas.nombre as oferta', 'ofertas.tiempo_limite', 'productos.descripcion', 
        'tipos_ofertas.nombre as tipo_oferta', 'ofertas.estado as state')->where('inventarios.estado','=',1)->latest()->limit(8)->get();

        $this->offerts = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->join('ofertas', 'inventarios.id_oferta', '=', 'ofertas.id')
        ->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
        ->select('inventarios.*', 'ofertas.nombre as oferta', 'ofertas.tiempo_limite', 'productos.nombre', 'productos.imagen', 'productos.descripcion', 'categorias.nombre as categoria', 'tipos_ofertas.nombre as tipo_oferta', 'ofertas.estado as state')
        ->where('ofertas.estado', 1)->where('inventarios.estado','=',1)
        ->latest()->limit(5)->get();

        $this->marcas = Marca::select('imagen')->get();


        return view('livewire.trending-products');
    }
}
