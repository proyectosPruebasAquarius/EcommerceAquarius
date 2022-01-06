@extends('app')


@section('title',  'Productos')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Productos</li>

@endsection

@section('content')

{{-- <div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Productos</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Inicio</a></li>                    
                    <li>Productos</li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}


<section class="product-grids section">
    @livewire('products-grid-card')
</section>


@endsection