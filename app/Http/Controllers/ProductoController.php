<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Marca;
use App\SubCategoria;
use File;
use App\Proveedor;
use App\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $productos = Producto::join('marcas','marcas.id','=','productos.id_marca')
       ->join('categorias','categorias.id','=','productos.id_categoria')
       ->join('proveedores','proveedores.id','=','productos.id_proveedor')
       ->join('sub_categorias','sub_categorias.id','=','productos.id_subcat')
       ->select('productos.id as id','productos.nombre','productos.imagen','productos.descripcion',
       'categorias.nombre as categoria','marcas.nombre as marca','proveedores.nombre as proveedor',
       'sub_categorias.nombre as sub_categoria')
       ->get();
        return view('backend.productos.index')->with('productos',$productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.productos.form')->with('type','add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       // return $request->all();
        $rules = [
            'imagen' => 'required|array',
            'imagen.*' =>'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'nombre' => ['required','max:200'],
            'descripcion' => ['required','max:1500'],
            'categoria' => ['required'],
            'marca' => ['required'],
            'proveedor' => ['required'],
            'subcat' => ['required'],
        ];

        $messages = [
            'nombre.required' => 'Nombre del Producto es Obligatorio.',
            'nombre.max' =>'El nombre del Producto no puede ser mayor a :max caracteres.',
            'descripcion.required' => 'La Descripción del Producto es Obligatoria.',
            'descripcion.max' =>'La Descripción del Producto no puede ser mayor a :max caracteres.',
            'categoria.required' => 'La Categoria es Obligatoria.',
            'marca.required' => 'La Marca es Obligatoria.',
            'proveedor.required' => 'El Proveedor es Obligatorio.',
            'subcat.required' => 'La Sub Categoria es Obligatoria.',
            'imagen.required' => 'La Imagen del Producto es Obligatoria',
            'imagen.*' => 'Las Imagenes deben contener estas extenciones(jpeg,png,jpg,gif,svg,webp)'

        ];
        $this->validate($request, $rules, $messages);
        $data = [];
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->id_categoria = $request->categoria;
        $producto->id_marca = $request->marca;
        $producto->id_proveedor = $request->proveedor;
        $producto->id_subcat = $request->subcat;
        if($request->hasfile('imagen'))
         {
            $numItems = count($request->file('imagen'));
            $i = 0;
            foreach($request->file('imagen') as $image)
            {
                $path = $image->store('public/imagenes/productos');
                $url = Storage::url($path);

                $data[] = $url;
                if(++$i === $numItems) {
                    $producto->imagen = json_encode($data);
                    $producto->save();
                    return redirect('admin/productos')->with('message','Producto Guardado')->with('alert','success');
                }
            }
         }






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

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
        $producto = Producto::join('marcas','marcas.id','=','productos.id_marca')
        ->join('categorias','categorias.id','=','productos.id_categoria')
        ->join('proveedores','proveedores.id','=','productos.id_proveedor')
        ->join('sub_categorias','sub_categorias.id','=','productos.id_subcat')
        ->where('productos.id','=',$id_decrypt)
        ->select('productos.id as id','productos.nombre','productos.imagen','productos.descripcion',
        'categorias.nombre as categoria','categorias.id as id_categoria','marcas.nombre as marca',
        'marcas.id as id_marca','proveedores.nombre as proveedor','proveedores.id as id_proveedor',
        'sub_categorias.id as id_subcategoria','sub_categorias.nombre as subcat')
        ->get();

      return  view('backend.productos.form')->with('type','edit')->with('productos',$producto);
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
            'imagen' => 'required|array',
            'imagen.*' =>'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'nombre' => ['required','max:200'],
            'descripcion' => ['required','max:1500'],
            'categoria' => ['required'],
            'marca' => ['required'],
            'proveedor' => ['required'],
            'subcat' => ['required'],
        ];

        $messages = [
            'nombre.required' => 'Nombre del Producto es Obligatorio.',
            'nombre.max' =>'El nombre del Producto no puede ser mayor a :max caracteres.',
            'descripcion.required' => 'La Descripción del Producto es Obligatoria.',
            'descripcion.max' =>'La Descripción del Producto no puede ser mayor a :max caracteres.',
            'categoria.required' => 'La Categoria es Obligatoria.',
            'marca.required' => 'La Marca es Obligatoria.',
            'proveedor.required' => 'El Proveedor es Obligatorio.',
            'subcat.required' => 'La Sub Categoria es Obligatoria.',
            'imagen.required' => 'La Imagen del Producto es Obligatoria',
            'imagen.*.image' => 'El archivo debe ser Imagen',
            'imagen.*.mimes' => 'Las Imagenes deben contener estas extenciones(jpeg,png,jpg,gif,svg,webp)'

        ];
        $id_decrypt = Crypt::decrypt($id);

        $producto = Producto::where('id','=',$id_decrypt)->first();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->id_categoria = $request->categoria;
        $producto->id_marca = $request->marca;
        $producto->id_proveedor = $request->proveedor;
        $producto->id_subcat = $request->subcat;
        if ($request->imagen <> null ) {
            $productoValidateImg = Producto::select('imagen')->where('id','=',$id_decrypt)->get();
            foreach ($productoValidateImg as $pro) {
             foreach (json_decode($pro->imagen) as $p) {
                 $image_path = public_path($p);
                 if (file_exists($image_path)) {
                    File::delete($image_path);
                 }
                }
          }

          if($request->hasfile('imagen'))
            {
               $numItems = count($request->file('imagen'));
               $i = 0;
               foreach($request->file('imagen') as $image)
               {
                   $path = $image->store('public/imagenes/productos');
                   $url = Storage::url($path);

                   $data[] = $url;
                   if(++$i === $numItems) {
                       $producto->imagen = json_encode($data);
                       $producto->save();
                       return redirect('admin/productos')->with('message','Producto Actualizado')->with('alert','success');
                   }
               }
            }


        }else{
            $producto->save();
            return redirect('admin/productos')->with('message','Producto Actualizado')->with('alert','success');
        }



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
        $InventoryVerify = Inventario::where('id_producto','=',$id_decrypt)->get();

        if (sizeof($InventoryVerify) == 0) {
            Producto::where('id','=',$id_decrypt)->delete();
            $productoValidateImg = Producto::select('imagen')->where('id','=',$id_decrypt)->get();
            foreach ($productoValidateImg as $pro) {
             foreach (json_decode($pro->imagen) as $p) {
                 $image_path = public_path($p);
                 if (file_exists($image_path)) {
                    File::delete($image_path);
                 }
                }
          }
            return redirect('admin/productos')->with('message','Producto Eliminado Correctamente')->with('alert','success');
        } else {

            return redirect('admin/productos')->with('message','El producto no se puede eliminar por que hay inventarios relacionados')->with('alert','warning');
        }

    }


    public function selectmarca(Request $request)
    {
        $data = [];

        if($request->q == null){

            $data = Marca::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->get();

        }else{
            $search = $request->q;
            $data = Marca::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->where('nombre','like','%'.$search.'%')->get();
        }

        return response()->json($data);
    }
    public function selectproveedor(Request $request)
    {
        $data = [];

        if($request->q == null){

            $data = Proveedor::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->get();

        }else{
            $search = $request->q;
            $data = Proveedor::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->where('nombre','like','%'.$search.'%')->get();
        }

        return response()->json($data);
    }



    public function selectsubcat(Request $request)
    {
        $data = [];

        if($request->q == null){

            $data = SubCategoria::orderby('nombre','asc')->select('id','nombre as text')->get();

        }else{
            $search = $request->q;
            $data = SubCategoria::orderby('nombre','asc')->select('id','nombre as text')->where('nombre','like','%'.$search.'%')->get();
        }

        return response()->json($data);
    }


}
