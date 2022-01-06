@extends('app')

@section('title',  'Ubicación')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Nuestra Ubicación</li>

@endsection

@section('content')

{{-- <div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Ubicación</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Inicio</a></li>                    
                    <li>Nuestra Ubicación</li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}
<!-- End Breadcrumbs -->

<div class="container">
    
    <div class="card mx-auto shadow-lg rounded-3 mt-5 mb-5">      
      <div class="card-body">
        <h4 class="card-title">Nuestra Ubicación</h4>
        
        
    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin enim elit, tempor nec mattis eu, scelerisque in dui. Integer consectetur porttitor libero ac scelerisque. Nunc commodo efficitur turpis, eu condimentum lectus pellentesque et. Quisque congue ligula lacus, id feugiat urna venenatis in. Morbi eu interdum augue. Curabitur nec justo nulla. Pellentesque vitae vulputate neque. Cras nec tincidunt lacus. Curabitur a bibendum massa. Phasellus vel odio urna. Fusce nisl sapien, dapibus sit amet interdum non, tempor ac lacus. Phasellus ut molestie lacus. </p>

    <div class="gmap_canvas mx-auto mt-5 mb-5 rounded-3">
        <div class="ratio ratio-4x3">
            <iframe id="gmap_canvas"
                src="https://maps.google.com/maps?q=4%C2%AA%20Calle,%20Chalatenango&t=&z=13&ie=UTF8&iwloc=&output=embed"
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
            </iframe>
        </div>
    
    
    
        <style>
            .gmap_canvas {
                overflow: hidden;
                background: none !important;
    
            }
        </style>
    </div>    
      </div>
    </div>

</div>

@endsection