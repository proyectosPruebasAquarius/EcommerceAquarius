@extends('backend')
@if ($type == 'add')
@section('title','Agregar Producto')
@else
@section('title','Edición de Producto')
@endif
@section('content')

@if ($type == 'add')
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
                    <h4 class="card-title">Agregar Producto</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" id="prodForm" action="{{url('admin/productos/save')}}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">Nombre del producto</label>
                                        <input type="text" id="nombre" class="form-control" name="nombre"
                                            placeholder="Escriba el nombre del producto"  max="200">
                                        <div class="form-text">
                                            El nombre del <strong>Producto</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Imagenes del Producto</label>
                                        <input class="form-control" type="file" id="imagen" accept="image/*"
                                            name="imagen[]" multiple>
                                        <div class="form-text">
                                            Las imagenes del <strong>Producto</strong> debe contener un alguna de estas
                                            extenciones <strong>(jpeg,png,jpg,gif,svg)</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="city-column" class="form-label">Descripción del Producto</label>

                                        <textarea class="form-control" placeholder="Escriba la descripción"
                                            id="textareaDescripcion" style="height: 100px"
                                            name="descripcion"></textarea>
                                        <div class="form-text">
                                            La descripción del <strong>Producto</strong> debe contener un máximo de
                                            1500 caracteres
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="categoria">Categoria</label>
                                        <select class="categorias form-select" name="categoria" id="categoria">
                                            <option></option>
                                        </select>
                                        <div class="form-text">
                                            La <strong>Categoria</strong> determinará a que clientes irá dirigido el
                                            Producto
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label class="form-label" for="marca">Marca</label>
                                        <select class="marcas form-select" name="marca" id="marca">
                                            <option></option>
                                        </select>
                                        <div class="form-text">
                                            La <strong>Marca</strong> determinará a que clientes irá dirigido el
                                            Producto
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label class="form-label" for="proveedor">Proveedor</label>
                                        <select class="proveedores form-select" name="proveedor" id="proveedor">
                                            <option></option>
                                        </select>
                                        <div class="form-text">
                                            El <strong>Proveedor</strong> es la entidad que proporciona el Producto
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label class="form-label" for="subcat">Sub Categoria</label>
                                        <select class="subcats form-select" name="subcat" id="subcat">
                                            <option></option>
                                        </select>
                                        <div class="form-text">
                                            La <strong>Sub Categoria</strong> determinará a que clientes irá dirigido el
                                            Producto
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/productos" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" form="prodForm" class="btn btn-success me-1 mb-1">Enviar
                                        &nbsp;<i class="fal fa-arrow-up"></i></button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear &nbsp; <i
                                            class="fal fa-sync-alt"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
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
                    <h4 class="card-title">Editar Producto</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @foreach ($productos as $producto)
                        @php
                        $parameter =[
                        'id' =>$producto->id,
                        ];
                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" method="POST" id="prodForm"
                            action="{{url('admin/productos/update')}}/{{$parameter}}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-2 col-2">
                                    <div class="form-group">
                                        <label for="nombre" class="form-label">Nombre del producto</label>
                                        <input type="text" id="nombre" class="form-control" name="nombre2"
                                            placeholder="Escriba el nombre del producto" value="{{$producto->nombre}}"
                                            max="200">
                                        <div class="form-text">
                                            El nombre del <strong>Producto</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Imagenes del Producto</label>
                                        <input class="form-control" type="file" id="imagen" accept="image/*"
                                            name="imagen[]" multiple>
                                        <div class="form-text">
                                            Las imagenes del <strong>Producto</strong> debe contener un alguna de estas
                                            extenciones <strong>(jpeg,png,jpg,gif,svg)</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="city-column" class="form-label">Descripcion del Producto</label>

                                        <textarea class="form-control" placeholder="Escriba la descripcion"
                                            id="textareaDescripcion" style="height: 100px"
                                            name="descripcion">{{$producto->descripcion}}</textarea>
                                        <div class="form-text">
                                            La descripción del <strong>Producto</strong> debe contener un máximo de
                                            1500 caracteres
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <select class="categorias form-select" name="categoria" id="categoria">
                                            <option value="{{$producto->id_categoria}}">{{$producto->categoria}}
                                            </option>
                                        </select>
                                        <div class="form-text">
                                            La <strong>Categoria</strong> determinará a que clientes irá dirigido el
                                            Producto
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="marca" class="form-label">Marca</label>
                                        <select class="marcas form-select" name="marca" id="marca">
                                            <option value="{{$producto->id_marca}}">{{$producto->marca}}</option>
                                        </select>
                                        <div class="form-text">
                                            La <strong>Marca</strong> determinará a que clientes irá dirigido el
                                            Producto
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="proveedor" class="form-label">Proveedor</label>
                                        <select class="proveedores form-select" name="proveedor" id="proveedor">
                                            <option value="{{$producto->id_proveedor}}">{{$producto->proveedor}}
                                            </option>
                                        </select>
                                        <div class="form-text">
                                            El <strong>Proveedor</strong> es la entidad que proporciona el Producto
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="subcat" class="form-label">Sub Categoria</label>
                                        <select class="subcats form-select" name="subcat" id="subcat">
                                            <option value="{{$producto->id_subcategoria}}">{{$producto->subcat}}
                                            </option>
                                        </select>
                                        <div class="form-text">
                                            La <strong>Sub Categoria</strong> determinará a que clientes irá dirigido el
                                            Producto
                                        </div>
                                    </div>
                                </div>

                                <h4 class="text-center pt-5 pb-5">Imagenes del producto</h4>

                                @foreach(json_decode($producto->imagen) as $key => $value)
                                <div class="col-md-6 col-12">
                                    <div class="form-group">


                                        <img src="{{ $value }}" class="d-block img-fluid " alt="Product Image">


                                    </div>
                                </div>
                                @endforeach


                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/productos" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" form="prodForm" class="btn btn-success me-1 mb-1">Actualizar
                                        &nbsp;<i class="fal fa-arrow-up"></i></button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear &nbsp; <i
                                            class="fal fa-sync-alt"></i></button>
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
@endif
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

    $(document).ready(function(){

        $( ".marcas" ).select2({
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
            url: "{{url('admin/productos/selectm')}}",
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


     $(document).ready(function(){

        $( ".proveedores" ).select2({
        placeholder: "Selecciona una opción",
        width: 'resolve',
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
            url: "{{url('admin/productos/selectp')}}",
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



    $(document).ready(function(){

$( ".subcats" ).select2({
placeholder: "Selecciona una opción",
width: 'resolve',
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
    url: "{{url('admin/productos/selectsub')}}",
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