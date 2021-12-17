@extends('backend')

@if ($type == 'add')
@section('title','Agregar Proveedor')
@else
@section('title','Edición de Proveedor')
@endif
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

            @if ($type == 'add')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agregar Proveedor</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{url('admin/proveedores/save')}}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre del proveedor</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre del proveedor" name="nombre" maxlength="100">
                                        <div class="form-text">
                                            El nombre del <strong>Proveedor</strong> debe contener un máximo de
                                            100 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Direccion del proveedor</label>

                                        <input type="text" id="address" class="form-control"
                                            placeholder="Escriba la direccion del proveedor" name="direccion"
                                            maxlength="500">
                                        <div class="form-text">
                                            La Dirección del <strong>Proveedor</strong> debe contener un máximo de
                                            500 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="telefono" class="form-label">Telefono del proveedor</label>

                                        <input type="text" id="telefono" class="form-control" maxlength="8"
                                            placeholder="Escriba el telefono del proveedor" name="telefono">
                                        <div class="form-text">
                                            El Numero de Telefonó del <strong>Proveedor</strong> debe contener un máximo
                                            de
                                            8 caracteres numericos
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contacto" class="form-label">Nombre del contacto</label>

                                        <input type="text" id="contacto" class="form-control"
                                            placeholder="Escriba el nombre del contacto" name="contacto"
                                            maxlength="100">
                                        <div class="form-text">
                                            El <strong>Nombre del Contacto</strong> debe contener un máximo de
                                            100 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="telcontacto" class="form-label">Telefono del contacto</label>

                                        <input type="text" id="telcontacto" class="form-control" maxlength="8"
                                            placeholder="Escriba el telefono del contacto" name="telcontacto">
                                        <div class="form-text">
                                            El Numero de Telefonó del <strong>Contacto</strong> debe contener un máximo
                                            de
                                            8 caracteres numericos
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/proveedores" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" class="btn btn-success me-1 mb-1">Enviar &nbsp;<i
                                            class="fal fa-arrow-up"></i></button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear &nbsp; <i
                                            class="fal fa-sync-alt"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editar Proveedor</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        @foreach ($proveedores as $proveedor)
                        @php
                        $parameter =[
                        'id' =>$proveedor->id,
                        ];
                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" method="POST" action="{{url('admin/proveedores/update/')}}/{{$parameter}}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre del proveedor</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre delproveedor" name="nombre"
                                            value="{{$proveedor->nombre}}" maxlength="100">
                                        <div class="form-text">
                                            El nombre del <strong>Proveedor</strong> debe contener un máximo de
                                            100 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Direccion del proveedor</label>

                                        <input type="text" id="address" class="form-control"
                                            placeholder="Escriba la direccion del proveedor" name="direccion"
                                            value="{{$proveedor->direccion}}" maxlength="500">
                                        <div class="form-text">
                                            La Dirección del <strong>Proveedor</strong> debe contener un máximo de
                                            500 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="telefono" class="form-label">Teléfono del proveedor</label>

                                        <input type="text" id="telefono" class="form-control" maxlength="8"
                                            placeholder="Escriba el numeró de teléfono del proveedor" name="telefono"
                                            value="{{$proveedor->telefono}}">
                                        <div class="form-text">
                                            El Numero de Telefonó del <strong>Proveedor</strong> debe contener un máximo
                                            de
                                            8 caracteres numericos
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contacto" class="form-label">Nombre del contacto</label>

                                        <input type="text" id="contacto" class="form-control"
                                            placeholder="Escriba el nombre del contacto" name="contacto"
                                            value="{{$proveedor->nombre_contacto}}" maxlength="100">
                                        <div class="form-text">
                                            El <strong>Nombre del Contacto</strong> debe contener un máximo de
                                            100 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="telcontacto" class="form-label">Teléfono del contacto</label>

                                        <input type="text" id="telcontacto" class="form-control" maxlength="8"
                                            placeholder="Escriba  el numeró de teléfono del contacto" name="telcontacto"
                                            value="{{$proveedor->tel_contacto}}">
                                        <div class="form-text">
                                            El Numero de Telefonó del <strong>Contacto</strong> debe contener un máximo
                                            de
                                            8 caracteres numericos
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Estado del proveedor</label>
                                        <select class="form-select" aria-label="Default select example" name="estado">
                                            @if ($proveedor->estado == 1)
                                            <option value="1" selected>Activa</option>
                                            <option value="0">Desactivar</option>
                                            @else
                                            <option value="1">Activar</option>
                                            <option value="0" selected>Desactivada</option>
                                            @endif

                                        </select>
                                        <div class="form-text">
                                            El <strong>estado del Proveedor</strong> prodrá ser <strong>activa o
                                                desactivada</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/proveedores" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" class="btn btn-success me-1 mb-1">Actualizar &nbsp;<i
                                            class="fal fa-arrow-up"></i></button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear &nbsp; <i
                                            class="fal fa-sync-alt"></i></button>
                                </div>
                            </div>


                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection