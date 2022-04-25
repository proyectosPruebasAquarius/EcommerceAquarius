<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WishList extends Component
{

    public function save()
    {
        try {
            $wishList = new Wishlist();
            $wishList->id_user = $request->id_user;
            $wishList->id_producto = $request->id_producto;
            $wishList->save();
        } catch (\Exception $e) {
            //throw $th;
        }
    }
    
    public function render()
    {
        return view('livewire.wish-list');
    }
}
