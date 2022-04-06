<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategoria;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subc =  SubCategoria::join('categorias','categorias.id','=','sub_categorias.id_categoria')->select('categorias.nombre as categoria',
        'sub_categorias.nombre','sub_categorias.id as id_sub')->get();



        return view('backend.sub-categorias.index')->with('subc',$subc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sub-categorias.form')->with('type','add');
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
        return redirect('admin/sub-categorias')->with('message','Nueva sub categoria guardada.')->with('alert','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_decrypt = Crypt::decrypt($id);
        $subc =  SubCategoria::join('categorias','categorias.id','=','sub_categorias.id_categoria')->select('categorias.nombre as categoria',
        'sub_categorias.nombre','sub_categorias.id as id_sub','categorias.id as id_categoria')->where('sub_categorias.id',$id_decrypt)->get();

        return view('backend.sub-categorias.form')->with('subc',$subc)->with('type','edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        
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
        $id_decrypt = Crypt::decrypt($id);
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

        try {
            SubCategoria::where('id', '=', $id_decrypt)->update([
                'nombre' => $request->nombre,
                'id_categoria' => $request->categoria
            ]);
            
            return redirect('admin/sub-categorias')->with('message','Sub categoria actulizada.')->with('alert','success');
        } catch (\Throwable $th) {
            return redirect('admin/sub-categorias')->with('message','Ocurrio un error al eliminar la sub categoria, intenta nuevamente.')->with('alert','warning');
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
        try {
            SubCategoria::where('id',$id_decrypt)->delete();
            return redirect('admin/sub-categorias')->with('message','Sub categoria eliminada.')->with('alert','success');
        } catch (\Throwable $th) {
            return redirect('admin/sub-categorias')->with('message','Ocurrio un error al eliminar la sub categoria.')->with('alert','warning');
        }
       
    }
}
