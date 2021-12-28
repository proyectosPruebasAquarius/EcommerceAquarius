<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Marca;
use File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $marcas = Marca::select('id','nombre','imagen','estado','created_at')->get();
       return view('backend.marcas.index')->with('marcas',$marcas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.marcas.form')->with('type','add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*
       SUBIDA DE MULTI IMAGENES
       $this->validate($request, [
            'imagen' => 'required',
            'imagen.*' => 'mimes:jpg,png,jif,zip,jpeg,svg'
    ]);


    if($request->hasfile('imagen'))
     {
        foreach($request->file('imagen') as $file)
        {
            $name = time().'.'.$file->extension();
            $file->move(public_path().'/marcas/', $name);
            $data[] = $name;
        }
     }*/
      
        $rules = [
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'nombre' => ['required','max:45']
        ];
        
        $messages = [
            'nombre.required' => 'El nombre de la Marca es Obligatorio.',
            'nombre.max' =>'El nombre de la Marca no puede ser mayor a :max caracteres.', 
            'imagen.required' => 'La Imagen de la Marca es Obligatoria'
        ];
        
        $this->validate($request, $rules, $messages);
           /* $request->validate([
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nombre' => ['required','max:45']
            ]);*/

            $imageName = time().'.'.$request->imagen->extension();

            $request->imagen->move(public_path('storage/imagenes/marcas'), $imageName);
            $marca = new Marca;
            $marca->nombre = $request->nombre;
            $marca->imagen=  $imageName;
            $marca->save();
            return redirect('/admin/marcas');

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
        $id_decryp = Crypt::decrypt($id);
        $marcas = Marca::select('id','nombre','imagen','estado','created_at')->where('id','=',$id_decryp)->get();
        return view('backend.marcas.form')->with('marcas',$marcas)->with('type','edit');
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
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'nombre' => ['required','max:45'],
            'estado' => ['required'],
        ];
        
        $messages = [
            'nombre.required' => 'El nombre de la Marca es Obligatorio.',
            'nombre.max' =>'El nombre de la Marca no puede ser mayor a :max caracteres.', 
            'imagen.required' => 'La Imagen de la Marca es Obligatoria',
            'estado.required' => 'El Estado de la Marca es Obligatorios'
        ];
        
        $this->validate($request, $rules, $messages);
        $id_decryp = Crypt::decrypt($id);
        if ($request->imagen <> null ) {
            $request->validate([
                'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nombre' => ['required','max:200']
            ]);

            $imageName = time().'.'.$request->imagen->extension();

            $request->imagen->move(public_path('storage/imagenes/marcas'), $imageName);
            $image_path = public_path("storage/imagenes/marcas/".$request->imagen_actual);
                if (file_exists($image_path)) {
                        File::delete($image_path);
                }
                Marca::where('id', $id_decryp)
                ->update(['nombre' => $request->nombre,
                    'imagen' => $imageName,
                    'estado' => $request->estado
                    ]);
            return redirect('/admin/marcas');
        } else {
            $request->validate([

                'nombre' => ['required','max:200']
            ]);
            Marca::where('id', $id_decryp)
            ->update(['nombre' => $request->nombre,
                'estado' => $request->estado
                ]);
            return redirect('/admin/marcas');
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id_decryp = Crypt::decrypt($id);
        $marca = Marca::where($id_decryp);
        $image_path = public_path("storage/marcas/".$request->imagen_actual);
        if (file_exists($image_path)) {
                File::delete($image_path);
        }
        $marca->delete();
        return redirect('/admin/marcas');
    }
}
