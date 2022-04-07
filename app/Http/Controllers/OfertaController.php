<?php

namespace App\Http\Controllers;
use App\Oferta;
use App\TipoOferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tiposofertas = TipoOferta::select('id','nombre','estado')->get();
        $ofertas = TipoOferta::join('ofertas','ofertas.id_tipo_oferta','=','tipos_ofertas.id')->select('ofertas.id as id_oferta','ofertas.nombre','tipos_ofertas.nombre as tipo_oferta','ofertas.tiempo_limite','ofertas.created_at as fecha','ofertas.estado')->get();
        return view('backend.ofertas.index')->with('tiposofertas',$tiposofertas)->with('ofertas',$ofertas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ofertas.form')->with('type','add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* $request->validate([
            'limite' => ['required'],
            'nombre' => ['required','max:200'],
            'tipo_oferta' => ['required']
        ]);*/
        $rules = [
            'limite' => ['required'],
            'nombre' => ['required','max:200'],
            'tipo_oferta' => ['required']
        ];
        
        $messages = [
            'nombre.required' => 'Nombre de la Oferta es Obligatorio.',
            'nombre.max' =>'El nombre de la oferta no puede ser mayor a :max caracteres.',
            'tipo_oferta.required' => 'El tipo de oferta es Obligatorio.',
            'limite.required' => 'La fecha limite es Obligatoria',
            
        ];
        
        $this->validate($request, $rules, $messages);

       $oferta = new Oferta;
       $oferta->nombre = $request->nombre;
       $oferta->id_tipo_oferta = $request->tipo_oferta;
       $oferta->tiempo_limite = $request->limite;
       $oferta->save();
       return redirect('/admin/ofertas')->with('message','Oferta agregada correctamente')->with('alert','success');
     
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
        $id_decrypt = Crypt::decrypt($id);
        $ofertas = TipoOferta::join('ofertas','ofertas.id_tipo_oferta','=','tipos_ofertas.id')
        ->select('ofertas.id as id_oferta','ofertas.nombre','tipos_ofertas.nombre as tipo_oferta','tipos_ofertas.id as id_tipo_oferta','ofertas.tiempo_limite','ofertas.created_at as fecha','ofertas.estado')
        ->where('ofertas.id','=',$id_decrypt)
        ->get();
        return view('backend.ofertas.form')->with('type','edit')->with('ofertas',$ofertas);
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
            'limite' => ['required'],
            'nombre' => ['required','max:200'],
            'tipo_oferta' => ['required'],
            'estado'=> ['required']
        ];
        
        $messages = [
            'nombre.required' => 'Nombre de la Oferta es Obligatorio.',
            'nombre.max' =>'El nombre de la oferta no puede ser mayor a :max caracteres.',
            'tipo_oferta.required' => 'El tipo de oferta es Obligatorio.',
            'limite.required' => 'La fecha limite es Obligatoria',
            'estado.required' => 'El Estado de la Oferta es Obligatorio'
        ];
        $id_decrypt = Crypt::decrypt($id);
        Oferta::where('ofertas.id','=',$id_decrypt)->update([

            'nombre' => $request->nombre,
            'id_tipo_oferta' =>$request->tipo_oferta,
            'tiempo_limite' => $request->limite,
            'estado' => $request->estado

        ]);

        return redirect('admin/ofertas')->with('message','Oferta Actualizada Correctamente')->with('alert','success');
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
        Oferta::where('ofertas.id','=',$id_decrypt)->delete();
        return redirect('admin/ofertas')->with('message','Oferta Eliminada Correctamente')->with('alert','success');
    }







    public function createType()
    {
        return view('backend.ofertas.tipos.form')->with('type','add');
    }
    public function saveType(Request $request)
    {
        $rules = [
           
            'nombre' => ['required','max:200'],
            
        ];
        
        $messages = [
            'nombre.required' => 'Nombre del Tipo de Oferta es Obligatorio.',
            'nombre.max' =>'El nombre del Tipo de Oferta no puede ser mayor a :max caracteres.',
            
        ];
        $tipos = new TipoOferta;
        $tipos->nombre = $request->nombre;
        $tipos->save();
        return redirect('/admin/ofertas')->with('message','Tipo de oferta agregado correctamente')->with('alert','success');
    }

    public function editType($id)
    {

        $id_decrypt = Crypt::decrypt($id);

        $tipo = TipoOferta::select('id','nombre','estado')->where('id',$id_decrypt)->get();
        return view('backend.ofertas.tipos.form')->with('type','edit')->with('tipos',$tipo);
    }

    public function updateType(Request $request, $id)
    {
        $rules = [
           
            'nombre' => ['required','max:200'],
            'estado' => ['required','max:200'],
        ];
        
        $messages = [
            'nombre.required' => 'Nombre del Tipo de Oferta es Obligatorio.',
            'nombre.max' =>'El nombre del Tipo de Oferta no puede ser mayor a :max caracteres.',
            'estado.required' => 'El Estado del Tipo de Oferta es Obligatorio '
        ];
        $id_decrypt = Crypt::decrypt($id);
        TipoOferta::where('tipos_ofertas.id','=',$id_decrypt)->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado
        ]);

        return redirect('admin/ofertas')->with('message','Tipo de Oferta Actualizada Correctamente')->with('alert','success');
    }

    public function destroyType($id)
    {
        $id_decrypt = Crypt::decrypt($id);
        
        $ofertVerify = Oferta::where('id_tipo_oferta','=',$id_decrypt)->get();
        if ( sizeof($ofertVerify) == 0) {
            TipoOferta::where('tipos_ofertas.id','=',$id_decrypt)->delete();
            return redirect('admin/ofertas')->with('message','Tipo de Oferta Eliminada Correctamente')->with('alert','success');
        } else {
            return redirect('admin/ofertas')->with('message','No se pudo eliminar el registro. Existen mas datos dependientes de este registro')->with('alert','warning');
        }
          
    }

    public function selectTipoOferta(Request $request)
    {
        $data = [];

        if($request->q == null){
           
            $data = TipoOferta::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->get();
          
        }else{
            $search = $request->q;
            $data = TipoOferta::orderby('nombre','asc')->select('id','nombre as text')->where('estado','=',1)->where('nombre','like','%'.$search.'%')->get();
        }
        
        return response()->json($data);
    }


}
