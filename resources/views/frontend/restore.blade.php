@extends('blank')


@section('content')
<div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="register-form">
                    <div class="title">
                        <h3 class="text-center">{{ __('Reiniciar Contraseña') }}</h3>
                        {{-- <p>Registrationtakeslessthanaminutebutgivesyoufullcontroloveryourorders.</p> --}}
                    </div>
                    <form  method="POST" action="{{ route('restore.pass', ['email' => $email]) }}">
                        @csrf
                        @method('put')
                        
                        <div class="row">
                            
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-center">{{ __('Contraseña') }}</label>
        
                                    <div class="col-md-6 mx-auto">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-center">{{ __('Confirmar Contraseña') }}</label>
        
                                    <div class="col-md-6 mx-auto">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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