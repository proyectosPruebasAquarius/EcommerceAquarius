@extends('blank')

@section('content')
<div class="maill-success">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="success-content">
                    <i class="lni lni-envelope"></i>
                    <h2>
                        @isset($title)
                            {{ $title }}
                        @endisset
                    </h2>
                    <p>
                        @isset($message)
                            {{ $message }}
                        @endisset
                    </p>
                    <div class="button">
                        <a href="{{ url('/') }}" class="btn">Volver a inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection