@extends('backend')
@section('title','Productos')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Productos</h3>

            </div>

        </div>
    </div>
    <br>
    @if (\Session::has('alert'))

    @switch(\Session::get('alert'))
    @case('warning')
    <div class="alert alert-warning alert-dismissible fade show m-5 text-center" role="alert">
        <i class="fal fa-exclamation"></i>
        <strong>{!! \Session::get('message') !!}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @break
    @case('success' || 'update')
    <div class="alert alert-success alert-dismissible fade show m-5 text-center" role="alert">
        <i class="fal fa-check-circle"></i>
        <strong>{!! \Session::get('message') !!}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @break
    @case('danger')
    <div class="alert alert-danger alert-dismissible fade show m-5 text-center" role="alert">
        <i class="fal fa-check-circle"></i>
        <strong>{!! \Session::get('message') !!}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @break


    @endswitch
    @endif
    <section class="section mx-3">
        <div class="card">
            <div class="col-12 d-flex justify-content-end mt-3">

                <a href="/admin/productos/add" class="btn btn-primary mx-4">Agregar</a>
            </div>
            <div class="card-body">
                <table class="table table-striped  text-center pt-3 pb-3" id="prodTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Proveedor</th>
                            <th>Sub Categoria</th>
                            <th>Imagenes</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto => $p)
                        <tr>
                            <td>{{$p->nombre}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#descripcionModal{{ $producto }}">
                                    Descripción
                                </button>

                                <!-- Modal -->
                                <div class="modal fade mt-5" id="descripcionModal{{ $producto }}" tabindex="-1"
                                    aria-labelledby="descripcionModal{{ $producto }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="descripcionModal{{ $producto }}Label">Descripción del Producto: {{ $p->nombre }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    {{ $p->descripcion }}
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>{{$p->marca}}</td>
                            <td>{{$p->categoria}}</td>
                            <td>
                                {{$p->proveedor}}
                            </td>
                            <td>{{$p->sub_categoria}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#imagesModal{{ $producto }}">
                                    Ver Imagenes del producto
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="imagesModal{{ $producto }}" tabindex="-1"
                                    aria-labelledby="imagesModalLabel{{ $producto }}" aria-hidden="true"
                                    style="padding-top: 8%">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <h5 class="modal-title text-center col-11"
                                                    id="imagesModalLabel{{ $producto }}">Imagenes del producto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="carouselExampleControls{{ $producto }}"
                                                    class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach(json_decode($p->imagen) as $key => $value)
                                                        @if($key === 0)
                                                        <div class="carousel-item active">
                                                            <img src="{{ $value }}" class="d-block img-fluid "
                                                                alt="Product Image">
                                                        </div>
                                                        @else
                                                        <div class="carousel-item">
                                                            <img src="{{ $value }}" class="d-block img-fluid"
                                                                alt="Producct Image">
                                                        </div>
                                                        @endif

                                                        @endforeach

                                                    </div>
                                                    @foreach(json_decode($p->imagen) as $key => $i)
                                                    <button class="carousel-control-prev" type="button"
                                                        data-bs-target="#carouselExampleControls{{ $producto }}"
                                                        data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Siguiente</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button"
                                                        data-bs-target="#carouselExampleControls{{ $producto }}"
                                                        data-bs-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="visually-hidden">Anterior</span>
                                                    </button>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Cerrar</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </td>
                            <td>
                                <ul class="list-inline m-0">
                                    @php
                                    $parameter =[
                                    'id' =>$p->id,
                                    ];
                                    $parameter= Crypt::encrypt($parameter);
                                    @endphp
                                    <li class="list-inline-item" data-toggle="tooltip" data-placement="top"
                                        title="Editar">
                                        <a href="productos/edit/{{$parameter}}" class="btn btn-success btn-sm rounded-0"
                                            type="button"><i class="fal fa-pencil-alt"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <form action="{{url('admin/productos/delete/')}}/{{$parameter}}" method="post"
                                            id="formDel">
                                            @method('DELETE')
                                            @csrf



                                            <button type="submit" class="btn btn-danger btn-sm rounded-0" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                                    class="fal fa-trash-alt"></i></button>
                                        </form>

                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection

@push('partial-scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/r-2.2.9/datatables.min.js">
</script>

@endpush

@push('datatable-scripts')
<script>
    $(document).ready(function() {
    $('#prodTable').DataTable({
        "language":{
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        }
    });
} );


var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

@endpush

@push('partial-style')
<link rel="stylesheet" href="{{asset('backend/assets/css/datatables.css')}}">

@endpush