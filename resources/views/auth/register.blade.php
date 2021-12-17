@extends('blank')


@section('content')
<div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="register-form">
                    <div class="title">
                        <h3>{{ __('Registro') }}</h3>
                        {{-- <p>Registrationtakeslessthanaminutebutgivesyoufullcontroloveryourorders.</p> --}}
                    </div>
                    <form class="row" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">{{ __('Nombre de Usuario') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">{{ __('Correo Electrónico') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>                                
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">                               
                            </div>
                        </div>
                        
                        <div class="button">
                            <button class="btn" type="submit">{{ __('Registrar') }}</button>
                        </div>
                        <p class="outer-link">{{ __('¿Ya tienes una cuenta?') }} <a href="{{ route('login') }}">{{ __('Inicia Sesión') }}</a>
                        </p>

                        <a href="{{ url('/') }}" class="text-muted outer-link">{{ __('Volver al inicio') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection