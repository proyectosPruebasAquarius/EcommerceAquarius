<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Inventario;
use Illuminate\Support\Facades\Crypt;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Detail extends Component
{
    use LivewireAlert;
    public $productos = [];
    public $data;
    public $qty = 1;
    
    public function updateQty($qty) 
    {
        /* \Debugbar::info($qty); */
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

    public function addAndRedirect($p, $value) {
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
                return redirect()->to('/carrito');
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
                    return redirect()->to('/carrito');
                } else {
                    $this->alert('warning', 'Ocurrió un Error.', [
                        'position' => 'bottom'
                    ]);
                }
            } else {
                if ($this->corroborate($p['id'], $this->qty)) {
                    # code...
                    $last_unidAll = \Cart::getContent()->toArray();
                    $last_unid = end($last_unidAll);

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
                    return redirect()->to('/carrito');
                } else {
                    $this->alert('warning', 'Ocurrió un Error.', [
                        'position' => 'bottom'
                    ]);
                }
            }
        }
    }

    public function oferta($id, $precio)
    {
        /* \Debugbar::info($id, $precio); */
        $hasOferta = \DB::table('ofertas')->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
        ->where([
            ['ofertas.id', $id],
            ['ofertas.estado', '1'],
            ['tipos_ofertas.estado', '1']
        ])->select('ofertas.nombre as oferta', 'tipos_ofertas.nombre as type')->get();

        if (strtolower($hasOferta[0]->type) == 'descuento' || strtolower($hasOferta[0]->type) == 'descuentos') {
            return $precio * (('100' - number_format($hasOferta[0]->oferta)) / '100');
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
        $hasOfferta = Inventario::where('id_producto', $this->data)->value('id_oferta');
        $this->productos = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->join('sub_categorias', 'productos.id_subcat', '=', 'sub_categorias.id')
        ->select('productos.nombre as producto', 'productos.imagen', 'productos.descripcion', 'inventarios.*', 'categorias.nombre as categoria', 'sub_categorias.nombre as sub_categoria')
        ->when($hasOfferta, function($query) {
            $query->join('ofertas', 'inventarios.id_oferta', '=', 'ofertas.id')->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
            ->addSelect('tipos_ofertas.nombre as tipo_oferta', 'ofertas.nombre as oferta', 'ofertas.estado as state');
        })
        ->where('id_producto', $this->data)->first();

        return view('livewire.detail');
    }
}
