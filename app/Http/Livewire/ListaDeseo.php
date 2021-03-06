<?php

namespace App\Http\Livewire;

use App\WishList;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ListaDeseo extends Component
{
    use LivewireAlert;
    public $id_user = 1; 
    public $id_producto;
    public $isActive = false;
    public $corroborate = [];
    protected $listeners = ['wishlistEdit' => 'save'];

    protected $rules = [

        'id_user' => 'required',

        'id_producto' => 'required',

    ];

    public function save()
    {
        
        try {
            $this->validate();
            $this->id_user = auth()->user()->id;
            $wishList = new WishList();
            $data = Wishlist::where([
                ['id_producto', $this->id_producto],
                ['id_user', auth()->user()->id]
            ])->first();
            $message;

            if ($data) {
                $this->isActive = false;
                $wishList->where([
                    ['id_producto', $this->id_producto],
                    ['id_user', auth()->user()->id]
                ])->delete();
                $message = 'Eliminado de lista de deseos';
            } else {                
                $this->isActive = true;
                $wishList->id_user = $this->id_user;
                $wishList->id_producto = $this->id_producto;
                $wishList->save();
                $message = 'Agregado a lista de deseos';
                
            }
            $this->alert('success', $message);
        } catch (\Exception $e) {
            //throw $th;

            $this->alert('error', 'Ocurrió un error inesperado');
        }
    }

    public function render()
    {
        $this->corroborate = WishList::where([
            ['id_producto', $this->id_producto],
            ['id_user', auth()->user()->id]
        ])->first();

        return view('livewire.lista-deseo');
    }
}
