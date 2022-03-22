<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
use App\Inventario;
use App\Categoria;
use App\Marca;
use App\SubCategoria;
use Illuminate\Support\Collection;

class ProductsGridCard extends Component
{    

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search; 
    public $sortField = 'productos.nombre';
    public $sortDirection = 'asc';
    public $categoriaFilt;
    public $marca;
    public $sub_categoria;
    public $rango;

    public $orderBy;
    
    protected $queryString = ['categoriaFilt', 'marca', 'sub_categoria', 'rango'];
    protected $listeners = ['searchW' => 'search', 'sort' => 'sortBy'];
    
    public function sortBy($order) 
    {
        /* \Debugbar::info($order); */
        $order = explode(', ', $order);
        foreach ($order as $key => $value) {
            if ($key == 0) {
                $this->sortField = $value;
            } else {
                $this->sortDirection = $value;
            }
            
        }
    }

    public function updatingSearch()

    {

        $this->resetPage();

    }

    /* public function updatedOrderBy() 
    {
        $this->orderBy = explode(', ', $this->orderBy);
        foreach ($this->orderBy as $key => $value) {
            if ($key == 0) {
                $this->sortField = $value;
            } else {
                $this->sortDirection = $value;
            }
            
        }
        
    } */

    public function category($cat)
    {
        if ($cat == $this->categoriaFilt) {
            
            if (!empty($cat) && !empty($this->categoriaFilt)) {
                
                $this->reset('categoriaFilt');
                if ($this->sub_categoria) {
                    $this->reset('sub_categoria');
                }

            } else {
                
                $this->categoriaFilt = $cat;

            }
            
        } else {
            
            if ($this->sub_categoria) {
                # code...
                
                if ($cat) {
                    # code...
                    $this->categoriaFilt = $cat;
                } else {
                    $this->reset('sub_categoria');
                    $this->reset('categoriaFilt');
                }
            } else {
                $this->categoriaFilt = $cat ? $cat : null;
            }

        }
        
        
    }

    public function brand($br)
    {
        if ($br == $this->marca) {
            # code...
            if (!empty($this->marca) && !empty($br)) {
                $this->reset('marca');
            } else {
                $this->marca = $br;
            }
        } else {
            $this->marca = $br ? $br : null;
        }
        
    }

    public function subCategoria($subCat) 
    {
        if ($subCat == $this->sub_categoria && request()->session()->exists('newSubCat')) {
            request()->session()->forget('newSubCat');
            return redirect()->to('/productos');
        } elseif ($subCat == $this->sub_categoria) {
            
            if (!empty($this->sub_categoria) && !empty($subCat)) {
                
                $this->reset('sub_categoria');
                
            } else {
                
                $this->sub_categoria = $subCat;

            }
            
        } else {
            
            $this->sub_categoria = $subCat ? $subCat : null;

        }
        
        
    }

    public function rango($range)
    {
        if ($this->rango == $range) {
            
            if (!empty($this->rango) && !empty($range)) {
                
                $this->reset('rango');

            } else {
                
                $this->rango = $range;

            }
            
        } else {
            $this->rango = $range ? $range : null;
        }
        
        
    }

    public function resetFilters()
    {
        $this->reset('rango');
    }

    public function mount()
    {
        /* if (request('categoria')) {
            $this->categoriaFilt = request('categoria');
        } */

        if (request()->route()->getName() == 'categoria') {
            if (request()->session()->exists('newSubCat')) {
                $this->categoriaFilt = request('categoria');
                $this->sub_categoria = session('newSubCat');
            } else {
                $this->categoriaFilt = request('categoria');
            }
        } else if (request()->route()->getName() == 'bySearch') {
            $this->search = request('search');
        }
    }


