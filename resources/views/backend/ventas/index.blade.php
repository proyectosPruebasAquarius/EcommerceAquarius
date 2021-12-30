@extends('backend')
@section('title', 'Ventas')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Ventas</h3>

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
    <div class="alert alert-danger alert-dismissible fade show m-5 text-center " role="alert">
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mx-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Detalle de Venta
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Detalle de Venta por Fecha</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               <form action="{{ url('admin/ventas/pdf') }}" method="post" id="formPDF">
                                @method('POST')
                                @csrf
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
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">Fecha de la Venta</label>
                                        <input type="date" id="nombre" class="form-control"
                                            placeholder="Seleccione la Fecha" name="fecha">
                                       
                                    </div>
                                </div>
                               </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="sumit" form="formPDF" class="btn btn-primary">Consultar <i class="fal fa-external-link-square-alt"></i></button>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center table-bordered pt-3 pb-3" id="prodTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Cliente</th>
                            <th>Direccion</th>
                            <th>Metodo de Pago</th>
                            <th>Total</th>
                            <th>Fecha de Registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            <td>{{ $venta->cliente }}</td>

                            <td>{{ $venta->direccion }}</td>
                            <td>{{ $venta->metodo_pago }}</td>
                            <th>${{ $venta->total }}</th>
                            <th>{{ $venta->fecha }}</th>


                            @switch($venta->estado)
                            @case(0)
                            <td>
                                <span class="badge bg-primary">Pendiente</span>
                            </td>
                            @break
                            @case(1)
                            <td>
                                <span class="badge bg-success">Aprobada</span>
                            </td>
                            @break
                            @case(2)
                            <td>
                                <span class="badge bg-warning">Aprovación Manual</span>
                            </td>
                            @break
                            @case(3)
                            <td>
                                <span class="badge bg-danger">Rechazada</span>
                            </td>
                            @break
                            @case(4)
                            <td>
                                <span class="badge bg-secondary">Venta Editada (Pendiente de Aprobación)</span>
                            </td>
                            @break

                            @endswitch


                            <td>
                                <ul class="list-inline m-0">
                                    @php
                                    $parameter = [
                                    'id' => $venta->id,
                                    ];
                                    $parameter = Crypt::encrypt($parameter);
                                    @endphp
                                    <li class="list-inline-item" data-toggle="tooltip" data-placement="top"
                                        title="Detalle de la Venta">
                                        <a href="ventas/detalle/{{ $parameter }}"
                                            class="btn btn-primary btn-sm rounded-0" type="button"><i
                                                class="fal fa-external-link"></i></a>
                                    </li>
                                    @if ($venta->estado == 2)
                                    <li class="list-inline-item">
                                        <a href="ventas/manual/{{ $parameter }}" title="Aprobación Manual"
                                            class="btn btn-warning btn-sm rounded-0" type="button"><i
                                                class="fas fa-search"></i></a>
                                    </li>
                                    @endif
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
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
                }
            });
        });
</script>

@endpush

@push('partial-style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/datatables.css') }}">
@endpush