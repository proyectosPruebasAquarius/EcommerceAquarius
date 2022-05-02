<?php

namespace App\Http\Livewire;

use App\CuentaEliminada;
use \Illuminate\Support\Facades\URL;
use Livewire\Component;

class GenerateTrashUri extends Component
{
    public $whileMount = true;
    public $url;
    public $email;

    protected $listeners = ['assignMail'];
    
    public function assignMail($mail)
    {
        $this->email = $mail;
    }
    public function willMount()
    {
        sleep(1);
        $this->url = URL::signedRoute(
            'eliminar.cuenta', 
            /* now()->addMinutes(10), */
            ['email' => $this->email]
        );

        $this->whileMount = false;
    }

    public function confirmURI()
    {

        try {
            $details = collect([
    
                'title' => 'Ingresa a la siguiente dirección para confirmar la elimación de tú cuenta',
        
                'url' => $this->url
        
            ]);
                   
            \Mail::to($this->email)->send(new \App\Mail\DeleteAccount($details));

            CuentaEliminada::join('users', 'users.id', '=', 'cuentas_eliminadas.id_user')->where('users.email', $this->email)->update([
                'was_email_send' => 1,
                'email_url_date' => now(),
            ]);
    
            $this->dispatchBrowserEvent('close-urimodal');
        } catch (\Exception $e) {
            //throw $th;
            \Debugbar::info($e->getMessage());
        }
        
    }

    public function render()
    {
        return view('livewire.generate-trash-uri');
    }
}
