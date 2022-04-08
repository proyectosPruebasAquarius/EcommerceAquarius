@extends('app')

@section('title', 'Lista de Deseos')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Lista de Deseos</li>
@endsection

@section('content')
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-12 text-start">
            <h3><i class="far fa-heart"></i> Lista de Deseos</h3>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="card w-100 shadow">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-12">
                            <a type="button" href="{{ route('productos') }}" class="btn btn-outline-primary rounded btn-lg">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @livewire('preview-wishlist')                                                                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection