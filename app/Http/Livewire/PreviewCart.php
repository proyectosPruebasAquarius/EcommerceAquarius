<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PreviewCart extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];
    
    public function removeCart($id)
    {
        
          \Cart::remove($id);
  
          session()->flash('success', 'Item has removed !');
    }

    public function render()
    {
        $test = \Cart::getContent()->toArray();
        $ccart = array_multisort(array_map(function($element) {
            return $element['attributes']['unid'];
        }, $test), SORT_DESC, $test);;

        /* foreach ($variable as $key => $value) {
            # code...
        } */
       /* \Debugbar::info($test);*/
        /* $this->cartItems = \Cart::getContent()->toArray(); */
        $this->cartItems = $test;
        
        return view('livewire.preview-cart');
    }
}
