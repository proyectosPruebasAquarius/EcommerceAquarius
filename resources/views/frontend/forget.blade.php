@extends('blank')


@section('content')
<div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="register-form">
                    <div class="title">
                        <h3 class="text-center">{{ __('¿Olvidates Tú Contraseña?') }}</h3>
                        {{-- <p>Registrationtakeslessthanaminutebutgivesyoufullcontroloveryourorders.</p> --}}
                    </div>
                    <form  method="POST" action="{{ route('reset.pass.email') }}">
                        @csrf
                        
                        <div class="row">
                            @include('frontend.alert')
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mx-auto text-center">
                                <div class="form-group">
                                    <label for="email">{{ __('Correo Electronico') }}</label>
                                    {{-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus> --}}
    
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus>
                                    {{-- @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6 mx-auto text-center">
                                <div class="button">
                                    <button class="btn rounded-pill" type="submit">{{ __('Solicitar') }}</button>
                                </div> 
                            </div>
                        </div>                       
                        <a href="{{ url('/') }}" class="text-muted outer-link">{{ __('Volver al inicio') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection