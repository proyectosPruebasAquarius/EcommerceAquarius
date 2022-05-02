<?php

namespace App\Http\Livewire;

use Livewire\Component;
use\App\{CuentaEliminada, User};
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;

class TrashUser extends Component
{
    use LivewireAlert;
    public $email;

    protected $listeners = [
        'confirmed'
    ];

    public function acceptTrash()
    {

        $this->alert('question', '¿Estas seguro que deseas eliminar tú cuenta?', [
            'position' => 'center',
            'timer' => '',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Estoy de Acuerdo',
            'onConfirmed' => 'confirmed' 
        ]);

        
    }

    public function confirmed()
    {
        DB::transaction(function () {
            CuentaEliminada::join('users', 'users.id', '=', 'cuentas_eliminadas.id_user')->where('users.email', $this->email)->update([
                'acepto_terminos' => 1,
            ]);

            User::where('email', $this->email)->update([
                'estado' => 1,
            ]);
        });

        Auth::logout();
        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.trash-user');
    }
}
