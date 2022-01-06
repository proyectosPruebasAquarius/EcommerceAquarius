@extends('backend')


@section('title','Detalle de Pedido')




@section('content')
<section>
    <div class="row match-height mx-3">

        <div class="col-12">
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edición de Pedido</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @foreach ($pedidos as $pedido)
                        <form class="form" method="POST" action="{{ url('admin/pedidos/update') }}/{{ Crypt::encrypt($pedido->id_pedido) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                          
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Código del Producto </label>

                                        <input type="text" id="name" class="form-control"
                                            value="{{ $pedido->codigo_producto }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Producto</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ $pedido->producto }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Precio de Compra</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ $pedido->precio_compra }}" name="precio_compra">

                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Proveedor</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ $pedido->proveedor }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Dirección del Proveedor</label>
                                        <textarea cols="4" rows="2" class="form-control"
                                            disabled>{{ $pedido->direc_proveedor}}</textarea>

                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Telefono del Proveedor</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ $pedido->tel_proveedor }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Contacto del Proveedor</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ $pedido->contacto }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Telefono del Contacto</label>
                                        <input type="text" id="name" class="form-control"
                                            value="{{ $pedido->tel_contacto }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Estado del Proveedor</label>
                                        @if ($pedido->estado_proveedor == 1)
                                        <input type="text" id="name" class="form-control" value="Activo" disabled>
                                        @else
                                        <input type="text" id="name" class="form-control" value="Desactivado" disabled>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Fecha de Entrega</label>
                                        @if ( $pedido->fecha_entrega == null )
                                        <input type="date" id="name" class="form-control" name="fecha_entrega">
                                        <div class="form-text">
                                            No hay fecha de entrega para este pedido
                                        </div>
                                        @else
                                        <input type="date" id="name" class="form-control" name="fecha_entrega"
                                            value="{{ $pedido->fecha_entrega }}">
                                        @endif


                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Estado del Pedido</label>
                                        <select name="estado_pedido" class="form-select">
                                            @switch($pedido->estado_pedido)
                                            @case(0)
                                            <option value="0" selected>Pendiente de Pedido</option>
                                            <option value="1">Pedido Realizado</option>
                                            <option value="2">Producto no Fabricado</option>
                                            <option value="3">Proveedor no Activo</option>
                                            @break
                                            @case(1)
                                            <option value="0">Pendiente de Pedido</option>
                                            <option value="1" selected>Pedido Realizado</option>
                                            <option value="2">Producto no Fabricado</option>
                                            <option value="3">Proveedor no Activo</option>
                                            @break
                                            @case(2)
                                            <option value="0">Pendiente de Pedido</option>
                                            <option value="1">Pedido Realizado</option>
                                            <option value="2" selected>Producto no Fabricado</option>
                                            <option value="3">Proveedor no Activo</option>
                                            @break
                                            @case(3)
                                            <option value="0">Pendiente de Pedido</option>
                                            <option value="1">Pedido Realizado</option>
                                            <option value="2">Producto no Fabricado</option>
                                            <option value="3" selected>Proveedor no Activo</option>
                                            @break
                                            @endswitch
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Cantidad del Producto</label>
                                        <input type="number" id="name" name="cantidad" class="form-control" value="{{ $pedido->cantidad }}" >

                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/pedidos " class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" class="btn btn-success me-1 mb-1">Enviar</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                </div>
                            </div>
                           
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection