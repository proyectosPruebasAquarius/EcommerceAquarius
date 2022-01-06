@extends('backend')

@section('title','Lista de Pedidos')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Pedidos de Proveedores</h3>
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
    <section class="section mx-3">
        <div class="card">
            <div class="col-12 d-flex justify-content-end mt-3">

                <button type="button" class="btn btn-primary mx-4" data-bs-toggle="modal" title="PDF"
                    data-bs-target="#exampleModal">
                    Descargar en PDF <li class="fal fa-file-pdf"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade mt-10" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-11 text-center" id="exampleModalLabel">Descarga de PDF de
                                    Pedidos de Proveedores</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('admin/pedidos/pdf') }}" method="post" id="FormPDFS">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="FechaIncio" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="FechaIncio"
                                            aria-describedby="emailHelp" name="fecha_inicio">

                                    </div>
                                    <div class="mb-3">
                                        <label for="FechaFin" class="form-label">Fecha de Fin</label>
                                        <input type="date" class="form-control" id="FechaFin"
                                            aria-describedby="emailHelp" name="fecha_fin">

                                    </div>
                                    <div id="emailHelp" class="form-text"><strong>Selecciona la Fecha ó Fechas de las cuales deseas optener los datos</strong>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="sumit" class="btn btn-primary" form="FormPDFS">Descargar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center table-bordered pt-3 pb-3" id="prodTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Código del Producto</th>
                            <th>Producto</th>
                            <th>Precio de Compra</th>
                            <th>Proveedor</th>
                            <th>Estado</th>
                            <th>Fecha de Registro</th>
                            <th>Fecha de Entrega</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{$pedido->codigo_producto}}</td>
                            <td>{{$pedido->producto}}</td>
                            <td>
                                $ {{$pedido->precio_compra}}
                            </td>
                            <td>{{ $pedido->proveedor }}</td>
                            @switch($pedido->estado_pedido)
                            @case(0)
                            <td>
                                <span class="badge bg-primary">Pendiente de Pedido</span>
                            </td>
                            @break
                            @case(1)
                            <td>
                                <span class="badge bg-success">Pedido Realizado</span>
                            </td>
                            @break
                            @case(2)
                            <td>
                                <span class="badge bg-danger">Producto no Fabricado</span>
                            </td>
                            @break
                            @case(3)
                            <td>
                                <span class="badge bg-danger">Proveedor no Activo</span>
                            </td>
                            @break

                            @endswitch
                            <td>{{ $pedido->fecha_registro }}</td>
                            @if ($pedido->fecha_entrega == null)
                            <td>Sin Fecha de Entrega</td>
                            @else
                            <td>{{ $pedido->fecha_entrega }}</td>
                            @endif

                            <td>

                                <ul class="list-inline m-0">
                                    @php
                                    $parameter =[
                                    'id' => $pedido->id_pedido,
                                    ];
                                    $parameter= Crypt::encrypt($parameter);
                                    @endphp
                                    <li class="list-inline-item">
                                        <a href="pedidos/edit/{{$parameter}}" class="btn btn-success btn-sm rounded-0"
                                            type="button" data-toggle="tooltip" data-placement="top" title="Editar"><i
                                                class="fal fa-pencil-alt"></i></a>
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
@push('partial-style')
<link rel="stylesheet" href="{{asset('backend/assets/css/datatables.css')}}">
@endpush

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

</script>

@endpushn