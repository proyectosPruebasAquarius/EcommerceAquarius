@extends('blank')

@section('content')
<div class="account-login section">
    <div class="container">
        <div class="row">
            {{-- Login --}}
            <div class="col-12 col-md-12 col-lg-6">
                <form class="card login-form" method="POST"  action="{{ route('login') }}">
                    @csrf

                    <div class="card-body">
                        <div class="title text-center">
                            <h3>¿Ya tienes una cuenta?</h3>
                            <h5>{{ __('Inicia Sesión') }}</h5>
                            <p>Puede usar tus redes sociales para registrate o tu correo electrónico.</p>
                        </div>
                        <div class="social-login">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12"><a class="btn facebook-btn" href="javascript:void(0)"><i class="lni lni-facebook-filled"></i> Facebook
                                    </a></div>
                                <div class="col-lg-4 col-md-4 col-12"><a class="btn twitter-btn" href="javascript:void(0)"><i class="lni lni-twitter-original"></i> Twitter
                                    </a></div>
                                <div class="col-lg-4 col-md-4 col-12"><a class="btn google-btn" href="javascript:void(0)"><i class="lni lni-google"></i> Google </a>
                                </div>
                            </div>
                        </div>
                        <div class="alt-option">
                            <span>Ó</span>
                        </div>
                        <div class="form-group input-group">
                            <label for="reg-fn">Correo Electrónico</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" id="reg-email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                            @error('email')
                            <span class="invalid-feedback" role="alert" id="loginFeed">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group input-group">
                            <label for="reg-fn">Contraseña</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" id="reg-pass" name="password" required autocomplete="current-password">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input width-auto" id="showOrHide" onclick="showPass(this)">
                                <label class="form-check-label">Mostrar contraseña</label>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex flex-wrap justify-content-between bottom-content">
                            <div class="form-check">
                                <input class="form-check-input width-auto" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label">{{ __('Recordarme') }}</label>
                            </div>
                            <a class="lost-pass" href="{{ url('/cambiar/contraseña') }}">¿ Olvidaste tú Contraseña ?</a>
                        </div>
                        <div class="button">
                            <button class="btn" type="submit">{{ __('Iniciar Sesión') }}</button>
                        </div>
                        {{--<p class="outer-link">{{ __('¿No tienes una cuenta?') }}&nbsp; <a href="{{ route('register') }}">{{ __('Registrate') }}</a>
                        </p> --}}

                        <a href="{{ url('/') }}" class="text-muted outer-link">{{ __('Volver al inicio') }}</a>
                    </div>
                </form>
            </div>
            {{-- End login  --}}

            {{-- Sign Up --}}
            <div class="col-12 col-md-12 col-lg-6 mt-2 mt-md-2 mt-lg-0">
                <div class="register-form">
                    <div class="title">
                        <h3>¿No tienes una cuenta?</h3>
                        <h5>{{ __('Registrate') }}</h5>
                        {{-- <p>Registrationtakeslessthanaminutebutgivesyoufullcontroloveryourorders.</p> --}}
                    </div>
                    <form class="row" method="POST" action="{{ route('register') }}" id="registerMod">
                        @csrf

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">{{ __('Nombres y Apellidos') }}</label>
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

                                          <span class="invalid-feedback" role="alert" id="feedback">
                                              <strong>{{ $message }}</strong>
                                          </span>

                                    @enderror

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" onclick="showPass(this)">
                                    <label class="form-check-label">Mostrar contraseña</label>
                                </div>

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

                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" id="terminosycondiciones" name="terminosycondiciones" value="true">
                                    <label class="form-check-label" for="terminosycondiciones">Acepta los <a type="button" class="text-decoration-underline" onclick="Livewire.emit('conditionChanger', 'terminos')" data-bs-toggle="modal" data-bs-target="#conditionsModal">Términos y Condiciones</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" id="politicaprivacidad" name="politica_privacidad" value="true">
                                    <label class="form-check-label" for="politicaprivacidad">Acepta las <a type="button" class="text-decoration-underline" onclick="Livewire.emit('conditionChanger', 'politica')" data-bs-toggle="modal" data-bs-target="#conditionsModal">Política de Privacidad</a></label>
                                </div>
                            </div>
                        </div>

                        <div class="button">
                            <button class="btn" type="submit">{{ __('Registrar') }}</button>
                        </div>
                        {{--<p class="outer-link">{{ __('¿Ya tienes una cuenta?') }} <a href="{{ route('login') }}">{{ __('Inicia Sesión') }}</a>
                        </p>--}}

                        <a href="{{ url('/') }}" class="text-muted outer-link">{{ __('Volver al inicio') }}</a>
                    </form>
                </div>
            </div>
            {{--  End Sign Up --}}
        </div>
    </div>
    
    <!-- Modal -->
    @livewire('conditions-modal')
    <!-- End Modal -->
