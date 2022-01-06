<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login | Register</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/images/favicon.svg') }}" />

    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/LineIcons.3.0.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/glightbox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.2.0/css/all.css">
</head>

<body>
  

    {{-- <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div> --}}

    


   
    @yield('content')

   

   
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/tiny-slider.js')}}"></script>
    <script src="{{asset('frontend/assets/js/glightbox.min.js')}}"></script>
    {{-- <script src="{{asset('frontend/assets/js/main.js')}}"></script> --}}
    @stack('scripts')
</body>

</html>