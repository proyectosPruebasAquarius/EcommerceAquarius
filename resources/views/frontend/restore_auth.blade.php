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
                    <form  method="POST" action="{{ route('restore.pass.auth') }}">
                        @csrf
                        @method('put')
                        
                        <div class="row">
                            @include('frontend.alert')
                        </div>
                        <div class="row">
                            
                            <div class="form-group row">
                                <label for="old_password" class="col-md-4 col-form-label text-md-center">{{ __('Contraseña Actual') }}</label>
    
                                <div class="col-md-6 mx-auto input__container">
                                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old-password" style="padding-right: 30px;">
                                    <i class="fas fa-eye-slash" onclick="showPass('old_password', this)"></i>
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-center">{{ __('Nueva Contraseña') }}</label>
        
                                    <div class="col-md-6 mx-auto input__container">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        <i class="fas fa-eye-slash" onclick="showPass('password', this)"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-center">{{ __('Confirmar Contraseña') }}</label>
        
                                    <div class="col-md-6 mx-auto input__container">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <i class="fas fa-eye-slash" onclick="showPass('password-confirm', this)"></i>
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
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        let showPass = (e, i) => {
            let password = document.getElementById(e)           
            if (password.type === "password") {
                password.type = "text"
                i.classList.remove("fas", "fa-eye-slash")
                i.classList.add("far", "fa-eye")
            } else {
                password.type = "password"
                i.classList.remove("far", "fa-eye")
                i.classList.add("fas", "fa-eye-slash")                
            }               
        }
    </script>
@endpush
@endsection