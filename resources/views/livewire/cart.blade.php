@extends('app')

@section('title',  'Carrito')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item"><a href="{{ route('productos') }}">Productos</a></li>
<li class="breadcrumb-item active" aria-current="page">Carrito</li>

@endsection
@section('content')
        
    {{-- <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Carrito</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Inicio</a></li>
                        <li><a href="{{ route('productos') }}">Productos</a></li>
                        <li>Carrito</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}


    @livewire('cart-section')
@endsection