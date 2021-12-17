<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Producto;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::select('id','nombre','direccion','telefono','nombre_contacto','tel_contacto','estado')->get();
        return view('backend.proveedores.index')->with('proveedores',$proveedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.proveedores.form')->with('type','add');
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
            'direccion' => ['required','max:500'],
            'telefono' => ['required','numeric'],
            'contacto' => ['required'],
            'telcontacto' => ['required','numeric'],
            
        ];
        
        $messages = [
            'contacto.required' => 'Nombre del Contacto es Obligatorio.',
            'contacto.max' =>'El nombre del Proveedor no puede ser mayor a :max caracteres.',
            'nombre.required' => 'Nombre del Proveedor es Obligatorio.',
            'nombre.max' =>'El nombre del Proveedor no puede ser mayor a :max caracteres.',
            'direccion.required' => 'La Dirección del Proveedor es Obligatoria.',
            'direccion.max' =>'La Dirección del Proveedor no puede ser mayor a :max caracteres.',
            'telefono.required' => 'El Numeró de Teléfono del Proveedor es Obligatorio.',
            'telefono.numeric' => 'El Numeró de Teléfono del Proveedor debe ser un número',
            'telcontacto.required' => 'El Numeró de Teléfono del Contacto es Obligatorio.',
            'telcontacto.numeric' => 'El Numeró de Teléfono del Contacto debe ser un número',
            
        ];
        $this->validate($request, $rules, $messages);



        $proveedor = new Proveedor;
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->nombre_contacto = $request->contacto;
        $proveedor->tel_contacto = $request->telcontacto;
        $proveedor->save();
        return redirect('admin/proveedores')->with('message','Proveedor Guardado Correctamente')->with('alert','success');
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
        $proveedor = Proveedor::where('id','=',$id_decrypt)->select('id','nombre','direccion','telefono','nombre_contacto','tel_contacto','estado')->get();
        return view('backend.proveedores.form')->with('proveedores',$proveedor)->with('type','edit');
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
            'direccion' => ['required','max:500'],
            'telefono' => ['required','numeric'],
            'contacto' => ['required'],
            'telcontacto' => ['required','numeric'],
            'estado' => ['required'],
        ];
        
        $messages = [
            'contacto.required' => 'Nombre del Contacto es Obligatorio.',
            'contacto.max' =>'El nombre del Proveedor no puede ser mayor a :max caracteres.',
            'nombre.required' => 'Nombre del Proveedor es Obligatorio.',
            'nombre.max' =>'El nombre del Proveedor no puede ser mayor a :max caracteres.',
            'direccion.required' => 'La Dirección del Proveedor es Obligatoria.',
            'direccion.max' =>'La Dirección del Proveedor no puede ser mayor a :max caracteres.',
            'telefono.required' => 'El Numeró de Teléfono del Proveedor es Obligatorio.',
            'telefono.numeric' => 'El Numeró de Teléfono del Proveedor debe ser un número',
            'telcontacto.required' => 'El Numeró de Teléfono del Contacto es Obligatorio.',
            'telcontacto.numeric' => 'El Numeró de Teléfono del Contacto debe ser un número',
            'estado.required' => 'El estado del Proveedore es Obligatorio'
        ];
        $this->validate($request, $rules, $messages);

        $id_decryp = Crypt::decrypt($id);
        Proveedor::where('id', $id_decryp)
            ->update(['nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono'=> $request->telefono,
                'nombre_contacto' => $request->contacto,
                'tel_contacto' =>$request->telcontacto,
                'estado' => $request->estado
                ]);
            return redirect('/admin/proveedores')->with('message','Proveedor Actualizado Correctamente')->with('alert','success');
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
        $proveedor = Proveedor::where($id_decryp);
        $productoVerify = Producto::where('id_categoria','=',$id_decryp)->get();
        
        if ( sizeof($productoVerify) == 0) {
            $proveedor->delete();
            return redirect('/admin/proveedores')->with('message','Proveedor Eliminado')->with('alert','success');
           
        
        } else {
            return redirect('/admin/proveedores')->with('message','No se puede eliminar este proveedor. Tiene productos en dependencia')->with('alert','warning');
        }
       
    }
}
