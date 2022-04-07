@extends('backend')


@section('title', 'Detalle de Venta')


@section('content')
<section>
    <div class="row match-height mx-3">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detalle de la Venta</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <form>
                            {{-- @if ($ventas->estadoVenta == 1)
                            <span class="stamp is-approved text-center">Venta Aprobada</span>
                            @elseif($ventas->estadoVenta == 3)
                            <span class="stamp is-declined text-center">Venta Rechazada</span>

                            @endif --}}
                            <div class="row">

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Dirección:</label>
                                        <br>

                                        <label class="form-label">{{ $ventas->direccion }}</label>

                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Numero de Telefono:</label>
                                        <br>

                                        <label class="form-label">{{ $ventas->telefono }}</label>

                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Cliente:</label>
                                        <br>
                                        <label class="form-label">{{ $ventas->cliente }}</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="numero" class="form-label">Productos: </label>


                                        <br>
                                        <ul class="list-group list-group-flush">
                                            <div class="table-responsive">
                                            <table class="table">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th scope="col">Producto</th>
                                                        <th scope="col">Precio</th>
                                                        <th scope="col">Descuento</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($productos as $pt)
                                                    <tr class="text-center">
                                                        <th scope="row">{{ $pt->nombre }}</th>
                                                        <td>${{ $pt->precio_venta }}</td>
                                                        @if ($pt->oferta == null)
                                                        <td>Sin Oferta</td>
                                                        @else
                                                        <td>{{ $pt->oferta }}%</td>
                                                        @endif

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            </div>
                                        </ul>
                                        </label>

                                    </div>
                                </div>

                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="cuenta_asociado" class="form-label">Total de la venta:</label>
                                        <br>
                                        <label class="form-label">${{ $ventas->totalVenta }}</label>
                                    </div>
                                </div>

                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="cuenta_asociado" class="form-label">Estado de la venta:</label>
                                        <br>
                                        <label class="form-label">
                                            @if ($ventas->estadoVenta == 0)
                                            Pendiente de revición
                                            @elseif($ventas->estadoVenta == 1)
                                            Aprobada
                                            @elseif ($ventas->estadoVenta == 2)
                                            Aprobación Manual
                                            @else
                                            Rechazada
                                            @endif
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="cuenta_asociado" class="form-label">Numero de Transacción del
                                            deposito:</label>
                                        <br>
                                        <label class="form-label">{{ $ventas->numeroTransaccion }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="cuenta_asociado" class="form-label">Dirección de
                                            Facturación:</label>
                                        <br>
                                        <label class="form-label">
                                            @if ($ventas->facturacion == null)
                                            No hay dirección de facturación
                                            @else
                                            {{ $ventas->facturacion }}
                                            @endif

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="cuenta_asociado" class="form-label">Referencias:</label>
                                        <br>
                                        <label class="form-label">
                                            @if ($ventas->referencia == null)
                                            No hay referencias
                                            @else
                                            {{ $ventas->referencia }}
                                            @endif

                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12 text-center">
                                    <br>
                                    <h3>Imagen de revición del Cliente </h3>
                                    <br>

                                    <img src="{{ asset('storage/imagenes/datosCliente/') }}/{{ $ventas->id_usuario }}/{{ $ventas->imagenDatoVenta }}"
                                        alt="">

                                </div>


                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">

                                        <a href="{{ url('/admin/ventas') }}" class="btn btn-primary me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <form method="post" id="formApro">

                                            <button type="submit" hidden class="btn" form="formApro"></button>
                                        </form>
                                        @if ($ventas->estadoVenta == 0 || $ventas->estadoVenta == 4)
                                        <form
                                            action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                                            method="post" id="formRepro">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" value="0" name="aprobacion">
                                            <button type="submit" class="btn btn-danger me-1 mb-1"
                                                form="formRepro">Rechazar</button>
                                        </form>
                                        <form
                                            action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                                            method="post" id="formRepro2">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" value="1" name="aprobacion">
                                            <button type="submit" class="btn btn-success me-1 mb-1"
                                                form="formRepro2">Aprobar</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">

                                    @if ($ventas->estadoVenta == 0 || $ventas->estadoVenta == 4)
                                    <form
                                        action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                                        method="post" id="formRepro">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="0" name="aprobacion">
                                        <button type="submit" class="btn btn-danger me-1 mb-1"
                                            form="formRepro">Rechazar</button>
                                    </form>
                                    <form
                                        action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                                        method="post" id="formRepro2">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="1" name="aprobacion">
                                        <button type="submit" class="btn btn-success me-1 mb-1"
                                            form="formRepro2">Aprobar</button>
                                    </form>
                                    @endif
                                    <a class="btn btn-danger" type="button" href="{{ url('/admin/ventas') }}">
                                        <i class="fal fa-long-arrow-left"></i>&nbsp;Regresar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection