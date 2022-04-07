@extends('backend')

@if ($type == 'add')
@section('title','Nuevo Inventario')
@else
@section('title','Edición de Inventario')
@endif

@section('content')
@if ($type == 'add')
<section id="multiple-column-form">
    <div class="row match-height">
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
                    <h4 class="card-title">Agregar inventario</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{url('admin/inventarios/save')}}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column" class="form-label">Precio de compra</label>
                                        <input type="text" class="form-control" name="precio_compra" min=0
                                            placeholder="Precio de compra">
                                        <div class="form-text">
                                            El <strong>Precio de compra</strong> puede incluir 2 decimales
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column" class="form-label">Precio de venta</label>
                                        <input type="number" class="form-control" name="precio_venta" min=0
                                            placeholder="Precio de venta">
                                        <div class="form-text">
                                            El <strong>Precio de venta</strong> puede incluir 2 decimales
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="city-column" class="form-label">Código del producto</label>
                                        <input type="text" id="city-column" class="form-control"
                                            placeholder="Código del producto" name="codigo" maxlength="500">
                                        <div class="form-text">
                                            El <strong>Codigo del producto</strong> debe contener un máximo de
                                            500 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Stock</label>
                                        <input type="number" class="form-control" name="stock" min=0
                                            placeholder="Stock del Producto">
                                        <div class="form-text">
                                            El <strong>Stock del producto</strong> deben ser caracteres numericos
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Stock Mínimo</label>
                                        <input type="number" class="form-control" name="min_stock" min=0
                                            placeholder="Stock Minimo del producto">
                                        <div class="form-text">
                                            El <strong>Stock Minimo del producto</strong> deben ser caracteres
                                            numericos. El stock mínino activará una notificaión para el administrador
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="producto" class="form-label">Producto</label>
                                        <select name="producto" id="producto" class="productos form-select"></select>
                                        <div class="form-text">
                                            El <strong>Producto</strong> que selecciones será al cual se le atribuirá el
                                            inventario actual
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="oferta" class="form-label">Oferta</label>
                                        <select name="oferta" id="oferta" class="ofertas form-select"></select>
                                        <div class="form-text">
                                            La <strong>Oferta</strong> que selecciones será al cual se le atribuirá el
                                            inventario actual
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                        <a href="{{ url('/admin/inventarios') }}" class="btn btn-danger me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar <i class="fal fa-save"></i></button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear <i  class="fal fa-sync-alt"></i> </button>
                                    </div>
                                </div>


                                <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                    <button class="btn btn-success" type="submit" form="prodForm">Guardar <i class="fal fa-save"></i></button>
                                    <a class="btn btn-danger" type="button" href="{{ url('/admin/inventarios') }}">
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
@else
<section id="multiple-column-form">
    <div class="row match-height">
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
                    <h4 class="card-title">Edición de inventario</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @foreach ($inventarios as $inventario)
                        @php
                        $parameter =[
                        'id' =>$inventario->id_inventario,
                        ];
                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" action="{{url('admin/inventarios/update')}}/{{$parameter}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column" class="form-label">Precio de compra</label>
                                        <input type="text" class="form-control" name="precio_compra" min=0 step="any"
                                            value="{{$inventario->precio_compra}}">
                                        <div class="form-text">
                                            El <strong>Precio de compra</strong> puede incluir 2 decimales
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column" class="form-label">Precio de venta</label>
                                        <input type="text" class="form-control" name="precio_venta" step="any" min=0
                                            value="{{$inventario->precio_venta}}">
                                        <div class="form-text">
                                            El <strong>Precio de venta</strong> puede incluir 2 decimales
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="city-column" class="form-label">Codigo del producto</label>
                                        <input type="text" id="city-column" class="form-control" name="codigo"
                                            value="{{$inventario->codigo}}">
                                        <div class="form-text">
                                            El <strong>Codigo del producto</strong> debe contener un máximo de
                                            500 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Stock del producto</label>
                                        <input type="number" class="form-control" name="stock" min=0
                                            value="{{$inventario->stock}}">
                                        <div class="form-text">
                                            El <strong>Stock del producto</strong> deben ser caracteres numericos
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Stock Mínimo del
                                            producto</label>
                                        <input type="number" class="form-control" name="min_stock" min=0
                                            value="{{$inventario->min_stock}}">
                                        <div class="form-text">
                                            El <strong>Stock Minimo del producto</strong> deben ser caracteres
                                            numericos. El
                                            stock mínino activará una notificaión para el administrador
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="producto" class="form-label">Producto</label>
                                        <select name="producto" id="producto" class="productos form-select">

                                            <option value="{{$inventario->id_producto}}">{{$inventario->producto}}
                                            </option>
                                        </select>
                                        <div class="form-text">
                                            El <strong>Producto</strong> que selecciones será al cual se le atribuirá el
                                            inventario actual
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="oferta" class="form-label">Oferta</label>
                                        <select name="oferta" id="oferta" class="ofertas form-select">

                                            <option value="{{$inventario->id_oferta}}">{{$inventario->oferta}}</option>
                                        </select>
                                        <div class="form-text">
                                            La <strong>Oferta</strong> que selecciones será al cual se le atribuirá el
                                            inventario actual
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="estado" class="form-label">Estado</label>

                                        @if ($inventario->estado == 1)
                                        <select name="estado" id="estado" class=" form-select">
                                            <option value="1" selected>Activo</option>
                                            <option value="0">Desactivar</option>
                                        </select>
                                        @else
                                        <select name="estado" id="estado" class=" form-select">
                                            <option value="1">Activar</option>
                                            <option value="0" selected>Desactivado</option>
                                        </select>
                                        @endif
                                        <div class="form-text">
                                            El <strong>estado del Inventario</strong> prodrá ser <strong>activo o
                                                desactivado</strong>
                                        </div>

                                    </div>
                                </div>

                                @endforeach

                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/inventarios" class="btn btn-danger me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                    <button type="submit" class="btn btn-success me-1 mb-1">Enviar</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                </div>
                            </div>
                        </form>
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

      $( ".productos" ).select2({
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
          url: "{{url('admin/inventarios/selectp')}}",
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

        $( ".ofertas" ).select2({
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
            url: "{{url('admin/inventarios/selecto')}}",
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