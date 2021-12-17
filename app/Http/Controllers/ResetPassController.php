<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\User;
use Illuminate\Support\Facades\Hash;

class ResetPassController extends Controller
{

    public function index() 
    {

        return view('frontend.forget');
    }

    /* public function changePassword()
    {
        $url = URL::temporarySignedRoute(
            'pass.reset', 
            now()->addMinutes(1),
            ['email' => 'example@example.com']
        );

        return $url;
    } */

    public function changePassword(Request $request)
    {
        $email = $request->email;

        $corroborate = User::where('email', $email)->get();

        
        if (count($corroborate) > 0) {
            # code...
            $url = URL::temporarySignedRoute(
                'pass.reset', 
                now()->addMinutes(10),
                ['session' => $email]
            );
    
            $details = collect([
    
                'title' => 'Mail por example.com',
        
                'body' => 'Ingresa a la siguiente dirección para cambiar tú contraseña '.$url
        
            ]);
                   
            \Mail::to($email)->send(new \App\Mail\ForgetMail($details));
                   
            //dd("Email is Sent.");
    
            return back()->with('message', 'Verifica tú correo electronico.');
        }
        return back()->with('error', 'El correo ingresado no existe en nuestra base de datos');
        
    }

    public function updatePassword(Request $request, $session)
    {
        if (! $request->hasValidSignature()) {
            abort(403);
        }

        return view('frontend.restore')->with('email', $session);
    }

    public function resetPassword(Request $request, $email) 
    {
        
        $user = User::where('email', $email)->update(['password' =>  Hash::make($request->password)]);
        /* $user->password = Hash::make($request->password)
        $user */

        return redirect('/')->withMessage('Password updated');
    }

    public function restore(Request $request) 
    {
     
        $old = $request->old_password;

        $corroborate = User::where('id', auth()->user()->id)->value('password');

        return $corroborate;

       // return redirect()->back()->with('error', 'La contraseña anterior no coincide con nuestros registros');
        
    }
}
