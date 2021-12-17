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
                            @forelse ($ventas as $venta)
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
                            @empty
                                <tr>
                                    <p class="text-center title">No se encontraron registros de datos...</p>
                                </tr>
                            @endforelse


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
