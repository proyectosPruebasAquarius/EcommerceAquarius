<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthResetController extends Controller
{
    public function restore(Request $request) 
    {
     
        $old = $request->old_password;

        $corroborate = User::where('id', auth()->user()->id)->value('password');

        if (Hash::check($old, $corroborate)) {
            // The passwords match...
            User::where('id', auth()->user()->id)->update(['password' => Hash::make($request->password)]);

            return redirect('/')->with('message', 'Contraseña actualizada.');;
        }
        
        return redirect()->back()->with('error', 'La contraseña anterior no coincide con nuestros registros');
        
    }
}
