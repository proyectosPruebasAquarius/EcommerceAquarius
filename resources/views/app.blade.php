<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/images/favicon.svg') }}" />
    <meta name="description" content="" />

    <title>Mi Tiendita - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/LineIcons.3.0.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/glightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}" />

    <link rel="stylesheet" href="{{asset('frontend/assets/css/ratingStart.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/timeline.css')}}" />
    @livewireStyles
    @stack('styles')
    <noscript>
        <meta http-equiv="refresh" content="0; url=http://192.168.1.6:8080/noscript">
    </noscript>
</head>

<body>
    @php

        function main() {
            static $called = false;
            static $count = 1;

            if (!$called) {
                $called = true;

                $visitor = request()->ip();
                $userAgent = request()->header('User-Agent');
                $count = $count++;

                \DB::table('track_services')->insert([
                    ['ip' => request()->ip(), 'user_agent' => $userAgent],                
                ]);
            }
        }

        $visitor = request()->ip();
        $userAgent = request()->header('User-Agent');
        
        $storeData = \DB::table('track_services')->where('ip', $visitor)->latest()->first();
        /* \DB::table('track_services')->insert([
                    ['ip' => request()->ip(), 'user_agent' => $userAgent, 'created_at' => now()],                
                ]); */
        if (!empty($storeData)) {
            $date = new \DateTime(date("Y-m-d h:i:s"));
            $date2 = new \DateTime(date('Y-m-d h:i:s', strtotime($storeData->created_at)));
            //format("Difference => %Y years, %m months, %d days, %h hours, and %i minutes"));
             
            if (intval(date_diff($date2, $date)->format("%h")) >= 1) {
                \DB::table('track_services')->insert([
                    ['ip' => request()->ip(), 'user_agent' => $userAgent, 'created_at' => now()],                
                ]);
            }
        } else {
            \DB::table('track_services')->insert([
                ['ip' => request()->ip(), 'user_agent' => $userAgent, 'created_at' => now()],                
            ]);
        }
        /* main(); */

        /* $data = [$visitor, $userAgent, $count]; */
    @endphp
    {{-- <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div> --}}


    <header class="header navbar-area" style="z-index: 1000">        

        <div>
            <div class="header-middle">
                <div class="container">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-2 d-md-none">
                                @livewire('categorie-preview')
                            </div>
                            <div class="col-lg-3 col-md-3 col-2 ">
        
                                {{-- @livewire('scroll-category') --}}
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    <h3 class="d-inline text-danger">Mi Tiendita</h3>{{-- <img src="{{ asset('frontend/assets/images/logo/logo.svg') }}"
                                        alt="Logo"> --}}
                                </a>
        
                            </div>
                            <div class="col-6 d-md-none text-end">
                                @auth
                                <div class="user">
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn rounded-circle border dropdown-toggle btn-sm mb-1" type="button" id="drMenu"
                                                data-bs-toggle="dropdown" aria-expanded="false" style="height: 40px; width: 40px">
                                                <i {{-- style="color: #0d6efd" --}} class="fas fa-user"></i>
                                            </button>
                                            <ul class="dropdown-menu " aria-labelledby="drMenu">
                                                <li>
                                                    @if (Auth::user()->id_tipo_usuario == 1)
                                                    <a class="dropdown-item badge text-wrap w-100 border-0 text-start text-dark" href="{{ url('admin/inicio') }}" style="border-radius: 5px  !important;"><i class="fal fa-user-secret d-inline"></i> <p class="d-inline">{{ __('Administración') }}</p></a>
                                                    @endif
                                                </li>
                                                <li><a class="dropdown-item badge text-wrap w-100 border-0 text-start text-dark" href="{{ route('profile') }}" style="border-radius: 5px  !important;"><i
                                                            class="lni lni-user d-inline text-dark"></i> <p class="d-inline">Perfil</p></a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>{{-- LogOut Form --}}
                                                    <a class="dropdown-item badge text-wrap w-100 border-0 text-start text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();" style="border-radius: 5px  !important;">
                                                        <i class="fal fa-sign-out-alt d-inline"></i> <p class="d-inline">Cerrar sesión</p>
                                                    </a>
        
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                    </form>
                                                    {{-- End LogOut Form --}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
    
                                    {{-- Bienvenido
                                    &nbsp; --}}
    
                                </div>
                                @endauth
                                @guest
                                    <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                                @endguest
                            </div>
                            <div class="col-2 d-md-none">
                                <div class="navbar-cart">
                                    <div class="cart-items">
                                        @if (request()->route()->uri() !== 'carrito')
                                        @livewire('preview-cart')
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-7 d-xs-none">
        
                                @livewire('search-bar')
        
                            </div>
                            {{-- {{ session()->getId() }} --}}
                            <div class="col-lg-5 col-md-2 d-xs-none">
                                <div class="middle-right-area">
                                    <div class="nav-hotline">
                                        <i class="lni lni-phone"></i>
                                        <h3>Teléfono:
                                            <span>(+503) 2323 2323</span>
                                        </h3>
                                    </div>
                                    <div class="navbar-cart">
                                        <div class="wishlist">
                                            <div class="top-end">
    
                                                @auth
                                               {{--  @if (Auth::user()->id_tipo_usuario == 1)
                                                <div class="user">
                                                    <a class="w-auto fs-6" href="{{ url('admin/inicio') }}">{{ __('Administración') }}</a>
                                                </div>
                                                | &nbsp;
                                                @endif --}}
                    
                                                <div class="user">
                                                    <div>
                                                        <div class="dropdown">
                                                            <button class="btn rounded-pill border dropdown-toggle btn-sm mb-1 w-auto" type="button" id="drMenu"
                                                                data-bs-toggle="dropdown" aria-expanded="false" style="height: 40px; width: 40px">
                                                                <i {{-- style="color: #0d6efd" --}} class="fas fa-user"></i> {{ strtok(Auth::user()->name, ' ') }}
                                                            </button>
                                                            <ul class="dropdown-menu " aria-labelledby="drMenu">
                                                                <li>
                                                                    @if (Auth::user()->id_tipo_usuario == 1)
                                                                    <a class="dropdown-item badge text-wrap w-100 border-0 text-start" href="{{ url('admin/inicio') }}" style="border-radius: 5px  !important;"><i class="fal fa-user-secret d-inline"></i> <p class="d-inline">{{ __('Administración') }}</p></a>
                                                                    @endif
                                                                </li>
                                                                <li><a class="dropdown-item badge text-wrap w-100 border-0 text-start" href="{{ route('wishlist') }}" style="border-radius: 5px  !important;"><i
                                                                    class="lni lni-heart d-inline"></i> <p class="d-inline">Lista de deseos</p></a>
                                                                </li>
                                                                <li><a class="dropdown-item badge text-wrap w-100 border-0 text-start" href="{{ route('profile') }}" style="border-radius: 5px  !important;"><i
                                                                            class="lni lni-user d-inline"></i> <p class="d-inline">Perfil</p></a>
                                                                </li>
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li>{{-- LogOut Form --}}
                                                                    <a class="dropdown-item badge text-wrap w-100 border-0 text-start" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                        document.getElementById('logout-form').submit();" style="border-radius: 5px  !important;">
                                                                        <i class="fal fa-sign-out-alt d-inline"></i> <p class="d-inline">Cerrar sesión</p>
                                                                    </a>
                        
                                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                                        class="d-none">
                                                                        @csrf
                                                                    </form>
                                                                    {{-- End LogOut Form --}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                    
                                                    {{-- Bienvenido
                                                    &nbsp; --}}
                    
                                                </div>
                    
                                                @endauth
                    
                                                @guest
                                                <ul class="user-login">
                                                    <li>
                                                        <a href="{{ route('login') }}" class="w-auto h-auto badge text-wrap text-center border-0" style="border-radius: 5px  !important;"><p ><i class="far fa-user"></i> Mi cuenta</p></a>
                                                        
                                                    </li>
                                                    {{-- <li>
                                                        <a href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                                    </li>--}}
                                                </ul>
                                                @endguest
                    
                                            </div>
                                        </div>
                                        <div class="cart-items">
                                            <!--<a href="javascript:void(0)" class="main-btn">
                                                    <i class="lni lni-cart"></i>
                                                    <span class="total-items">2</span>
                                                </a>
        
                                                <div class="shopping-item">
                                                    <div class="dropdown-cart-header">
                                                        <span>2 Items</span>
                                                        <a href="cart.html">View Cart</a>
                                                    </div>
                                                    <ul class="shopping-list">
                                                        <li>
                                                            <a href="javascript:void(0)" class="remove" title="Remove this item"><i class="lni lni-close"></i></a>
                                                            <div class="cart-img-head">
                                                                <a class="cart-img" href="product-details.html"><img src="assets/images/header/cart-items/item1.jpg" alt="#"></a>
                                                            </div>
                                                            <div class="content">
                                                                <h4><a href="product-details.html">
                                                                    Apple Watch Series 6</a></h4>
                                                                <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" class="remove" title="Remove this item"><i class="lni lni-close"></i></a>
                                                            <div class="cart-img-head">
                                                                <a class="cart-img" href="product-details.html"><img src="assets/images/header/cart-items/item2.jpg" alt="#"></a>
                                                            </div>
                                                            <div class="content">
                                                                <h4><a href="product-details.html">Wi-Fi Smart Camera</a></h4>
                                                                <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="bottom">
                                                        <div class="total">
                                                            <span>Total</span>
                                                            <span class="total-amount">$134.00</span>
                                                        </div>
                                                        <div class="button">
                                                            <a href="checkout.html" class="btn animate">Checkout</a>
                                                        </div>
                                                    </div>
                                                </div>-->
        
        
                                            @if (request()->route()->uri() !== 'carrito')
                                            @livewire('preview-cart')
                                            @endif
        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div id="navPrincipal">
                <div class="container">
                    <div class="row align-items-center" style="height:60px" id="header-latest">
                        <div class="col-lg-6 col-md-6 col-sm-12 d-none d-md-block">
                            <div class="nav-inner">    
                                @livewire('categorie-preview') 
                                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="tablet-only">
                                    <ol class="breadcrumb" style="font-size: 13px">
                                      @yield('breadcrumb')
                                    </ol>
                                  </nav>           
                            </div>
                            
                        </div>
                       
                        <div class="col-lg-6 col-md-5 col-12">
        
                            <div class="col-12 d-md-none">
                                <nav style="--bs-breadcrumb-divider: '>'; position: relative;top: 6vw; right: 40px" aria-label="breadcrumb" class="tablet-only">
                                    <ol class="breadcrumb" style="font-size: 13px">
                                      @yield('breadcrumb')
                                    </ol>
                                  </nav>
                            </div>
                            <div class="@if (request()->path() != '/') d-none d-md-block @endif">
                                <div class="nav-social">
                                    <h5 class="title">Redes sociales:</h5>
                                    <ul>
                                        <li>
                                            <a href="https://m.me/110812464804606" target="_blank" style="background-color: #0167F3; border-color: #0167F3; color: #fff"><i
                                                    class="lni lni-facebook-filled"></i></a>
                                        </li>
                                        {{-- <li>
                                            <a href="javascript:void(0)" class="twitter"><i
                                                    class="lni lni-twitter-original"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                                        </li> --}}
                                        <li>
                                            {{-- <a href="javascript:void(0)"><i class="lni lni-skype"></i></a> --}}
                                            <a href="https://wa.me/50377948668" target="_blank" style="background-color: #25D366; border-color: #25D366; color: #fff"><i
                                                    class="lni lni-whatsapp"></i></a>
                                        </li>
                                       
                                        {{-- <li class="d-block-inline d-md-none">
                                            <div class="navbar-cart">
                                                <div class="cart-items">
                                                    @if (request()->route()->uri() !== 'carrito')
                                                    @livewire('preview-cart')
                                                    @endif
                                                </div>
                                            </div>
                                        </li> --}}
                                        {{-- <li>
                                            <h5 class="title">Preguntas Frecuentes</h5>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </header>


    @yield('content')


    <footer class="footer">

        <!--  <div class="footer-top">
                <div class="container">
                    <div class="inner-content">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="footer-logo">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset('frontend/assets/images/logo/white-logo.svg') }}" alt="#">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="footer-newsletter">
                                    <h4 class="title">
                                        Subscribe to our Newsletter
                                        <span>Get all the latest information, Sales and Offers.</span>
                                    </h4>
                                    <div class="newsletter-form-head">
                                        <form action="#" method="get" target="_blank" class="newsletter-form">
                                            <input name="EMAIL" placeholder="Email address here..." type="email">
                                            <div class="button">
                                                <button class="btn">Subscribe<span class="dir-part"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->


        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            {{-- <div class="single-footer f-contact">
                                <h3>Nuestros Horarios</h3>
                                <p class="phone">Teléfono: +503 2323 2323</p>
                                <ul>
                                    <li><span>Lunes-Viernes: </span> 9.00 am - 8.00 pm</li>
                                    <li><span>Sábados: </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                <p class="mail">
                                    
                                    <a href="mailto:mitiendita@example.com">mitiendita@example.com</a>
                                </p>
                            </div> --}}
                            <div class="single-footer f-link">
                                <h3>Para Comprar</h3>                                
                                <ul>
                                    <li><a href="{{ route('compras.about') }}">Como Comprar</a></li>
                                    <li><a href="{{ route('compras.about') }}">Formas de Pago</a></li>
                                    <li><a href="{{ route('compras.about') }}">Gastos de Envíos</a></li>
                                    <li><a href="{{ route('compras.about') }}">Cupones de Descuento</a></li>
                                    <li><a href="{{ route('faq') }}">Preguntas Frecuentes</a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h3>Sobre Nosotros</h3>                                
                                <ul>
                                    <li><a href="{{ url('/sobre-nosotros') }}">Quienes Somos</a></li>
                                    <li><a href="{{ url('/ubicacion') }}">Nuestra Tienda</a></li>
                                    <li><a href="{{ route('marcas') }}">Marcas</a></li>
                                    <li><a href="{{ route('website.seguridad') }}">Seguridad de Sitio</a></li>
                                    <li><a href="{{ route('seguridadpolitica') }}">Política de Privacidad</a></li>
                                    <li><span>Horarios:</span>
                                        <ul>
                                            <li>L - V: 8:00 - 17:00</li>
                                            <li>Sabado: 8:00 - 12:00</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h3>Contactar</h3>                                
                                <ul>
                                    <li><a href="{{ url('contacto') }}">Soporte</a></li>
                                    <li><a href="{{ route('seguridadpolitica') }}">Garantia</a></li>
                                    <li><a href="{{ route('opiniones') }}">Opiniones</a></li>
                                </ul>
                            </div>

                        </div>

                        <div class="col-lg-2 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h3>Comunidad</h3>                                
                                <ul>
                                    <li><a href="#"><i class="fab fa-blogger"></i> Blog</a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                                    <li><a href="https://m.me/110812464804606" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i> Youtube</a></li>
                                    <li><a href="https://wa.me/50377948668" target="_blank"><i class="fab fa-whatsapp"></i> Whatsapp</a></li>
                                </ul>
                            </div>

                        </div>

                        <div class="col-lg-2 col-md-12 col-12 payment">

                            <div class="single-footer f-link">
                                <p class="text-center text-dark mb-5">Pagos Seguros</p>
                                <ul class="metodos-pagos">
                                    <li>                                    
                                        <div class="row text-center">
                                            <div class="col-3">
                                                <i class="fab fa-cc-visa" style="color: #1A1F71"></i>                                            
                                            </div>
                                            <div class="col-3">
                                                <i class="fab fa-cc-mastercard" style="color: #EB001B"></i>                                            
                                            </div>
                                            <div class="col-3">
                                                <i class="fab fa-cc-amex" style="color: #016FD0"></i>                                            
                                            </div>
                                            <div class="col-3">
                                                <i class="fab fa-cc-discover" style="color: #00457C"></i>
                                            </div>
                                            <div class="col-3">
                                                
                                            </div>
                                        </div>
                                        <div class="row text-center mx-auto">
                                            <div class="col-6">
                                                <img src="{{ asset('frontend/assets/images/https.svg') }}" alt="certificate" class="img-fluid" width="30" height="30">
                                            </div>
                                            <div class="col-6">
                                                <img src="{{ asset('frontend/assets/images/web-security.svg') }}" alt="certificate" class="img-fluid" width="30" height="30">
                                            </div>
                                        </div>                                        
                                    </li>
                                </ul>
                            </div>

                        </div>
                        {{-- <div class="col-lg-3 col-md-6 col-12">

                            <div class="single-footer f-link">
                                <h3>Categorias</h3>
                                @livewire('footer-category')
                            </div>

                        </div> --}}
                    </div>
                </div>
            </div>
        </div>


        <div class="footer-bottom">
            <div class="container">
                <div class="inner-content">
                    <div class="row align-items-center">

                        <div class="col-lg-12 col-12">
                            <div class="copyright">
                                <p>Hecho con&nbsp; <i class="fas fa-heart"></i>&nbsp; en El Salvador por AquariusIT&copy;</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </footer>


    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- <script src="asset('frontend/assets/js/boot }}strap.min.js')}}"></script>--}}
    <script src="{{asset('frontend/assets/js/tiny-slider.js')}}"></script>
    <script src="{{asset('frontend/assets/js/glightbox.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script defer>
        'use strict';
        /* var something = (function() {
            var executed = false;
            return function() {
                if (!executed) {
                    executed = true;
                    console.log('yaaaaa');
                }
            };
        })();

        something(); */

        /* (function () {
            var waitTime = 60000; 
            var executionTime;
            var initialTime = localStorage.getItem("initialTime");
            if (initialTime !== null) {
                executionTime = parseInt(initialTime, 10) + waitTime - (new Date()).getTime();
                if (executionTime < 0) executionTime = 0;
            } else {
                localStorage.setItem("initialTime", (new Date()).getTime());
                executionTime = waitTime;
            };

            setTimeout(() => {               
                localStorage.removeItem('initialTime');
                console.log('new year');
            }, executionTime);
        }()); */

        /* (function () {

        }()) */
    </script>
    
    <script>
        /* (function() {
                window.onload = function() { 
                    window.setTimeout(fadeout, 500); 
                    if ('{{-- request()->route()->getName() --}}' != 'carrito') {
                        if(window.scrollY > 0){
                            document.querySelector('.header-middle').classList.add('fixed-top')
                            document.querySelector('.header-middle').classList.add('bg-white')
                        }else{
                            document.querySelector('.header-middle').classList.remove('fixed-top')
                            document.querySelector('.header-middle').classList.remove('bg-white')
                        }   
                    }
                }

                function fadeout() {
                    document.querySelector('.preloader').style.opacity = '0';
                    document.querySelector('.preloader').style.display = 'none';
                }
                window.onscroll = function() { var header_navbar = document.querySelector(".navbar-area"); var sticky = header_navbar.offsetTop; var backToTo = document.querySelector(".scroll-top"); if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) { backToTo.style.display = "flex"; } else { backToTo.style.display = "none"; } };
                let navbarToggler = document.querySelector(".mobile-menu-btn");
                navbarToggler.addEventListener('click', function() { navbarToggler.classList.toggle("active"); });
            })(); */

            window.onscroll =  () => {
               if ('{{ request()->route()->getName() }}' != 'carrito') {
                    if(window.scrollY > 50){
                       let bar = document.getElementById('navPrincipal');
                       bar.classList.add('bg-white', 'fixed-top')
                    }else{
                        let bar = document.getElementById('navPrincipal');
                        bar.classList.remove('bg-white', 'fixed-top')
                    }     
               }
                           
            }
    </script>
    <x-livewire-alert::scripts />
    <script type="text/javascript">
        //	window.addEventListener("resize", function() {
            //		"use strict"; window.location.reload();
            //	});
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})



                document.addEventListener("DOMContentLoaded", function(){


                    /////// Prevent closing from click inside dropdown
                    document.querySelectorAll('.dropdown-menu').forEach(function(element){
                        element.addEventListener('click', function (e) {
                          e.stopPropagation();
                        });
                    })



                    // make it as accordion for smaller screens
                    if (window.innerWidth < 992) {

                        // close all inner dropdowns when parent is closed
                        document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
                            everydropdown.addEventListener('hidden.bs.dropdown', function () {
                                // after dropdown is hidden, then find all submenus
                                  this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                                      // hide every submenu as well
                                      everysubmenu.style.display = 'none';
                                  });
                            })
                        });

                        document.querySelectorAll('.dropdown-menu a').forEach(function(element){
                            element.addEventListener('click', function (e) {

                                  let nextEl = this.nextElementSibling;
                                  if(nextEl && nextEl.classList.contains('submenu')) {
                                      // prevent opening link if link needs to open dropdown
                                      e.preventDefault();
                                      console.log(nextEl);
                                      if(nextEl.style.display == 'block'){
                                          nextEl.style.display = 'none';
                                      } else {
                                          nextEl.style.display = 'block';
                                      }

                                  }
                            });
                        })
                    }
                    // end if innerWidth

                });
                // DOMContentLoaded  end
    </script>
    {{-- <script>
        const finaleDate = new Date("February 15, 2023 00:00:00").getTime();

            const timer = () => {
                const now = new Date().getTime();
                let diff = finaleDate - now;
                if (diff < 0) {
                    document.querySelector('.alert').style.display = 'block';
                    document.querySelector('.container').style.display = 'none';
                }

                let days = Math.floor(diff / (1000 * 60 * 60 * 24));
                let hours = Math.floor(diff % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                let minutes = Math.floor(diff % (1000 * 60 * 60) / (1000 * 60));
                let seconds = Math.floor(diff % (1000 * 60) / 1000);

                days <= 99 ? days = `0${days}` : days;
                days <= 9 ? days = `00${days}` : days;
                hours <= 9 ? hours = `0${hours}` : hours;
                minutes <= 9 ? minutes = `0${minutes}` : minutes;
                seconds <= 9 ? seconds = `0${seconds}` : seconds;

                document.querySelector('#days').textContent = days;
                document.querySelector('#hours').textContent = hours;
                document.querySelector('#minutes').textContent = minutes;
                document.querySelector('#seconds').textContent = seconds;

            }
            timer();
            setInterval(timer, 1000);
    </script> --}}
    @stack('scripts')
</body>

</html>