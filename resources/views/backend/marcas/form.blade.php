@extends('backend')

@if ($type == 'add')
    @section('title', 'Nueva Marca')
@else
    @section('title', 'Edición de Marca')
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
                            <h4 class="card-title">Nueva Marca</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="POST" action="{{ url('admin/marcas/save') }}"
                                    enctype="multipart/form-data">
                                    @method('POST')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">Nombre de la marca </label>

                                                <input type="text" id="name" class="form-control"
                                                    placeholder="Escriba el nombre de la marca" name="nombre"
                                                    maxlength="200">
                                                <div  class="form-text">
                                                    El nombre de la <strong>Marca</strong> debe contener un máximo de 200
                                                    caracteres
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="imagen" class="form-label">Imagen de la marca</label>
                                                <input class="form-control" type="file" id="imagen" name="imagen"
                                                    accept="image/*">
                                                <div  class="form-text">
                                                    La imagen de la <strong>Marca</strong> debe contener un alguna de estas
                                                    extenciones <strong>(jpeg,png,jpg,gif,svg)</strong>,con un máximo de 1
                                                    imagen
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end mt-3">
                                            <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                                <a href="{{ asset('/admin/marcas') }}" class="btn btn-danger me-1 mb-1"><i
                                                    class="fal fa-long-arrow-left"></i> Regresar</a>
                                            <button type="submit" class="btn btn-success me-1 mb-1">Enviar</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                            </div>

                                            <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                                <button class="btn btn-success" type="submit" form="prodForm">Guardar <i class="fal fa-save"></i></button>
                                                <a class="btn btn-danger" type="button" href="{{ url('/admin/marcas') }}">
                                                    <i class="fal fa-long-arrow-left"></i>&nbsp;Regresar
                                                </a>
                                                
                                              </div>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edición Marca</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                @foreach ($marcas as $marca)
                                    @php
                                        $parameter = [
                                            'id' => $marca->id,
                                        ];
                                        $parameter = Crypt::encrypt($parameter);
                                    @endphp
                                    <form class="form" method="POST"
                                        action="{{ url('admin/marcas/update/') }}/{{ $parameter }}"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Nombre de la marca</label>

                                                    <input type="text" id="name" class="form-control"
                                                        placeholder="Escriba el nombre de la marca" name="nombre"
                                                        value="{{ $marca->nombre }}">
                                                    <div  class="form-text">
                                                        El nombre de la <strong>Marca</strong> debe contener un máximo de
                                                        200 caracteres
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="imagen" class="form-label">Actualizar Imagen</label>
                                                    <input class="form-control" type="file" id="imagen" name="imagen"
                                                        accept="image/*">
                                                    <div  class="form-text">
                                                        La imagen de la <strong>Marca</strong> debe contener un alguna de
                                                        estas extenciones <strong>(jpeg,png,jpg,gif,svg)</strong>,con un
                                                        máximo de 1 imagen
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group text-center">
                                                    <label for="imagen" class="form-label">Imagen actual de la
                                                        marca</label>
                                                    <br>
                                                    <img src="{{ asset('/storage/imagenes/marcas/') }}/{{ $marca->imagen }}"
                                                        alt="" class="w-25">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="imagen" class="form-label">Estado de la marca</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="estado">
                                                        @if ($marca->estado == 1)
                                                            <option value="1" selected>Activa</option>
                                                            <option value="0">Desactivar</option>
                                                        @else
                                                            <option value="1">Activar</option>
                                                            <option value="0" selected>Desactivada</option>
                                                        @endif

                                                    </select>
                                                    <div  class="form-text">
                                                        El <strong>estado de la Marca</strong> prodrá ser <strong>activa o
                                                            desactivada</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $marca->imagen }}" name="imagen_actual">
                                            <div class="col-12 d-flex justify-content-end mt-3">
                                                <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                                    <a href="{{ asset('/admin/marcas') }}" class="btn btn-danger me-1 mb-1"><i
                                                        class="fal fa-long-arrow-left"></i> Regresar</a>
                                                <button type="submit" class="btn btn-success me-1 mb-1">Actualizar</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                                </div>
                                                

                                            </div>
                                            <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                                <button class="btn btn-success" type="submit" form="prodForm">Actualizar <i class="fal fa-save"></i></button>
                                                <a class="btn btn-danger" type="button" href="{{ url('/admin/marcas') }}">
                                                    <i class="fal fa-long-arrow-left"></i>&nbsp;Regresar
                                                </a>
                                                
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
