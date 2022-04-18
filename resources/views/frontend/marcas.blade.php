@extends('app')

@section('title', 'Marcas')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Marcas</li>
@endsection

@section('content')
    <section>
        <div class="brands">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                        <h2 class="title">Marcas Populares</h2>
                    </div>
                </div>
                <div class="brands-logo-wrapper">
                    <div class="brands-logo-carousel d-flex align-items-center justify-content-between">
    
                        @forelse($marcas as $marca)
                        <div class="brand-logo">
                            {{-- <img src="{{asset('storage/imagenes/marcas/')}}/{{$marca->imagen}}" alt="Imagenes de marcas"> --}}
                            <h5 class="text-center">{{ $marca->nombre }}</h5>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        'use strict';
        tns({
        container: '.brands-logo-carousel',
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 15,
        nav: false,
        controls: false,
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 3,
            },
            768: {
                items: 5,
            },
            992: {
                items: 6,
            }
        }
    });
    </script>
@endpush