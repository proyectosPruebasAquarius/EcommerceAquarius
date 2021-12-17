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
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Direccion:</label>
                                                <br>

                                                <label class="form-label">{{ $ventas->direccion }}</label>

                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Numero de Telefono:</label>
                                                <br>

                                                <label class="form-label">{{ $ventas->telefono }}</label>

                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="imagen" class="form-label">Cliente:</label>
                                                <br>
                                                <label class="form-label">{{ $ventas->cliente }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="cuenta_asociado" class="form-label">Total de la
                                                    venta:</label>
                                                <br>
                                                <label class="form-label">${{ $ventas->totalVenta }}</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="cuenta_asociado" class="form-label">Estado de la
                                                    venta:</label>
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
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="cuenta_asociado" class="form-label">Numero de Transacción
                                                    del deposito:</label>
                                                <br>
                                                <label class="form-label">{{ $ventas->numeroTransaccion }}</label>
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-12 text-center">
                                            <br>
                                            <h3>Imagen de revición del Cliente </h3>
                                            <br>

                                            <img src="{{ asset('storage/imagenes/datosCliente/') }}/{{ $ventas->id_usuario }}/{{ $ventas->imagenDatoVenta }}"
                                                alt="">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="col-md-12 col-12">
                                            <h3 class="mb-3 text-center"> Productos de la Compra </h3>
                                            <table class="table">
                                                <thead class="bg-primary text-center text-white">
                                                    <tr>

                                                        <th scope="col">Producto</th>
                                                        <th scope="col">Stock Disponible</th>
                                                        <th scope="col">Cantidad de la compra</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @foreach ($productos as $p)
                                                        <tr>
                                                            <td>
                                                                {{ $p->nombre }}
                                                            </td>
                                                            <td>
                                                                {{ $p->stock }}
                                                            </td>
                                                            <td>
                                                                {{ $p->cantidad }}
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            <form
                                                action="{{ url('admin/ventas/manual/update') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                                                method="post" id="formDel">
                                                @method('PUT')
                                                @csrf
                                                <div class="list-group">
                                                    @foreach ($productos as $p)
                                                        <label class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox"
                                                                value="{{ $p->id_prod }}" name="producto[]">
                                                            {{ $p->nombre }}
                                                        </label>
                                                    @endforeach
                                                    <label class="list-group-item">
                                                        <input class="form-control me-1" type="text" name="descuento"
                                                            placeholder="$ Cantida a descontar">
                                                        <button type="submit" form="formDel"
                                                            class="btn btn-danger me-1 mb-1 mt-3" form="formMail"><i
                                                                class="fal fa-sort-numeric-down"></i> Descontar
                                                            Producto</button>
                                                    </label>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="col-12 d-flex justify-content-end mt-3">
                                            <form action="{{ url('admin/ventas/enviar/mail') }}" method="post"
                                                id="formMail">
                                                @method('POST')
                                                @csrf
                                                <input type="hidden" value="{{ $ventas->id_venta }}" name="id_venta">
                                                <input type="hidden" value="{{ $ventas->id_usuario }}" name="usuario">

                                                <button type="submit" class="btn btn-success" form="formMail"><i
                                                        class="fal fa-envelope"></i> Enviar Correo al Cliente</button>
                                            </form>


                                        </div>
                                        @if (\Session::has('message'))

                                            @switch(\Session::get('type'))


                                                @case('success')
                                                    <div class="alert alert-success alert-dismissible fade show m-5 text-center"
                                                        role="alert">
                                                        <i class="fal fa-check-circle"></i>
                                                        <strong>{!! \Session::get('message') !!}</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @break
                                                @case('danger')
                                                    <div class="alert alert-danger alert-dismissible fade show m-5 text-center "
                                                        role="alert">
                                                        <i class="fal fa-check-circle"></i>
                                                        <strong>{!! \Session::get('message') !!}</strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @break
                                            @endswitch
                                        @endif

                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-3">

                                        <a href="/admin/ventas" class="btn btn-primary me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