</div>
@stack('scripts')
    <script type="text/javascript" defer>

      if (localStorage.wasLogging == 'true') {
          if (document.getElementById('loginFeed').classList.contains('invisible')) {
              document.getElementById('loginFeed').classList.remove('invisible');
          }
          document.getElementById('feedback').classList.add('invisible');
          document.querySelectorAll('input[type="email"]')[1].classList.remove('is-invalid')
          document.querySelectorAll('input[type="email"]')[1].value = ''
          localStorage.removeItem('wasLogging');
      } else {
          if (document.getElementById('feedback')) {
            if (document.getElementById('feedback').classList.contains('invisible')) {
                document.getElementById('feedback').classList.remove('invisible');
            }
          }
          document.querySelectorAll('input[type="email"]')[0].classList.remove('is-invalid')
          document.querySelectorAll('input[type="email"]')[0].value = ''
          if (document.getElementById('loginFeed')) {
            document.getElementById('loginFeed').classList.add('invisible');
          }
          localStorage.removeItem('wasLogging');
      }

      document.getElementById('registerMod').addEventListener('submit', function(e) {
            e.preventDefault();
            if (document.getElementById('terminosycondiciones').checked && document.getElementById('politicaprivacidad').checked) {                
                document.getElementById('registerMod').submit();
            } else { 
                alert('Acepte los teminos, condiciones y politicas de privacidad');                
            }
      });

      var capture = (e) => {
          e.preventDefault();
          if (document.getElementById('terminosycondiciones').checked && document.getElementById('politicaprivacidad').checked) {
              return true;
          } else {
              alert('Acepte los teminos, condiciones y politicas de privacidad')
          }
      }
    </script>
    <script>
//         window.onload = function () {
// console.log('gg');
//             if (localStorage.wasLogging == 'true') {
//
//                 document.getElementById('feedback').classList.add('d-none');
//                 localStorage.removeItem('wasLogging');
//             } else {
//                 localStorage.removeItem('wasLogging');
//                 if (document.getElementById('feedback').classList.contains('d-none')) {
//                     document.getElementById('feedback').classList.remove('d-none');
//                 }
//             }
//
//         };
        let forms = document.querySelectorAll('form');
        // console.log(forms);
        forms.forEach(element => {
            element.addEventListener('submit', (e) => {
                console.log(e.target);
                if (e.target.classList.contains('login-form')) {
                    localStorage.setItem('wasLogging', true);
                    /* e.preventDefault(); */
                } else{
                    localStorage.setItem('wasLogging', false);
                    /* e.preventDefault(); */
                }
            })
        });

        let showPass = (e) => {
            let password = document.querySelectorAll('input[name="password"]')
            if (e.checked)
            {
                password.forEach(element => {
                    if (element.type === "password") {
                        element.type = "text"
                    }
                });
            } else {
                password.forEach(element => {
                    if (element.type === "text") {
                        element.type = "password"
                    }
                });
            }
        }
    </script>

@endsection
