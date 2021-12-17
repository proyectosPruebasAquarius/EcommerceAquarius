@extends('backend')

@if ($type == 'add')
@section('title','Agregar Metodo de Pago') 
@else
@section('title','Edicion de Metodo de Pago')
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
                    <h4 class="card-title">Agregar Método de Pago</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{url('admin/metodos_pagos/save')}}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Tipo de pago</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre del tipo de pago" name="nombre" maxlength="100">
                                            <div  class="form-text">
                                                El nombre del <strong>Tipo de pago</strong> debe contener un máximo de 100
                                                caracteres
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Código QR</label>
                                        <input class="form-control" type="file" id="imagen"  name="qr[]" accept="image/*" multiple>
                                        <div  class="form-text">
                                            La imagen de la <strong>Marca</strong> debe contener un alguna de estas
                                            extenciones <strong>(jpeg,png,jpg,gif,svg)</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="numero" class="form-label">Número de Cuenta Bancaria, Célular o Bitcoin (Chivo Wallet)</label>

                                        <input type="text" id="numero" class="form-control"
                                            placeholder="Escriba el número de cuenta o célular" name="numero" maxlength="100">
                                            <div  class="form-text">
                                                El <strong>Número de Cuenta Bancaria, Célular o Bitcoin (Chivo Wallet)</strong> debe contener un máximo de 100
                                                caracteres
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="cuenta_asociado" class="form-label">Nombre del Asociado a la Cuenta</label>

                                        <input type="text" id="cuenta_asociado" class="form-control"
                                            placeholder="Escriba el nombre del tipo de pago" name="cuenta_asociado">
                                            <div  class="form-text">
                                                El <strong>Nombre del Asociado a la Cuenta</strong> es la persona asociada a la cuenta, debe contener un máximo de 100
                                                caracteres
                                            </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">

                                        <a href="/admin/metodos_pagos" class="btn btn-danger me-1 mb-1"><i class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit"
                                        class="btn btn-success me-1 mb-1">Enviar</button>
                                    <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edición de Metodo de Pago</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        @foreach ($metodo as $mt)
                        @php
                        $parameter =[
                            'id' =>$mt->id,
                            ];
                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" method="POST" action="{{url('admin/metodos_pagos/update/')}}/{{$parameter}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Tipo de pago</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre del tipo de pago" name="nombre" value="{{ $mt->nombre }}">
                                            <div  class="form-text">
                                                El nombre del <strong>Tipo de pago</strong> debe contener un máximo de 100
                                                caracteres
                                            </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Estado del Metodo de Pago</label>
                                        <select class="form-select" aria-label="Default select example" name="estado">
                                            @if ($mt->estado == 1)
                                            <option value="1" selected>Activo</option>
                                            <option value="0">Desactivar</option>
                                            @else
                                            <option value="1">Activar</option>
                                            <option value="0" selected>Desactivado</option>
                                            @endif

                                          </select>
                                          <div  class="form-text">
                                            El <strong>Metodo de Pago</strong> prodrá ser <strong>activa o
                                                desactivada</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="numero" class="form-label">Número de Cuenta Bancaria, Célular o Bitcoin (Chivo Wallet)</label>

                                        <input type="text" id="numero" class="form-control"
                                            placeholder="Escriba el número de cuenta o célular" maxlength="100" name="numero" value="{{ $mt->numero }}">
                                            <div  class="form-text">
                                                El <strong>Número de Cuenta Bancaria, Célular o Bitcoin (Chivo Wallet)</strong> debe contener un máximo de 100
                                                caracteres
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="cuenta_asociado" class="form-label">Nombre del Asociado a la Cuenta</label>

                                        <input type="text" id="cuenta_asociado" class="form-control"
                                            placeholder="Escriba el nombre del tipo de pago" name="cuenta_asociado" value="{{ $mt->cuenta_asociado }}">
                                            <div  class="form-text">
                                                El <strong>Nombre del Asociado a la Cuenta</strong> es la persona asociada a la cuenta, debe contener un máximo de 100
                                                caracteres
                                            </div>
                                    </div>
                                </div>                               
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Código QR</label>
                                        <input class="form-control" type="file" id="imagen"  name="qr[]" accept="image/*" multiple>
                                        <div  class="form-text">
                                            La imagen de la <strong>Marca</strong> debe contener un alguna de estas
                                            extenciones <strong>(jpeg,png,jpg,gif,svg)</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4>Imagen actual</h4>
                                    @forelse (json_decode($mt->qr) as $qr)
                                    <img src="{{ asset('/storage/imagenes/qr/'.$qr)}}" alt="QR" width="120px" height="120px" >
                                    @empty
                                        {{ __('--') }}
                                    @endforelse
                                </div>
                                <input type="hidden" value="{{$mt->qr}}" name="imagen_actual">
                                <div class="col-12 d-flex justify-content-end mt-3">

                                        <a href="/admin/metodos_pagos" class="btn btn-danger me-1 mb-1"><i class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit"
                                        class="btn btn-success me-1 mb-1">Actualizar</button>
                                    <button type="reset"
                                        class="btn btn-light-secondary me-1 mb-1">Formatear</button>
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
