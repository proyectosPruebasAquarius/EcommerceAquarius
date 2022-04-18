<?php

namespace App\Http\Livewire;

use App\WishList;
use App\Inventario;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PreviewWishlist extends Component
{
    use LivewireAlert;
    public $whishlist= [];

    public function trash($id)
    {
        try {
            WishList::where('id', $id)->delete();
        } catch (\Exception $e) {
            \Debugbar::info($e->getMessage());
        }
    }

    public function trashAll() {
        try {
            if (Auth::check()) 
            WishList::where('id_user', Auth::id())->delete();            
        } catch (\Exception $e) {
            \Debugbar::info($e->getMessage());
        }
    }
    
    public function addToCartAll()
    {
        if (!empty($this->whishlist)) {
            /* $getInventory = []; */
            foreach ($this->whishlist as $w)
            {
                $hasOfferta = Inventario::where('id_producto', $w->id_producto)->value('id_oferta');
                $getInventory = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
                ->join('sub_categorias', 'productos.id_subcat', '=', 'sub_categorias.id')
                ->select('productos.nombre as producto', 'productos.imagen', 'productos.descripcion', 'inventarios.*', 'categorias.nombre as categoria', 'sub_categorias.nombre as sub_categoria','productos.imagen_principal')
                ->when($hasOfferta, function($query) {
                    $query->join('ofertas', 'inventarios.id_oferta', '=', 'ofertas.id')->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
                    ->addSelect('tipos_ofertas.nombre as tipo_oferta', 'ofertas.nombre as oferta', 'ofertas.estado as state');
                })->where('id_producto', $w->id_producto)->first();

                $this->addToCart($getInventory, 1);
            }
        }
    }

    public function addToCart($p, $value) {

        /* \Debugbar::info($p); */
        $this->qty = $value;
        if (\Cart::isEmpty()) {
            if ($this->corroborate($p['id'], $this->qty)) {
                # code...
                \Cart::add([
                    'id' => $p['id'],
                    'name' => $p['producto'],
                    'price' => $p['id_oferta'] ? $this->oferta($p['id_oferta'], $p['precio_venta']) : $p['precio_venta'],
                    'quantity' => $this->qty,
                    'attributes' => array(
                        'image' => json_decode($p['imagen'])[0],
                        'id_producto' => $p['id_producto'],
                        'unid' => 1
                    )
                ]);
        
                $this->emit('cartUpdated');
                $this->emit('show', \Cart::get($p['id'])->toArray());
                /* $this->alert('success', 'Producto Agregado al Carrito', [
                    'position' => 'bottom'
                ]); */
            } else {
                $this->alert('warning', 'Ocurrió un Error.', [
                    'position' => 'bottom'
                ]);
            }
        } else {
            $item = \Cart::get($p['id']);

            if ($item) {
                $item = $item->toArray();
                $inventario = Inventario::where('id', $p['id'])->value('stock');
                if ($this->qty + $item['quantity'] <= $inventario) {
                    # code...
                    \Cart::add([
                        'id' => $p['id'],
                        'name' => $p['producto'],
                        'price' => $p['id_oferta'] ? $this->oferta($p['id_oferta'], $p['precio_venta']) : $p['precio_venta'],
                        'quantity' => $this->qty,
                        'attributes' => array(
                            'image' => json_decode($p['imagen'])[0],
                            'id_producto' => $p['id_producto'],
                            'unid' => $item['attributes']['unid'],
                        )
                    ]);
            
                    $this->emit('cartUpdated');
                    $this->emit('show', \Cart::get($p['id'])->toArray());
                    /* $this->alert('success', 'Producto Agregado al Carrito', [
                        'position' => 'bottom'
                    ]); */
                } else {
                    $this->alert('warning', 'Ocurrió un Error.', [
                        'position' => 'bottom'
                    ]);
                }
            } else {
                if ($this->corroborate($p['id'], $this->qty)) {
                    
                    $last_unidAll = \Cart::getContent()->toArray();
                    /* $last_unid = 0; */
                    
                    $last_unid = end($last_unidAll); /* array_map( function ($last_unidAll) {
                        return max($last_unidAll['attributes']['unid']);
                    }, $last_unidAll) */;
                    /* \Debugbar::info($last_unid); */
                    \Cart::add([
                        'id' => $p['id'],
                        'name' => $p['producto'],
                        'price' => $p['id_oferta'] ? $this->oferta($p['id_oferta'], $p['precio_venta']) : $p['precio_venta'],
                        'quantity' => $this->qty,
                        'attributes' => array(
                            'image' => json_decode($p['imagen'])[0],
                            'id_producto' => $p['id_producto'],
                            'unid' => $last_unid['attributes']['unid']+1
                        )
                    ]);
            
                    $this->emit('cartUpdated');
                    $this->emit('show', \Cart::get($p['id'])->toArray());
                    /* $this->alert('success', 'Producto Agregado al Carrito', [
                        'position' => 'bottom'
                    ]); */
                } else {
                    $this->alert('warning', 'Ocurrió un Error.', [
                        'position' => 'bottom'
                    ]);
                }
            }
        }
    }

    public function corroborate($id, $qty) 
    {
        $stock = \DB::table('inventarios')->where('id', $id)->value('stock');

        if ($qty <= $stock) {
            return true;
        } else {
            return false;
        }
    }
    
    public function render()
    {
        $this->whishlist = WishList::join('productos', 'wishlists.id_producto', '=', 'productos.id')->select('productos.nombre', 'productos.imagen', 'wishlists.id_producto', 'wishlists.id')->where('id_user', '=', auth()->user()->id)->get();
        return view('livewire.preview-wishlist');
    }
}
