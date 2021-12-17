<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Review;

class LoadMoreReviews extends Component
{
    public $limitPerPage = 5;
    public $data; 

    protected $listeners = [
        'load-more' => 'loadMore',
        'load-less' => 'loadLess'
    ];
   
    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function loadLess()
    {
        $this->limitPerPage = $this->limitPerPage - 6;
    }

    public function render()
    {

        //$data = decrypt(request('id'));
        
        if (auth()->check()) {
            
            $coments = Review::join('users', 'users.id', '=', 'opiniones.id_usuario')->select('opiniones.*', 'users.image', 'users.name')
            ->whereNotIn('opiniones.id_usuario', [auth()->user()->id])->where('opiniones.id_producto', $this->data)->latest()->simplePaginate($this->limitPerPage);

        } else {
            $coments = Review::join('users', 'users.id', '=', 'opiniones.id_usuario')->select('opiniones.*', 'users.image', 'users.name')
            ->where('opiniones.id_producto', $this->data)->latest()->simplePaginate($this->limitPerPage);
        }

       // $coments = Review::latest()->paginate($this->limitPerPage);
        //$this->emit('userStore');

        return view('livewire.load-more-reviews', ['coments' => $coments]);
    }
}
