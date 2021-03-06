@extends('app')

@section('title', 'Perfil')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Perfil</li>
@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Perfil</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Inicio</a></li>
                    <li><a href="javascript:void(0)">Perfil</a></li>
                    {{-- <li>ShopGrid</li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="product-grids section">

    <div class="container">
        @if (\Session::has('correlative'))
        <div class=" d-flex justify-content-center">
            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Compra Completada!</h4>
                <p>Este es el numero de transaccion de tu compra.</p>
                <h6>
                    <strong>{!! \Session::get('correlative') !!}</strong>
                </h6>
                <hr>
                <p class="mb-0">Recuerda que con este codigo podras apelar por cualquier anomalia.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        </div>
        @endif
        @if (count($ventas) > 0)
        <div class="card text-center mx-auto w-50 shadow-lg rounded w-auto">
            @else
            <div class="card text-center mx-auto w-50 shadow-lg rounded">
                @endif
                <ul class="nav nav-tabs mx-auto mt-1" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Datos Personales</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Direcciones</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Valoraciones</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        {{-- <img class="card-img-top rounded-circle w-25 h-25 mh-50 mw-50 mx-auto pt-2" src="{{ Auth::user()->image != '' && Auth::user()->image != null ? asset(Auth::user()->image) : asset('frontend/assets/images/no-image-avatar.png') }}" alt="Avatar"> --}}
                        <img class="card-img-top rounded-circle w-25 h-25 mh-50 mw-50 mx-auto pt-2" src="{{ asset('frontend/assets/images/no-image-avatar.png') }}" alt="Avatar">
                        <div class="card-body">
                            <h4 class="card-title">{{ Auth::user()->name }}</h4>
                            <p class="card-text">{{ Auth::user()->email }}</p>
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show m-5" role="alert">

                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            @endif
                            <br>
                            <a type="button" href="#" class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="lni lni-pencil-alt"></i> Editar datos</a>
                            &nbsp;
                            <a type="button" href="{{ url('/restore/contrase??a') }}" class="btn btn-outline-primary"><i class="lni lni-lock-alt"></i> Cambiar contrase??a</a>
                        </div>

                        @if (count($ventas) > 0)

                        @foreach ($ventas as $ven)
                        <div class="modal fade" id="estadoPedido{{ $ven->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="estadoPedidoLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title col-11 text-center" id="estadoPedidoLabel">Estado de tu pedido</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                        $states = DB::table('pedidos')->where('id_venta',$ven->id)->select('pedidos.*')->get();
                                        @endphp
                                        @foreach ($states as $state)
                                        <div class="row">
                                            <div class="col-sm-6">
                                              <div class="card">
                                                <div class="card-body">
                                                  <h5 class="card-title">Preparaci??n @if($state->preparacion == 1) (Completado)  @endif</h5>
                                                
                                                  <a href="#" class="btn"><i class="fas fa-box fs-1  @if($state->preparacion == 1) text-success  @endif"></i></a>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="card">
                                                <div class="card-body">
                                                  <h5 class="card-title">Revisi??n @if($state->revision == 1) (Completado)  @endif</h5>
                                                 
                                                  <a href="#" class="btn"><i class="fas fa-eye fs-1  @if($state->revision == 1) text-success  @endif"></i></a>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        @endforeach
                                      
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                              <div class="card">
                                                <div class="card-body">
                                                  <h5 class="card-title">Envio @if($state->envio == 1) (Completado)  @endif</h5>
                                                  
                                                  <a href="#" class="btn "><i class="fas fa-shipping-timed fs-1  @if($state->envio == 1) text-success  @endif"></i></a>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="card">
                                                <div class="card-body">
                                                  <h5 class="card-title">Entregado @if($state->entregado == 1) (Completado)  @endif</h5>
                                                 
                                                  <a href="#" class="btn"><i class="fas fa-home fs-1  @if($state->entregado == 1) text-success  @endif"></i></a>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        
                        
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                        <div class="m-4">
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Compras Realizadas
                            </button>
                            <div class="collapse pt-2" id="collapseExample">
                                <div class="card card-body shadow rounded" style="background: #eeeeee;">
                                    <section class="timeline_area section_padding_130">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-12 col-sm-8 col-lg-6">
                                                    <!-- Section Heading-->
                                                    <div class="section_heading text-center">
                                                        <h6>Historial de compras</h6>

                                                        <div class="line"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <!-- Timeline Area-->
                                                    <div class="apland-timeline-area">

                                                        @forelse ($ventas as $venta)
                                                       
                                                         
                                                        <!-- Single Timeline Content-->
                                                        <div class="single-timeline-area">
                                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                                <p>{{ date('d/m/Y h:i A', strtotime($venta->created_at)) }}</p>
                                                            </div>
                                                            <div class="row">
                                                               
                                                                {{-- Card for number code --}}
                                                                <div class="col-6 col-md-6 col-lg-4">
                                                                    <div class="single-timeline-content d-flex wow fadeInLeft overflow-auto" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                                      
                                                                        <div class="timeline-text">
                                                                            <h6>N??mero de Transacci??n</h6>
                                                                            <p><span class="badge rounded-pill bg-success text-wrap align-middle text-center">{{ $venta->num_transaccion }}</span></p>
                                                                            <a href="{{ url('/show-invoice').'/'.$venta->id }}">Factura</a>
                                                                            <p><span class="badge rounded-pill bg-{{ $venta->estado  ? 'primary' : 'danger' }} text-wrap align-middle text-center">{{ $venta->estado  ? 'Aprobada' : 'Pendiente' }}</span></p>
                                                                            <p>
                                                                                
                
                                                                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#estadoPedido{{ $venta->id}}">Estado del pedido</button>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                               
                                                                {{-- End number card --}}
                                                                
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <span>{{ __('Ocurri?? un error, por favor recarga la pagina') }} <a href="{{ route('profile')}}">Recargar</a></span>
                                                        @endforelse

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-body">
                            <h5>Direcciones</h5>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item mx-auto g-0" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-truck"></i> Direcciones de env??o</button>
                                </li>
                                <li class="nav-item mx-auto g-0" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fab fa-wpforms"></i> Direcciones de facturi??n</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <h5>Direcciones de env??o</h5>
                                    @php
                                    $direcciones = DB::table('direcciones')->where([
                                    ['id_user', auth()->user()->id],
                                    ['deleted_at', NULL]
                                    ])->join('municipios', 'direcciones.id_municipio', '=', 'municipios.id')
                                    ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')
                                    ->join('users', 'direcciones.id_user', '=', 'users.id')
                                    ->select('departamentos.nombre as departamento', 'municipios.nombre as municipio', 'users.name as user', /* 'direcciones.first_name', 'direcciones.last_name',
                                    'direcciones.email', */ 'direcciones.telefono', 'direcciones.direccion', 'direcciones.id', /* 'direcciones.facturacion', */ 'direcciones.referencia', /* 'direcciones.referencia_facturacion', */ 'departamentos.id as id_departamento', 'municipios.id as id_municipio')
                                    ->get();
                                    @endphp
                                    @forelse ($direcciones as $direccion)
                                    <div class="row">
                                        <div class="col-12 mx-auto">
                                            <div class="card mt-2 mb-2">
                                                <form method="post" action="{{ route('update.direccion', $direccion->id) }}" class="form-horizontal" id="formDirecciones{{ $loop->index }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="card-title">
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail{{ $loop->index }}" class="col-sm-2 col-form-label">Direcci??n de envio</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="direccion" readonly class="form-control text-center" id="staticEmail{{ $loop->index }}" value="{{ $direccion->direccion }}" required>
                                                                </div>
                                                            </div>
                                                            {{-- $valoracion->title --}}
                                                        </div>
                                                        <div class="card-subtitle mb-2 text-muted">
                                                            

                                                            <div class="mb-3 row">
                                                                <label for="staticReferencia{{ $loop->index }}" class="col-sm-2 col-form-label">Punto de referencia env??o</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="referencia" readonly class="form-control text-center" id="staticReferencia{{ $loop->index }}" value="{{ $direccion->referencia }}">
                                                                </div>
                                                            </div>
                                                            

                                                            <div class="mb-3 row" id="readOnlyDM{{ $loop->index }}">
                                                                <label for="staticDM{{ $loop->index }}" class="col-sm-2 col-form-label">Departamento y Municipio</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" readonly class="form-control text-center" id="staticDM{{ $loop->index }}" value="{{ $direccion->departamento }} - {{ $direccion->municipio }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row d-none" id="editOnlyDM{{ $loop->index }}">
                                                                <label for="staticDM{{ $loop->index }}" class="col-sm-2 col-form-label">Departamento y Municipio</label>
                                                                <div class="col-sm-10">
                                                                    @livewire('departamentos')
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label for="staticTelefono{{ $loop->index }}" class="col-sm-2 col-form-label">Tel??fono</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="telefono" readonly class="form-control text-center" id="staticTelefono{{ $loop->index }}" value="{{ $direccion->telefono }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a type="button" class="card-link btn" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="update(@js($direccion))"><i class="lni lni-pencil-alt"></i> Editar</a>
                                                        <a type="button" onclick="changeAttr('{{ $loop->index }}', '{{ $direccion->id }}')" class="card-link btn text-danger"><i class="lni lni-trash-can"></i> Eliminar</a>
                                                    </div>
                                                    <div class="row d-none" id="hiddenRow">
                                                        <div class="col-6-col-md-4 mb-1">
                                                            <a type="button" class="card-link btn" onclick="setReadOnly('{{ $loop->index }}')">Cancelar</a>
                                                            <button type="submit" class="card-link btn text-white" style="background: #0167F3;">Actualizar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($loop->last)
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6 mx-auto">
                                                <button type="button"class="btn btn-outline-dark shadow-lg" onclick="addElement('direccion')"><i class="fal fa-plus-octagon"></i> Agregar nueva direcci??n de env??o</button>
                                            </div>
                                        </div>
                                    @endif
                                    @empty
                                    
                                    <p>Direcciones vacias</p>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mx-auto">
                                            <button type="button"class="btn btn-outline-dark shadow-lg" onclick="addElement('direccion')"><i class="fal fa-plus-octagon"></i> Agregar nueva direcci??n de env??o</button>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <h5>Direcciones de facturaci??n</h5>
                                    @php
                                    $facturaciones = DB::table('direcciones_facturaciones')->where([
                                    ['id_user', auth()->user()->id],
                                    ['deleted_at', NULL]
                                    ])->join('municipios', 'direcciones_facturaciones.id_municipio', '=', 'municipios.id')
                                    ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')
                                    ->join('users', 'direcciones_facturaciones.id_user', '=', 'users.id')
                                    ->select('departamentos.nombre as departamento', 'municipios.nombre as municipio', 'users.name as user', 
                                    'direcciones_facturaciones.direccion', 'direcciones_facturaciones.id', 'direcciones_facturaciones.referencia', 'departamentos.id as id_departamento', 'municipios.id as id_municipio')
                                    ->get();
                                    @endphp
                                    @forelse ($facturaciones as $fct)
                                    <div class="row">
                                        <div class="col-12 mx-auto">
                                            <div class="card mt-2 mb-2">
                                                <form method="post" action="{{ route('delete.direccion.facturacion', $fct->id) }}" class="form-horizontal" id="formFacturaciones{{ $loop->index }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="card-title">
                                                            <div class="mb-3 row">
                                                                <label for="staticEmail{{ $loop->index }}" class="col-sm-2 col-form-label">Direcci??n de envio</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="direccion" readonly class="form-control text-center" id="staticEmail{{ $loop->index }}" value="{{ $fct->direccion }}" required>
                                                                </div>
                                                            </div>
                                                            {{-- $valoracion->title --}}
                                                        </div>
                                                        <div class="card-subtitle mb-2 text-muted">

                                                            <div class="mb-3 row">
                                                                <label for="staticReferencia{{ $loop->index }}" class="col-sm-2 col-form-label">Punto de referencia env??o</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" name="referencia" readonly class="form-control text-center" id="staticReferencia{{ $loop->index }}" value="{{ $fct->referencia }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row" id="readOnlyDM{{ $loop->index }}">
                                                                <label for="staticDM{{ $loop->index }}" class="col-sm-2 col-form-label">Departamento y Municipio</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" readonly class="form-control text-center" id="staticDM{{ $loop->index }}" value="{{ $fct->departamento }} - {{ $fct->municipio }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row d-none" id="editOnlyDM{{ $loop->index }}">
                                                                <label for="staticDM{{ $loop->index }}" class="col-sm-2 col-form-label">Departamento y Municipio</label>
                                                                <div class="col-sm-10">
                                                                    @livewire('departamentos')
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <a type="button" class="card-link btn" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="update(@js($fct))"><i class="lni lni-pencil-alt"></i> Editar</a>
                                                        <input type="submit" onclick="return confirm('??Estas seguro que deseas eliminar esta direcci??n de facturaci??n?')" class="card-link btn text-danger" value="Eliminar"></input>
                                                    </div>
                                                    <div class="row d-none" id="hiddenRow">
                                                        <div class="col-6-col-md-4 mb-1">
                                                            <a type="button" class="card-link btn" onclick="setReadOnly('{{ $loop->index }}')">Cancelar</a>
                                                            <button type="submit" class="card-link btn text-white" style="background: #0167F3;">Actualizar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>                                        
                                    </div>
                                    @if ($loop->last)
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6 mx-auto">
                                                <button type="button"class="btn btn-outline-dark shadow-lg" onclick="addElement('facturacion')"><i class="fal fa-plus-octagon"></i> Agregar nueva direcci??n de facturaci??n</button>
                                            </div>
                                        </div>
                                    @endif
                                    @empty
                                    <p>Direcciones vacias</p>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mx-auto">
                                            <button type="button"class="btn btn-outline-dark shadow-lg" onclick="addElement('facturacion')"><i class="fal fa-plus-octagon"></i> Agregar nueva direcci??n de facturaci??n</button>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                                
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h5>Valoraciones</h5>
                        @php
                        $valoraciones = DB::table('opiniones')->join('productos', 'opiniones.id_producto', '=', 'productos.id')
                        ->where([
                        ['opiniones.id_usuario', auth()->user()->id],
                        ['opiniones.deleted_at', NULL]
                        ])->select('opiniones.*', 'productos.nombre as producto')
                        ->get();
                        @endphp
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                @forelse ($valoraciones as $valoracion)
                                <div class="card mt-2 mb-2">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <input type="text" readonly class="form-control-plaintext text-center" id="staticEmail" value="{{ $valoracion->title }}">
                                            {{-- $valoracion->title --}}
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><i class="lni lni-star text-warning"></i> Puntuaci??n: {{ $valoracion->rating }}</h6>
                                        <p class="card-text">{{ $valoracion->descripcion }}</p>
                                        {{-- <ahref="#"class="card-link"><iclass="lnilni-pencil-alt"></i>Editar</a> --}}
                                        <span>Producto: <a href="{{ route('detalle', Crypt::encrypt($valoracion->id_producto)) }}" class="card-link">{{ $valoracion->producto }}</a></span>
                                    </div>
                                </div>
                                @empty
                                <p class="mt-2 mb-2">{{ __('No se encontraron valoraciones de productos.') }}</p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>


            </div>

            {{-- Modal --}}
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="staticBackdropLabel">Actualizar Perfil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form method="POST" action="/profile/{{ Auth::user()->id }}/update" class="row g-3" id="updateForm" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <div class="mb-3 mx-auto text-center d-none" id="colNone">
                                    <img id="blah" src="#" alt="your image" class="rounded-circle" width="100px" height="100px" />
                                </div>

                                {{-- <labelclass="form-label">{{ __('FotodePerfil') }}</label> --}}
                                {{-- <div class="mb-3 input-group">
                                
                                <input class="form-control" accept="image/*" type='file' id="formFile" onchange="readURL(this);" aria-describedby="basic-addon2" value="" name="image">
                                <button type="button" class="btn btn-primary input-group-text" id="basic-addon2" onclick="javascript:document.getElementById('formFile').value = ''; document.getElementById('blah').src = ''">x</button>
                            </div> --}}

                                <div class="col-md-6">
                                    <label for="usuario" class="form-label">{{ __('Nombre de Usuario *') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                        <input type="text" class="form-control" id="usuario" aria-describedby="inputGroupPrepend2" name="name" value="{{ Auth::user()->name }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('Correo Electronico *') }}</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                            <button type="submit" form="updateForm" class="btn btn-primary">{{ __('Actualizar') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal --}}            
        </div>
        {{-- Modals Livewire --}}
        @livewire('update-dir-modal')
        @livewire('modal-direcciones')
        {{-- End Modals --}}
</section>
@push('scripts')
<script>
    window.addEventListener("load", function(event) {
        document.querySelectorAll("form").forEach((e) => {
            e.reset();

            if (e.querySelector('input[value="DELETE"]')) {
                e.querySelector('input[value="DELETE"]').value = "PUT"
            }
        })
    });

    Livewire.on('refreshList', function () {
        location.reload();
    })
    function update(e) {
        Livewire.emit('updateModalDir', e)
    }

    function addElement(e) {
        if (e == 'facturacion') {
            Livewire.emit('newValues', 'facturacion')
        } else {
            Livewire.emit('newValues', 'direccion')
        }

        var modal = new bootstrap.Modal(document.getElementById('modalDirecciones'));
            /* console.log(modal); */
            modal.show();
        
    }

    // Image preview
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                /* $('#blah')
                    .attr('src', e.target.result); */
                document.getElementById('colNone').classList.remove('d-none');
                document.getElementById('blah').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeReadOnly(index, e, f) {
        let form = document.getElementById(f + index);
        form.querySelectorAll('input').forEach(function(e, i) {
            e.removeAttribute('readonly')
            if (i == 0) {
                e.focus();
            }

            console.log(i)
        })

        form.querySelectorAll('.d-none').forEach(function(e) {
            e.classList.remove('d-none');
        })
        document.getElementById('readOnlyDM' + index).classList.add('d-none');

        let selects = form.querySelectorAll('select')

        let optionsD = selects[0].options;
        for (let i = 0; i < optionsD.length; i++) {
            /* console.log(optionsD[i]); */
            if (optionsD[i].value == e.id_departamento) {
                optionsD[i].selected = true;
            }
        }

        Livewire.emit('loadList', e.id_departamento)

        let optionsM = selects[1].options;
        console.log(optionsM);
        setTimeout(() => {
            for (let i = 0; i < optionsM.length; i++) {
                if (optionsM[i].value == e.id_municipio) {
                    optionsM[i].selected = true;
                }
            }
        }, 1000);
    }

    function setReadOnly(index) {
        let form = document.getElementById('formDirecciones' + index);
        form.querySelectorAll('input').forEach(function(e, i) {
            e.setAttribute('readonly', "")

        })

        form.querySelector('#hiddenRow').classList.add('d-none');
        document.getElementById('readOnlyDM' + index).classList.remove('d-none');
        document.getElementById('editOnlyDM' + index).classList.add('d-none');
    }

    function changeAttr(i, id) {
        let form = document.getElementById('formDirecciones' + i)
        form.action = '{{ url('/direccion/delete/') }}' + '/' + id
        form.querySelector('input[value="PUT"]')
        if (form.querySelector('input[value="PUT"]')) {
            form.querySelector('input[value="PUT"]').value = "DELETE"
            form.submit();
        } else {
            form.querySelector('input[value="DELETE"]').value = "PUT"
        }
        /* console.log(form.querySelector('input[value="PUT"]')) */
    }

</script>
@endpush
@endsection
