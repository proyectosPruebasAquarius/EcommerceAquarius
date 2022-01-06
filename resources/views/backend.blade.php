<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Administración </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/vendors/iconly/bold.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/select2.css')}}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/images/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/favicons/favicon.ico') }}">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    @stack('partial-style')
</head>

<body class="d-flex flex-column h-100">
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo col-11 text-center">
                            <a href="/admin/inicio">
                                Mi Tiendita
                            </a>
                        </div>
                        <div class="toggler col-1">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item  " id="inicio">
                            <a href="/admin/inicio" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Inicio</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Menu</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item" id="marcas">
                                    <a href="/admin/marcas">Marcas</a>
                                </li>
                                <li class="submenu-item" id="productos">
                                    <a href="/admin/productos" >Productos</a>
                                </li>
                                <li class="submenu-item" id="categorias">
                                    <a href="/admin/categorias">Categorias</a>
                                </li>
                                <li class="submenu-item" id="proveedores">
                                    <a href="/admin/proveedores">Proveedores</a>
                                </li>
                                <li class="submenu-item " id="inventarios">
                                    <a href="/admin/inventarios">Inventarios</a>
                                </li>
                                <li class="submenu-item" id="ofertas">
                                    <a href="/admin/ofertas">Ofertas</a>
                                </li>
                                <li class="submenu-item" id="metodos">
                                    <a href="/admin/metodos_pagos">Métodos de Pago</a>
                                </li>
                                <li class="submenu-item" id="ventas">
                                    <a href="/admin/ventas">Ventas</a>
                                </li>
                                <li class="submenu-item" id="pedidos">
                                    <a href="/admin/pedidos">Pedidos</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <header class='mb-2'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                
                                <li class="nav-item dropdown me-3">
                                    @livewire('notify')
                                </li>
                      
                            </ul>
                           
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">
                                                @if (Auth::check())
                                               {{ Auth::user()->name}}
                                                @else
                                                    sin sesion
                                                @endif
                                            </h6>
                                            <p class="mb-0 text-sm text-gray-600">Administrador</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{Auth::user()->image}}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">
                                             @if (Auth::check())

                                            Hola {{ Auth::user()->name}}!
                                             @else
                                                 sin sesion
                                             @endif</h6>
                                    </li>
                                   <!-- <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                            Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                            Settings</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
                                            Wallet</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>-->
                                    <li><a class="dropdown-item"  onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Cerrar Sesion</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="mx-3">
                @yield('content')
               
               <!-- <footer class="mt-auto">
                    <div class="mb-0 col-11 mx-5 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Hecho con <span class="text-primary"><i class="fas fa-heart"></i></span> en El Salvador</p>
                        </div>
                    </div>
                </footer>-->
            </div>

           
        
              
           

        </div>
    </div>
    <script src="{{asset('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/main.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('partial-scripts')
</body>

</html>
@stack('datatable-scripts')
