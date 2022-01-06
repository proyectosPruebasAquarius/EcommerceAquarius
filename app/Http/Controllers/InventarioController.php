<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\Oferta;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class InventarioController extends Controller
{
    public function detail($id)
    {
        $id_decrypt = Crypt::decrypt($id);
        $inventario = Inventario::join('productos', 'productos.id', '=', 'inventarios.id_producto')->join('proveedores','proveedores.id','=','productos.id_proveedor')->join('marcas','marcas.id','=','productos.id_marca')
        ->join('categorias','categorias.id','=','productos.id_categoria')->join('sub_categorias','sub_categorias.id','=','productos.id_subcat')   ->leftJoin('ofertas', 'ofertas.id', '=', 'inventarios.id_oferta')
            ->select('inventarios.estado', 'inventarios.id as id_inventario', 'inventarios.precio_compra', 'inventarios.precio_venta', 'inventarios.codigo', 'inventarios.stock', 
            'inventarios.min_stock', 'ofertas.id as id_oferta', 'ofertas.nombre as oferta', 'productos.id as id_producto', 'productos.nombre as producto','proveedores.nombre as proveedor','productos.imagen',
            'marcas.nombre as marca','categorias.nombre as categoria','sub_categorias.nombre as subcat')
            ->where('inventarios.id', '=', $id_decrypt)->get();
        //return $inventario;
        return view('backend.inventarios.detail')->with('inventarios', $inventario);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventarios = Inventario::join('productos', 'productos.id', '=', 'inventarios.id_producto')->leftJoin('ofertas', 'ofertas.id', '=', 'inventarios.id_oferta')
            ->select('inventarios.id', 'precio_compra', 'stock', 'precio_venta', 'codigo', 'productos.nombre as producto', 'inventarios.min_stock', 'inventarios.estado', 'ofertas.nombre as oferta','precio_descuento')->get();

        return view('backend.inventarios.index')->with('inventarios', $inventarios);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.inventarios.form')->with('type', 'add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
        'codigo' => ['required'],
        'stock' => ['required','numeric'],
        'min_stock' => ['required','numeric'],
        'precio_compra' => ['required','regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
        'precio_venta' => ['required','regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
        'producto' => 'required',

        ];

        $messages = [
        'codigo.required' => 'El Codigo del Producto es Obligatorio.',
        'stock.required' => 'EL Stock del Producto es Obligatorio.',
        'stock.numeric' => 'EL Stock del Producto deben ser caracteres numerícos.',
        'min_stock.required' => 'EL Stock Minímo del Producto es Obligatorio.',
        'min_stock.numeric' => 'EL Stock Minímo del Producto deben ser caracteres numerícos.',
        'precio_compra.required' => 'El Precio de Compra es Obligatorio.',
        'precio_compra.regex' => 'El formato del Precio de Compra es inválido.',
        'precio_venta.regex' => 'El formato del Precio de Compra es inválido.',
        'precio_venta.required' => 'El Precio de Venta es Obligatorio.',
        'producto.required' => 'El Producto es Obligatorio.',

        ];
        $this->validate($request, $rules, $messages);

        $oferta = Oferta::select('nombre')->where('id', '=', $request->oferta)->get();
        $descuento = NULL;
        if ($request->oferta != null) {
            $descuento = $oferta[0]->nombre;
            $inventario = new Inventario;
            $inventario->precio_compra = $request->precio_compra;
            $inventario->precio_venta = $request->precio_venta;
            $inventario->codigo = $request->codigo;
            $inventario->stock = $request->stock;
            $inventario->id_producto = $request->producto;
            $inventario->id_oferta = $request->oferta;
            $inventario->min_stock = $request->min_stock;
            function porcentaje($cantidad,$porciento,$decimales){
                return number_format($cantidad*$porciento/100 ,$decimales);
                }
                $porciento =  porcentaje($request->precio_venta,intval($descuento),2);

            $inventario->precio_descuento = $request->precio_venta - $porciento;
           

            $inventario->save();
        } else {
            $inventario = new Inventario;
            $inventario->precio_compra = $request->precio_compra;
            $inventario->precio_venta = $request->precio_venta;
            $inventario->codigo = $request->codigo;
            $inventario->stock = $request->stock;
            $inventario->id_producto = $request->producto;
            $inventario->id_oferta = $request->oferta;
            $inventario->min_stock = $request->min_stock;
            $inventario->save();
        }

        return redirect('admin/inventarios')->with('message', 'Registro ingresado correctamente')->with('alert', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notify($id, $notify)
    {
        if ($notify !== null) {
            DB::table('notifications')->where('id', '=', $notify)->update(['read_at' => now()]);
        }
        $id_decrypt = Crypt::decrypt($id);
        $inventario = Inventario::join('productos', 'productos.id', '=', 'inventarios.id_producto')->leftJoin('ofertas', 'ofertas.id', '=', 'inventarios.id_oferta')
            ->select('inventarios.estado', 'inventarios.id as id_inventario', 'inventarios.precio_compra', 'inventarios.precio_venta', 'inventarios.codigo', 'inventarios.stock', 'inventarios.min_stock', 'ofertas.id as id_oferta', 'ofertas.nombre as oferta', 'productos.id as id_producto', 'productos.nombre as producto')
            ->where('inventarios.id', '=', $id_decrypt)->get();

        return view('backend.inventarios.form')->with('type', 'edit')->with('inventarios', $inventario);
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
        $inventario = Inventario::join('productos', 'productos.id', '=', 'inventarios.id_producto')->leftJoin('ofertas', 'ofertas.id', '=', 'inventarios.id_oferta')
            ->select('inventarios.estado', 'inventarios.id as id_inventario', 'inventarios.precio_compra', 'inventarios.precio_venta', 'inventarios.codigo', 'inventarios.stock', 'inventarios.min_stock', 'ofertas.id as id_oferta', 'ofertas.nombre as oferta', 'productos.id as id_producto', 'productos.nombre as producto')
            ->where('inventarios.id', '=', $id_decrypt)->get();

        return view('backend.inventarios.form')->with('type', 'edit')->with('inventarios', $inventario);

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
        $rules = [
            'codigo' => ['required'],
            'stock' => ['required', 'numeric'],
            'min_stock' => ['required', 'numeric'],
            'precio_compra' => ['required', 'regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
            'precio_venta' => ['required', 'regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
            'producto' => 'required',
            'estado' => 'required',

        ];

        $messages = [
            'codigo.required' => 'El Codigo del Producto es Obligatorio.',
            'stock.required' => 'EL Stock del Producto es Obligatorio.',
            'stock.numeric' => 'EL Stock del Producto deben ser caracteres numerícos.',
            'min_stock.required' => 'EL Stock Minímo del Producto es Obligatorio.',
            'min_stock.numeric' => 'EL Stock Minímo del Producto deben ser caracteres numerícos.',
            'precio_compra.required' => 'El Precio de Compra es Obligatorio.',
            'precio_compra.regex' => 'El formato del Precio de Compra es inválido.',
            'precio_venta.regex' => 'El formato del Precio de Compra es inválido.',
            'precio_venta.required' => 'El Precio de Venta es Obligatorio.',
            'producto.required' => 'El Producto es Obligatorio.',
            'estado.required' => 'El Estado del Inventario es Obligatorio',

        ];
        $this->validate($request, $rules, $messages);

        $id_decrypt = Crypt::decrypt($id);
        $oferta = Oferta::select('nombre')->where('id', '=', $request->oferta)->get();
        $descuento = NULL;
        

        if ($request->oferta != null) {
            $descuento = $oferta[0]->nombre;
            $inventario = Inventario::where('id','=',$id_decrypt)->first();
            $inventario->precio_compra = $request->precio_compra;
            $inventario->precio_venta = $request->precio_venta;
            $inventario->codigo = $request->codigo;
            $inventario->stock = $request->stock;
            $inventario->id_producto = $request->producto;
            $inventario->id_oferta = $request->oferta;
            $inventario->min_stock = $request->min_stock;
            function porcentaje($cantidad,$porciento,$decimales){
                return number_format($cantidad*$porciento/100 ,$decimales);
                }
                $porciento =  porcentaje($request->precio_venta,intval($descuento),2);

            $inventario->precio_descuento = $request->precio_venta - $porciento;
           

            $inventario->save();

        } else {
            $inventario = Inventario::where('id','=',$id_decrypt)->first();
            $inventario->precio_compra = $request->precio_compra;
            $inventario->precio_venta = $request->precio_venta;
            $inventario->codigo = $request->codigo;
            $inventario->stock = $request->stock;
            $inventario->id_producto = $request->producto;
            $inventario->id_oferta = $request->oferta;
            $inventario->min_stock = $request->min_stock;
            $inventario->save();
        }

        return redirect('admin/inventarios')->with('message', 'Registro actualizado correctamente')->with('alert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_decrypt = Crypt::decrypt($id);

        Inventario::where('id', '=', $id_decrypt)->delete();
        return redirect('admin/inventarios')->with('message', 'Registro eliminado correctamente')->with('alert', 'success');
    }

    public function selectproducto(Request $request)
    {
        $data = [];

        if ($request->q == null) {

            $data = Producto::orderby('productos.nombre', 'asc')->join('marcas', 'marcas.id', '=', 'productos.id_marca')
                ->select("productos.id", DB::raw("CONCAT('Producto: ',productos.nombre,', ','Marca: ',marcas.nombre) as text"))
                ->where('estado', '=', 1)->get();

        } else {
            $search = $request->q;
            $data = Producto::orderby('productos.nombre', 'asc')->join('marcas', 'marcas.id', '=', 'productos.id_marca')
                ->select("productos.id", DB::raw("CONCAT('Producto: ',productos.nombre,', ','Marca: ',marcas.nombre) as text"))
                ->where('estado', '=', 1)->where('productos.nombre', 'like', '%' . $search . '%')->get();
        }

        return response()->json($data);
    }

    public function selectoferta(Request $request)
    {
        $data = [];

        if ($request->q == null) {

            $data = Oferta::orderby('ofertas.nombre', 'asc')->join('tipos_ofertas', 'tipos_ofertas.id', '=', 'ofertas.id_tipo_oferta')
                ->select("ofertas.id", DB::raw("CONCAT('Oferta: ',ofertas.nombre,', ','Tipo: ',tipos_ofertas.nombre) as text"))
                ->where('ofertas.estado', '=', 1)->get();

        } else {
            $search = $request->q;

            $data = Oferta::orderby('ofertas.nombre', 'asc')->join('tipos_ofertas', 'tipos_ofertas.id', '=', 'ofertas.id_tipo_oferta')
                ->select("ofertas.id", DB::raw("CONCAT('Oferta: ',ofertas.nombre,', ','Tipo: ',tipos_ofertas.nombre) as text"))
                ->where('ofertas.estado', '=', 1)->where('tipos_ofertas.nombre', 'like', '%' . $search . '%')->get();
        }
        return response()->json($data);
    }

}
