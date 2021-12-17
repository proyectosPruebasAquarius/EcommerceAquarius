@extends('blank')


@section('content')
        
    <div class="error-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="error-content">
                        <h1>404</h1>
                        <h2>!Oops! !Pagina No Encontrada!</h2>
                        <p>La pagina que buscabas no existe. Pudo ser eliminada o trasladada.</p>
                        <div class="button">
                            <a href="{{ url('/') }}" class="btn">Volver a Inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection