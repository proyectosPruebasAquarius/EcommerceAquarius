@extends('app')

@section('title',  $productos->producto)
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item"><a href="{{ route('productos') }}">Productos</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $productos->categoria }}</li>

@endsection

@section('content')


<!-- Start Item Details -->
<section class="item-details section bg-white">
    <div class="container">
        <button class="btn btn-primary d-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="clickOff">Toggle right offcanvas</button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
            aria-labelledby="offcanvasRightLabel" wire:ignore-self>
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Producto Agregado al Carrito</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                {{-- ... --}}
            </div>
        </div>

        @livewire('detail', ['data' => $data])
        {{-- @livewire('offcanvas') --}}
        <div class="product-details-info">
            <div class="single-block">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Detalle del Producto</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Comentarios</button>                      
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="info-body custom-responsive-margin">                            
                                    <p>{{ $productos->descripcion }}</p>
                                   {{-- <h4>Features</h4> --}}
                                    {{--  <ul class="features">
                                        <li>Capture 4K30 Video and 12MP Photos</li>
                                        <li>Game-Style Controller with Touchscreen</li>
                                        <li>View Live Camera Feed</li>
                                        <li>Full Control of HERO6 Black</li>
                                        <li>Use App for Dedicated Camera Operation</li>
                                    </ul> --}}
                                    <h4>Opciones de Compra:</h4>
                                    <ul class="normal-list">
                                        <li><span>Envio:</span> 2 - 4 días habiles</li>
                                        <li><span>Retiro en Tienda:</span>$10.00</li>
                                        <li><span>Correos El Salvador:</span> 4 - 6 días, $18.00</li>
                                        <li><span>Unishop Global Export:</span> 3 - 4 days, $25.00</li>
                                    </ul>
                                </div>
                            </div>
                            {{--  <div class="col-lg-6 col-12">
                                <div class="info-body">
                                    <h4>Specifications</h4>
                                    <ul class="normal-list">
                                        <li><span>Weight:</span> 35.5oz (1006g)</li>
                                        <li><span>Maximum Speed:</span> 35 mph (15 m/s)</li>
                                        <li><span>Maximum Distance:</span> Up to 9,840ft (3,000m)</li>
                                        <li><span>Operating Frequency:</span> 2.4GHz</li>
                                        <li><span>Manufacturer:</span> GoPro, USA</li>
                                    </ul>
                                    <h4>Shipping Options:</h4>
                                    <ul class="normal-list">
                                        <li><span>Courier:</span> 2 - 4 days, $22.50</li>
                                        <li><span>Local Shipping:</span> up to one week, $10.00</li>
                                        <li><span>UPS Ground Shipping:</span> 4 - 6 days, $18.00</li>
                                        <li><span>Unishop Global Export:</span> 3 - 4 days, $25.00</li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-lg-12 col-12">
        
                                @guest
                                <div class="text-center">
                                    <span>{{ __('Para comentar debe ') }}<a href="{{ route('login') }}"> iniciar sesión</a></span>
                                </div>
                                @endguest
        
                                @auth
                                    @php
                                        $compras = \DB::table('detalle_ventas')->join('ventas', 'detalle_ventas.id_venta', '=', 'ventas.id')->where([
                                            ['ventas.id_usuario', auth()->user()->id],
                                            ['detalle_ventas.id_producto', Crypt::decrypt(request('id'))]
                                        ])->count();
                                    @endphp
                                    @if($compras)
                                    <form method="POST" action="/review_store">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="title">
                                                    Valoración
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class='card_right__rating'>
                                                    <div class='card_right__rating__stars'>
                                                        <fieldset class='rating'>
                                                            {{-- <input id='star10' name='rating' type='radio' value='10'>
                                                            <label class='full' for='star10' title='10 stars'></label>
                                                            <input id='star9half' name='rating' type='radio' value='9 and a half'>
                                                            <label class='half' for='star9half' title='9.5 stars'></label>
                                                            <input id='star9' name='rating' type='radio' value='9'>
                                                            <label class='full' for='star9' title='9 stars'></label>
                                                            <input id='star8half' name='rating' type='radio' value='8 and a half'>
                                                            <label class='half' for='star8half' title='8.5 stars'></label>
                                                            <input id='star8' name='rating' type='radio' value='8'>
                                                            <label class='full' for='star8' title='8 stars'></label>
                                                            <input id='star7half' name='rating' type='radio' value='7 and a half'>
                                                            <label class='half' for='star7half' title='7.5 stars'></label>
                                                            <input id='star7' name='rating' type='radio' value='7'>
                                                            <label class='full' for='star7' title='7 stars'></label>
                                                            <input id='star6half' name='rating' type='radio' value='6 and a half'>
                                                            <label class='half' for='star6half' title='6.5 stars'></label>
                                                            <input id='star6' name='rating' type='radio' value='6'>
                                                            <label class='full' for='star6' title='6 star'></label>
                                                            <input id='star5half' name='rating' type='radio' value='5 and a half'>
                                                            <label class='half' for='star5half' title='5.5 stars'></label> --}}
                                                            {{-- usefully --}}
                                                            <input id='star5' name='rating' type='radio' value='5'>
                                                            <label class='full' for='star5' title='5 estrellas'></label>
                                                            <input id='star4half' name='rating' type='radio' value='4.5'>
                                                            <label class='half' for='star4half' title='4.5 estrellas'></label>
                                                            <input id='star4' name='rating' type='radio' value='4'>
                                                            <label class='full' for='star4' title='4 estrellas'></label>
                                                            <input id='star3half' name='rating' type='radio' value='3.5'>
                                                            <label class='half' for='star3half' title='3.5 estrellas'></label>
                                                            <input id='star3' name='rating' type='radio' value='3'>
                                                            <label class='full' for='star3' title='3 estrellas'></label>
                                                            <input id='star2half' name='rating' type='radio' value='2.5'>
                                                            <label class='half' for='star2half' title='2.5 estrellas'></label>
                                                            <input id='star2' name='rating' type='radio' value='2'>
                                                            <label class='full' for='star2' title='2 estrellas'></label>
                                                            <input id='star1half' name='rating' type='radio' value='1.5'>
                                                            <label class='half' for='star1half' title='1.5 estrellas'></label>
                                                            <input id='star1' name='rating' type='radio' value='1'>
                                                            <label class='full' for='star1' title='1 star'></label>
                                                            <input id='starhalf' name='rating' type='radio' value='0.5' required>
                                                            <label class='half' for='starhalf' title='0.5 estrellas'></label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="title" class="form-label">Titulo</label>
                                                <input type="text" required class="form-control" id="title" aria-describedby="titlelHelp"
                                                    name="title" style="background-color: #F1F3F4" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <textarea required class="form-control" placeholder="Leave a comment here"
                                                        id="floatingTextarea2" style="height: 100px; background-color: #F1F3F4"
                                                        name="descripcion" maxlength="500"></textarea>
                                                    <label for="floatingTextarea2">Escribe una reseña...</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 d-none">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="id_producto"
                                                        aria-describedby="titlelHelp" name="id_producto"
                                                        style="background-color: #F1F3F4"
                                                        value="{{ Crypt::decrypt(request('id')) }}" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary float-end rounded-pill"
                                                    id="reviewBtn">Enviar Reseña</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                @endauth
        
                            </div>
                        </div>
        
                        <div class="row">
        
                            <div class="col-lg-12 col-12">
                                @auth
                                @inject('reviews', 'App\Review')
                                @php
                                $review = $reviews::where([
                                ['id_usuario', Auth::user()->id],
                                ['id_producto', Crypt::decrypt(request('id'))]
                                ])->orderBy('rating', 'desc')->simplePaginate(3);
                                @endphp
        
                                @if(count($review) > 0)
                                <h6 class="title">Mis Reseñas</h6>
                                @foreach($review as $k => $r)
                                <div class="card text-center mt-2 border-0">
                                    <div class="card-body">
                                        {{-- Firts Collapse --}}
        
                                        <img class="img-thumbnail rounded float-start" src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/assets/images/no-image-avatar.png') }}"
                                            alt="{{ Auth::user()->name }}" width="100px" height="100px">
                                        <div class="collapse show multi-collapse multi-collapse-{{ $k }}" id="collapse{{ $k }}">
                                            <div class="row">
                                                <div class="text-end">
        
                                                    <div class="col">
                                                        <span class="btn-group">
                                                            <button class="btn btn-outline-success rounded-circle btn-sm me-1"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target=".multi-collapse-{{ $k }}" aria-expanded="false"
                                                                aria-controls="collapse{{ $k }} collapseS{{ $k }}"><i
                                                                    class="lni lni-pencil-alt"></i></button>
                                                            <form method="POST" action="{{ route('review.delete', $r->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-outline-danger rounded-circle btn-sm"
                                                                    onclick="return confirm('¿Estas seguro que deseas eliminar el comentario?')"><i
                                                                        class="lni lni-trash-can"></i></button>
                                                            </form>
                                                        </span>
                                                    </div>
        
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class='card_right__rating'>
                                                        <div class='card_right__rating__stars'>
                                                            <fieldset class='rating'>
                                                                @if($r->rating == 0.5)
                                                                <input type='radio' value='0.5' checked>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 1.0)
                                                                <input type='radio' value='1' checked>
                                                                <label class='full' title='1 star'></label>
                                                                @elseif($r->rating == 1.5)
                                                                <input type='radio' value='1.5' checked>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 2.0)
                                                                <input type='radio' value='2' checked>
                                                                <label class='full' title='2 estrellas'></label>
                                                                <input id='star1half' name='rating' type='radio' value='1.5'>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 2.5)
                                                                <input type='radio' value='2.5' checked>
                                                                <label class='half' title='2.5 estrellas'></label>
                                                                <input id='star2' name='rating' type='radio' value='2'>
                                                                <label class='full' title='2 estrellas'></label>
                                                                <input id='star1half' name='rating' type='radio' value='1.5'>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 3.0)
                                                                <input type='radio' value='3' checked>
                                                                <label class='full' title='3 estrellas'></label>
                                                                <input id='star2half' name='rating' type='radio' value='2.5'>
                                                                <label class='half' title='2.5 estrellas'></label>
                                                                <input id='star2' name='rating' type='radio' value='2'>
                                                                <label class='full' title='2 estrellas'></label>
                                                                <input id='star1half' name='rating' type='radio' value='1.5'>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 3.5)
                                                                <input type='radio' value='3.5' checked>
                                                                <label class='half' title='3.5 estrellas'></label>
                                                                <input id='star3' name='rating' type='radio' value='3'>
                                                                <label class='full' title='3 estrellas'></label>
                                                                <input id='star2half' name='rating' type='radio' value='2.5'>
                                                                <label class='half' title='2.5 estrellas'></label>
                                                                <input id='star2' name='rating' type='radio' value='2'>
                                                                <label class='full' title='2 estrellas'></label>
                                                                <input id='star1half' name='rating' type='radio' value='1.5'>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 4.0)
                                                                <input type='radio' value='4' checked>
                                                                <label class='full' title='4 estrellas'></label>
                                                                <input id='star3half' name='rating' type='radio' value='3.5'>
                                                                <label class='half' title='3.5 estrellas'></label>
                                                                <input id='star3' name='rating' type='radio' value='3'>
                                                                <label class='full' title='3 estrellas'></label>
                                                                <input id='star2half' name='rating' type='radio' value='2.5'>
                                                                <label class='half' title='2.5 estrellas'></label>
                                                                <input id='star2' name='rating' type='radio' value='2'>
                                                                <label class='full' title='2 estrellas'></label>
                                                                <input id='star1half' name='rating' type='radio' value='1.5'>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 4.5)
                                                                <input type='radio' value='4.5' checked>
                                                                <label class='half' title='4.5 estrellas'></label>
                                                                <input id='star4' name='rating' type='radio' value='4'>
                                                                <label class='full' title='4 estrellas'></label>
                                                                <input id='star3half' name='rating' type='radio' value='3.5'>
                                                                <label class='half' title='3.5 estrellas'></label>
                                                                <input id='star3' name='rating' type='radio' value='3'>
                                                                <label class='full' title='3 estrellas'></label>
                                                                <input id='star2half' name='rating' type='radio' value='2.5'>
                                                                <label class='half' title='2.5 estrellas'></label>
                                                                <input id='star2' name='rating' type='radio' value='2'>
                                                                <label class='full' title='2 estrellas'></label>
                                                                <input id='star1half' name='rating' type='radio' value='1.5'>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @elseif($r->rating == 5.0)
                                                                <input type='radio' value='5' checked>
                                                                <label class='full' title='5 estrellas'></label>
                                                                <input id='star4half' name='rating' type='radio' value='4.5'>
                                                                <label class='half' title='4.5 estrellas'></label>
                                                                <input id='star4' name='rating' type='radio' value='4'>
                                                                <label class='full' title='4 estrellas'></label>
                                                                <input id='star3half' name='rating' type='radio' value='3.5'>
                                                                <label class='half' title='3.5 estrellas'></label>
                                                                <input id='star3' name='rating' type='radio' value='3'>
                                                                <label class='full' title='3 estrellas'></label>
                                                                <input id='star2half' name='rating' type='radio' value='2.5'>
                                                                <label class='half' title='2.5 estrellas'></label>
                                                                <input id='star2' name='rating' type='radio' value='2'>
                                                                <label class='full' title='2 estrellas'></label>
                                                                <input id='star1half' name='rating' type='radio' value='1.5'>
                                                                <label class='half' title='1.5 estrellas'></label>
                                                                <input id='star1' name='rating' type='radio' value='1'>
                                                                <label class='full' title='1 star'></label>
                                                                <input id='starhalf' name='rating' type='radio' value='0.5'>
                                                                <label class='half' title='0.5 estrellas'></label>
                                                                @endif
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <p class="text-muted text-start">{{ date('d-m-Y', strtotime($r->created_at))
                                                        }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <h6>{{ $r->title }}</h6>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col text-center">
                                                    <p class="card-text">{{ $r->descripcion }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Firts Collapse --}}
        
                                        {{-- Start Second Collapse --}}
                                        <div class="collapse multi-collapse multi-collapse-{{ $k }}" id="collapseS{{ $k }}">
                                            <div class="row">
                                                <div class="col text-end">
                                                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="collapse"
                                                        data-bs-target=".multi-collapse-{{ $k }}" aria-expanded="false"
                                                        aria-controls="collapse{{ $k }} collapseS{{ $k }}"><i
                                                            class="lni lni-close"></i></button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <form method="POST" action="{{ route('review.update', $r->id) }}">
                                                        @csrf
                                                        @method('PUT')
        
                                                        <div class="mb-3">
                                                            <label for="editV" class="form-label">Valoración</label>
                                                            <p id="editV">{{ $r->rating }}</p>
                                                            <div class="row">
                                                                <div class='card_right__rating d-flex justify-content-center'>
                                                                    <div class='card_right__rating__stars'>
                                                                        <fieldset class='rating'>
                                                                            <input id='star5e{{ $k }}' name='rating'
                                                                                type='radio' value='5' {{ $r->rating == 5.0 ?
                                                                            'checked' : '' }}>
                                                                            <label class='full' for='star5e{{ $k }}'
                                                                                title='5 estrellas'></label>
                                                                            <input id='star4halfe{{ $k }}' name='rating'
                                                                                type='radio' value='4.5' {{ $r->rating == 4.5 ?
                                                                            'checked' : '' }}>
                                                                            <label class='half' for='star4halfe{{ $k }}'
                                                                                title='4.5 estrellas'></label>
                                                                            <input id='star4e{{ $k }}' name='rating'
                                                                                type='radio' value='4' {{ $r->rating == 4.0 ?
                                                                            'checked' : '' }}>
                                                                            <label class='full' for='star4e{{ $k }}'
                                                                                title='4 estrellas'></label>
                                                                            <input id='star3halfe{{ $k }}' name='rating'
                                                                                type='radio' value='3.5' {{ $r->rating == 3.5 ?
                                                                            'checked' : '' }}>
                                                                            <label class='half' for='star3halfe{{ $k }}'
                                                                                title='3.5 estrellas'></label>
                                                                            <input id='star3e{{ $k }}' name='rating'
                                                                                type='radio' value='3' {{ $r->rating == 3.0 ?
                                                                            'checked' : '' }}>
                                                                            <label class='full' for='star3e{{ $k }}'
                                                                                title='3 estrellas'></label>
                                                                            <input id='star2halfe{{ $k }}' name='rating'
                                                                                type='radio' value='2.5' {{ $r->rating == 2.5 ?
                                                                            'checked' : '' }}>
                                                                            <label class='half' for='star2halfe{{ $k }}'
                                                                                title='2.5 estrellas'></label>
                                                                            <input id='star2e{{ $k }}' name='rating'
                                                                                type='radio' value='2' {{ $r->rating == 2.0 ?
                                                                            'checked' : '' }}>
                                                                            <label class='full' for='star2e{{ $k }}'
                                                                                title='2 estrellas'></label>
                                                                            <input id='star1halfe{{ $k }}' name='rating'
                                                                                type='radio' value='1.5' {{ $r->rating == 1.5 ?
                                                                            'checked' : '' }}>
                                                                            <label class='half' for='star1halfe{{ $k }}'
                                                                                title='1.5 estrellas'></label>
                                                                            <input id='star1e{{ $k }}' name='rating'
                                                                                type='radio' value='1' {{ $r->rating == 1.0 ?
                                                                            'checked' : '' }}>
                                                                            <label class='full' for='star1e{{ $k }}'
                                                                                title='1 star'></label>
                                                                            <input id='starhalfe{{ $k }}' name='rating'
                                                                                type='radio' value='0.5' {{ $r->rating == 0.5 ?
                                                                            'checked' : '' }} required>
                                                                            <label class='half' for='starhalfe{{ $k }}'
                                                                                title='0.5 estrellas'></label>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editTitle" class="form-label">Titulo</label>
                                                            <input type="text" class="form-control" id="editTitle"
                                                                value="{{ $r->title }}" name="title" maxlength="100" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="editDes" class="form-label">Descripción</label>
                                                            <textarea class="form-control" id="editDes" rows="3"
                                                                name="descripcion" maxlength="500" required>{{ $r->descripcion }}</textarea>
                                                        </div>
                                                        <input type="submit" class="btn btn-outline-primary" value="Actualizar">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Second Collapse --}}
                                    </div>
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex justify-content-center">
                                            {!! $review->links() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h6>Opiniones de los clientes</h6>
                                    </div>
                                </div>
                                @endif
                                @endauth
        
                                {{-- comprobando que no haya comentarios del cliente autenticado --}}
                                @php
                                    $cCount = \DB::table('opiniones')->where([
                                      ['deleted_at', null],
                                      ['id_producto', $data]
                                    ])->count();
                                    
                                @endphp
        
                                @if(isset($coments))
                                @if(count($coments) > 0)
        
                                <div id="allReviewSection">
                                    @livewire('load-more-reviews', ['data'=>$data])
        
        
                                </div>
        
                                @else
                                <p class="text-muted text-center">
                                  @if ($cCount)
                                    No se encontraron más valoraciones para este producto.
                                  @else
                                    No se encontraron valoraciones para este producto, se el
                                        primero en comentar.
                                  @endif
                                </p>
                                @endif
                                @else
                                <p class="text-muted text-center">
                                  @if ($cCount)
                                    No se encontraron más valoraciones para este producto.
                                  @else
                                    No se encontraron valoraciones para este producto, se el
                                        primero en comentar.
                                  @endif
                                </p>
                                @endif
        
                            </div>
        
                        </div>
                    </div>                    
                  </div>
                  
                
            </div>
        </div>       
    </div>
</section>
<!-- End Item Details -->

<!-- Review Modal -->
<div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-name">Your Name</label>
                            <input class="form-control" type="text" id="review-name" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-email">Your Email</label>
                            <input class="form-control" type="email" id="review-email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-subject">Subject</label>
                            <input class="form-control" type="text" id="review-subject" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="review-rating">Rating</label>
                            <select class="form-control" id="review-rating">
                                <option>5 Stars</option>
                                <option>4 Stars</option>
                                <option>3 Stars</option>
                                <option>2 Stars</option>
                                <option>1 Star</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="review-message">Review</label>
                    <textarea class="form-control" id="review-message" rows="8" required></textarea>
                </div>
            </div>
            <div class="modal-footer button">
                <button type="button" class="btn">Submit Review</button>
            </div>
        </div>
    </div>
</div>
<!-- End Review Modal -->

@push('scripts')
    <script>
        /* window.livewire */
        {{-- Livewire.on('show', () => {
            console.log('holis')
            /* document.getElementById('offcanvasRight').classList.add('show'); */
            document.getElementById('clickOff').click()
            console.log(document.getElementById('offcanvasRight'));
        }) --}}
        Livewire.on('show', p => {
            /* console.log('holis') */
            /* document.getElementById('offcanvasRight').classList.add('show'); */
            document.getElementById('clickOff').click()
            /* console.log(document.getElementById('offcanvasRight')); */
            console.log(p);

            let data = '';

            data += '<div class="card border-link">'
                data += '<div class="card-body">'
                    /* mb-3 ms-md-3 */
                    data += '<img src="'+p.attributes['image']+'" class="col-12 col-md-6 float-md-start rounded img-fluid img-thumbnail me-md-3 border-0" alt="'+p.attributes['image']+'" width="70px" height="100px">'
                    data += '<h6 class="card-title">'+p.name+'</h6>'
                    data += '<p class="card-text">Unidades: '+p.quantity+'</p>'
                    data += '<p class="card-text">$'+(Math.round(p.price*p.quantity * 100) / 100).toFixed(2)+'</p>'


                data += '</div>'

            data += '</div>'
            data += '<a type="button" class="btn  col-12 mt-2 text-white" style="background-color: #0d6efd !important;" href="{{ url('/carrito') }}">Continuar con la Compra</a>'
            document.querySelector('.offcanvas-body').innerHTML = data;

            setTimeout( () => {
                if (document.getElementById('offcanvasRight').classList.contains('show')) {
                    document.getElementById('clickOff').click()
                }
            }, 4000);
        })
    </script>
@endpush

{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('/frontend/assets/js/dynamic-card.js') }}"></script> --}}
@endsection