    public function addToCart($p) {

       
        if (\Cart::isEmpty()) {

            \Cart::add([
                'id' => $p['id'],
                'name' => $p['nombre'],
                'price' =>  $p['id_oferta'] ? $this->oferta($p['id_oferta'], $p['precio_venta']) : $p['precio_venta'],
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

        } else {
            
            $item = \Cart::get($p['id']);
            
            if ($item) {
                $item = $item->toArray();

                $inventario = Inventario::where('id', $p['id'])->value('stock');

                if ($item['quantity'] < $inventario) {
                    
                    \Cart::add([
                        'id' => $p['id'],
                        'name' => $p['nombre'],
                        'price' =>  $p['id_oferta'] ? $this->oferta($p['id_oferta'], $p['precio_venta']) : $p['precio_venta'],
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

                } else {
                    
                    $this->alert('warning', 'Ocurrió un Error. <a href="/productos" class="link-primary">Recargar la Página</a>', [
                        'position' => 'bottom'
                    ]);

                }
            } else {
                \Cart::add([
                    'id' => $p['id'],
                    'name' => $p['nombre'],
                    'price' =>  $p['id_oferta'] ? $this->oferta($p['id_oferta'], $p['precio_venta']) : $p['precio_venta'],
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

    public function subCategoriaRedirect()
    {
        request()->session()->forget('newSubCat');
        return redirect()->to('/productos');
    }

    public function listOrGrid($view) 
    {
       /*  if (request()->session()->has('listOrGrid')) {
            
        } else { */
        session(['listOrGrid' =>  $view]);
        
        
    }

    public function render()
    {

        $search = '%'.$this->search.'%';
        $categoriaFilt = $this->categoriaFilt;
        $marcas = $this->marca;
        $sub_categoria = $this->sub_categoria;
        $rango = $this->rango;

        $orderBy = $this->orderBy;
        $field = $this->sortField;
        $direction = $this->sortDirection;

        $productos = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
                    ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
                    ->join('marcas', 'productos.id_marca', '=', 'marcas.id')//Product::where('nombre', 'like', $search)->orderBy($this->sortField, $this->sortDirection)->paginate(9),
                    ->join('sub_categorias', 'productos.id_subcat', '=', 'sub_categorias.id')
                    ->select('inventarios.*', 'productos.nombre', 'productos.imagen','productos.imagen_principal', 'categorias.nombre as id_categoria', 'marcas.nombre as marca')->where('productos.nombre', 'like', $search)->where('inventarios.estado','=',1)
                    ->where('inventarios.estado', 1)->where('inventarios.stock', '>', 0)
                    ->when($categoriaFilt, function ($query) use ($categoriaFilt) {
                        $query->where('categorias.nombre', $categoriaFilt);
                    })
                    ->when($marcas, function ($query) use ($marcas) {
                        $query->where('marcas.nombre', $marcas);
                    })
                    ->when($sub_categoria, function ($query) use ($sub_categoria) {
                        $query->where('sub_categorias.nombre', $sub_categoria);
                    })
                    ->when($rango, function ($query) use ($rango) {
                        $query->whereBetween('inventarios.precio_venta', $rango);
                    })
                    ->orderBy($field, $direction)->paginate(9);
        $all = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
                        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
                        ->join('marcas', 'productos.id_marca', '=', 'marcas.id')
                        ->join('sub_categorias', 'productos.id_subcat', '=', 'sub_categorias.id')
                        ->where('inventarios.stock', '>', 0)
                        ->when($categoriaFilt, function ($query) use ($categoriaFilt) {
                            $query->where('categorias.nombre', $categoriaFilt);
                        })
                        ->when($marcas, function ($query) use ($marcas) {
                            $query->where('marcas.nombre', $marcas);
                        })
                        ->when($sub_categoria, function ($query) use ($sub_categoria) {
                            $query->where('sub_categorias.nombre', $sub_categoria);
                        })
                        ->when($rango, function ($query) use ($rango) {
                            $query->whereBetween('inventarios.precio_venta', $rango);
                        })->get();

        $categorias = Categoria::get();
        $brands = $categoriaFilt 
            ? Product::join('marcas', 'productos.id_marca', '=', 'marcas.id')->join('categorias', 'productos.id_categoria', '=', 'categorias.id')->select('marcas.*')->where([['marcas.estado', 1], ['categorias.nombre', $categoriaFilt]])->distinct()->get() 
            : Marca::where('marcas.estado', 1)->get();
        $subCategorias = SubCategoria::when($categoriaFilt, function ($query) use ($categoriaFilt) {
            $query->join('categorias', 'sub_categorias.id_categoria', '=', 'categorias.id')->select('sub_categorias.*', 'categorias.nombre as categoria')->where('categorias.nombre', $categoriaFilt);
        })->get();

        return view('livewire.products-grid-card', [
            'productos' => $productos,
            'filterC' => count($productos),
            'filterA' => count($all),
            'categorias' => $categorias,
            'brands' => $brands,
            'subCategorias' => $subCategorias
        ]);
    }

}
