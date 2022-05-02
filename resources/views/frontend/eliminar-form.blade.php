@extends('app')

@section('title', 'Formulario de elimación')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Formulario de elimación de Cuenta</li>
@endsection

@section('content')
    <section>
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col mx-auto">
                    <div class="card">
                        <div class="card-body">
                            @livewire('eliminar-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection