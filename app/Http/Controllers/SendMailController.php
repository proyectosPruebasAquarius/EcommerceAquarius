<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public function send(Request $request)
    {
        $data = collect([
            'name' => $request->name,
            'title' => $request->subject,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        \Mail::to('zerodrieswolf@gmail.com')->send(new \App\Mail\ClientContact($data));

        return back();
    }
}
