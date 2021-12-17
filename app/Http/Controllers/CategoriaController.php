<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\SubCategoria;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categorias = Categoria::select('id','nombre','estado')->get();
       return view('backend.categorias.index')->with('categorias',$categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categorias.form')->with('type','add');
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
            'nombre' => ['required','max:200']
        ];
        
        $messages = [
            'nombre.required' => 'El nombre de la Categoria es Obligatorio.',
            'nombre.max' =>'El nombre de la Categoria no puede ser mayor a :max caracteres.', 
        ];
        
        $this->validate($request, $rules, $messages);

       $newcategoria = new Categoria;
       $newcategoria->nombre = $request->nombre;
       $newcategoria->save();
       return redirect('/admin/categorias')->with('message','Categoria Guardada Correctamente')->with('alert','success');;
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
       $id_decrypted = Crypt::decrypt($id);
       $categoria = Categoria::select('id','nombre','estado')->where('id','=',$id_decrypted)->get();

       return view('backend.categorias.form')->with('categorias',$categoria)->with('type','edit');
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
            'nombre' => ['required','max:200'],
            'estado' => 'required',
        ];
        
        $messages = [
            'nombre.required' => 'El nombre de la Categoria es Obligatorio.',
            'nombre.max' =>'El nombre de la Categoria no puede ser mayor a :max caracteres.', 
            'estado.required' => 'El Estado de la Categoria es Obligatorio'
        ];
        
        $this->validate($request, $rules, $messages);
        $id_decryp = Crypt::decrypt($id);
        Categoria::where('id', $id_decryp)
            ->update(['nombre' => $request->nombre,
                'estado' => $request->estado
                ]);
            return redirect('/admin/categorias')->with('message','Categoria Actualizada Correctamente')->with('alert','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_decryp = Crypt::decrypt($id);
        $categoria = Categoria::where($id_decryp);
        $categoriaVerify = SubCategoria::where('id_categoria','=',$id_decryp)->get();
        
        if ( sizeof($categoriaVerify) == 0) {
            $categoria->delete();
            return redirect('/admin/categorias')->with('message','Categoria Eliminada')->with('alert','success');
           
        
        } else {
            return redirect('/admin/categorias')->with('message','Esta Categoria No se puede eliminar. Tiene sub categorias en dependencia')->with('alert','warning');
        }
       
    }
    public function subcat()
    {
        return view('backend.categorias.form')->with('type','add-sub');
    }
    public function savesubcat(Request $request)
    {
        

        $rules = [
            'nombre' => ['required','max:200'],
            'categoria' => ['required'],
        ];
        
        $messages = [
            'nombre.required' => 'El nombre de la Sub Categoria es Obligatorio.',
            'nombre.max' =>'El nombre de la Sub Categoria no puede ser mayor a :max caracteres.', 
            'categoria.required' => 'La Cateogria es Obligatoria.'
        ];
        
        $this->validate($request, $rules, $messages);


        $subcat = new SubCategoria;
        $subcat->nombre = $request->nombre;
        $subcat->id_categoria = $request->categoria;
        $subcat->save();
        return redirect('admin/categorias');
    }



    public function selectCategoria(Request $request)
    {
       
        $data = [];

        if($request->q == null){
           
            $data = Categoria::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->get();
          
        }else{
            $search = $request->q;
            $data = Categoria::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->where('nombre','like','%'.$search.'%')->get();
        }
        
        return response()->json($data);
        
     }


   

       
    
}
