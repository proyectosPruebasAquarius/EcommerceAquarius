@extends('backend')

@if ($type == 'add')
@section('title','Agregar Categoria')
@elseif ($type == 'add-sub')
@section('title','Agregar Sub Categoria')
@else
@section('title','Edición Categoria')
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


            @if ($type == 'add-sub')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agregar sub Categoria</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{url('admin/categorias/subsave')}}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre de la sub categoria</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre de la categoria" name="nombre"
                                            maxlength="200">
                                        <div class="form-text">
                                            El nombre de la <strong>Sub Categoria</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Categoria pricipal</label>

                                        <select class="categorias form-control" name="categoria">
                                            <option></option>
                                        </select>
                                        <div class="form-text">
                                            Selecciona la <strong>Categoria Principal</strong> de la <strong>Sub
                                                Categoria</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/categorias" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" class="btn btn-success me-1 mb-1">Enviar</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            @if ($type == 'add')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agregar Categoria</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{url('admin/categorias/save')}}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre de la categoria</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre de la categoria" name="nombre"
                                            maxlength="200">
                                        <div class="form-text">
                                            El nombre de la <strong>Categoria</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/categorias" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" class="btn btn-success me-1 mb-1">Enviar</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editar Categoria</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        @foreach ($categorias as $categoria)
                        @php
                        $parameter =[
                        'id' =>$categoria->id,
                        ];

                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" method="POST" action="{{url('admin/categorias/update/')}}/{{$parameter}}"
                            id="updateForm">
                            @method('PUT')
                            @csrf

                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre de la categoria</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre de la categoria" name="nombre"
                                            value="{{$categoria->nombre}}" maxlength="200">

                                        <div class="form-text">
                                            El nombre de la <strong>Categoria</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Estado de la categoria</label>
                                        <select class="form-select" aria-label="Default select example" name="estado">
                                            @if ($categoria->estado == 1)
                                            <option value="1" selected>Activa</option>
                                            <option value="0">Desactivar</option>
                                            @else
                                            <option value="1">Activar</option>
                                            <option value="0" selected>Desactivada</option>
                                            @endif

                                        </select>
                                        <div class="form-text">
                                            El <strong>estado de la Categoria</strong> prodrá ser <strong>activa o
                                                desactivada</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/categorias" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" class="btn btn-success me-1 mb-1"
                                        form="updateForm">Actualizar</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                </div>
                            </div>


                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @endif
        </div>
    </div>
</section>
@endsection






@push('datatable-scripts')
<script type="text/javascript">
    $(document).ready(function(){

      $( ".categorias" ).select2({
        placeholder: "Selecciona una opción",
        language: {

            noResults: function() {

            return "No hay resultado";        
            },
            searching: function() {

            return "Buscando..";
            }

        },
       
        ajax: { 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json, text-plain, */*',
                "X-Requested-With": "XMLHttpRequest",
                'Content-Type': 'application/json'
            },
          url: "{{url('admin/categorias/select')}}",
          type: "get",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
                _token: '{!! csrf_token() !!}',
              q: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

    });
</script>
@endpush