<?php

namespace App\Http\Controllers;

use App\MetodoPago;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use File;
class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metodos = MetodoPago::get();
        return view('backend.metodos.index')->with('metodos',$metodos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.metodos.form')->with('type','add');
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
            'qr' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->qr->extension();

        $request->qr->move(public_path('storage/imagenes/pagos'), $imageName); */

        $rules = [
            
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'nombre' => ['required','max:100'],
            'numero' => ['required'],
            'cuenta_asociado' =>['required']
        ];
        
        $messages = [
            'nombre.required' => 'El nombre de Tipo de pago es Obligatorio.',
            'nombre.max' =>'El nombre de Tipo de pago no puede ser mayor a :max caracteres.',
            'cuenta_asociado.required' => 'Nombre del Asociado a la Cuenta es Obligatorio',
            'numero.required' => 'Número de Cuenta Bancaria, Célular o Bitcoin es Obligatorio.',
            'imagen.required' => 'La Imagen QR es Obligatoria'
            
        ];
        
        $this->validate($request, $rules, $messages);



        $pago = new MetodoPago;
        $pago->nombre = $request->nombre;
        
        /* $pago->qr=  $imageName; */
        $pago->numero = $request->numero;
        $pago->cuenta_asociado = $request->cuenta_asociado;        
        if ($request->hasfile('qr')) {
            $numItems = count($request->file('qr'));
            $i = 0;

            foreach($request->file('qr') as $image)
            {
                $path = $image->getClientOriginalName();
                $image->move(public_path().'/storage/imagenes/qr/', $path);  
                /* $url = Storage::url($path); */
        
                $data[] = $path;  
                if(++$i === $numItems) {
                    $pago->qr = json_encode($data);
                    $pago->save();
                    return redirect('admin/metodos_pagos')->with('message','Método de Pago Guardado Correctamente')->with('alert','success');
                }
            }

        }
        /* return redirect('/admin/metodos_pagos'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function show(MetodoPago $metodoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_decryp =  Crypt::decrypt($id);
        $metodo = MetodoPago::where('id',$id_decryp)->select('id','nombre','qr','numero','cuenta_asociado','estado')->get();
        return view('backend.metodos.form')->with('type','edit')->with('metodo',$metodo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'nombre' => ['required','max:100'],
            'numero' => ['required'],
            'cuenta_asociado' =>['required'],
            'estado' => ['required']
        ];
        
        $messages = [
            'nombre.required' => 'El nombre de Tipo de pago es Obligatorio.',
            'nombre.max' =>'El nombre de Tipo de pago no puede ser mayor a :max caracteres.',
            'cuenta_asociado.required' => 'Nombre del Asociado a la Cuenta es Obligatorio',
            'numero.required' => 'Número de Cuenta Bancaria, Célular o Bitcoin es Obligatorio.',
            'estado.required' => 'El Estado del Metodo de Pago es Obligatorio',
            'imagen.required' => 'La Imagen QR es Obligatoria'
        ];
        
        $this->validate($request, $rules, $messages);
        $id_decrypt = Crypt::decrypt($id);
        $imagenes_anteriores = json_decode($request->imagen_actual);
        
        if ($request->qr == null) {
            MetodoPago::where('id','=',$id_decrypt)->update([

                'nombre' => $request->nombre,
                'numero' =>$request->numero,
                'cuenta_asociado' => $request->cuenta_asociado,
                'estado' => $request->estado
    
            ]);
            return redirect('admin/metodos_pagos')->with('message','Método de Pago Actualizado Correctamente')->with('alert','success');
        }else{
            foreach($imagenes_anteriores as $img) {
                $image_path = public_path("storage/imagenes/qr/".$img);
                if (file_exists($image_path)) {
                        File::delete($image_path);
                }
            }
            if ($request->hasfile('qr')) {
                $numItems = count($request->file('qr'));
                $i = 0;
    
                foreach($request->file('qr') as $image)
                {
                    $path = $image->getClientOriginalName();
                    $image->move(public_path().'/storage/imagenes/qr/', $path);  
                    /* $url = Storage::url($path); */
            
                    $data[] = $path;  
                    if(++$i === $numItems) {
                        MetodoPago::where('id','=',$id_decrypt)->update([

                            'nombre' => $request->nombre,
                            'numero' =>$request->numero,
                            'cuenta_asociado' => $request->cuenta_asociado,
                            'estado' => $request->estado,
                            'qr'=> json_encode($data)
                
                        ]);
                        return redirect('admin/metodos_pagos')->with('message','Método de Pago Actualizado Correctamente')->with('alert','success');
                    }
                }
    
            }
            
        }       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MetodoPago  $metodoPago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id_decrypt = Crypt::decrypt($id);
        $imagenes_anteriores = json_decode($request->imagen_actual);
       //return $imagenes_anteriores;
        
        foreach($imagenes_anteriores as $img) {
            $image_path = public_path("storage/imagenes/qr/".$img);
            if (file_exists($image_path)) {
                    File::delete($image_path);
            }
        }
        MetodoPago::where('id',$id_decrypt)->delete();
        return redirect('admin/metodos_pagos')->with('message','Método de Pago Eliminado Correctamente')->with('alert','success');
    }
}
