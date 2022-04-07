@extends('backend')
@if ($type == 'add')
@section('title','Agregar tipo Oferta')
@else
@section('title','Edición de tipo Oferta')
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
                    <h4 class="card-title">Agregar Tipo de Oferta</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{url('admin/ofertas/tipos/save')}}">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre del tipo de Oferta</label>
                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre del oferta" name="nombre" maxlength="200">
                                        <div class="form-text">
                                            El nombre de la <strong>Oferta</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                        <a href="{{ asset('/admin/ofertas') }}" class="btn btn-danger me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar <i class="fal fa-save"></i></button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear <i class="fal fa-sync-alt"></i></button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                    <button class="btn btn-success" type="submit" form="prodForm">Guardar <i class="fal fa-save"></i></button>
                                    <a class="btn btn-danger" type="button" href="{{ url('/admin/ofertas') }}">
                                        <i class="fal fa-long-arrow-left"></i>&nbsp;Regresar
                                    </a>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edición de Tipo de oferta</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        @foreach ($tipos as $tipo)
                        @php
                        $parameter =[
                        'id' =>$tipo->id,
                        ];
                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" method="POST" action="{{url('admin/ofertas/tipos/update/')}}/{{$parameter}}">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre</label>

                                        <input type="text" id="name" class="form-control" maxlength="200" placeholder=""
                                            name="nombre" value="{{$tipo->nombre}}">
                                        <div class="form-text">
                                            El nombre de la <strong>Oferta</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Estado</label>
                                        <select class="form-select" aria-label="Default select example" name="estado">
                                            @if ($tipo->estado == 1)
                                            <option value="1" selected>Activa</option>
                                            <option value="0">Desactivar</option>
                                            @else
                                            <option value="1">Activar</option>
                                            <option value="0" selected>Desactivada</option>
                                            @endif

                                        </select>
                                        <div class="form-text">
                                            El <strong>estado del tipo Oferta</strong> prodrá ser <strong>activa o
                                                desactivada</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                        <a href="{{ asset('/admin/ofertas') }}" class="btn btn-danger me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit" class="btn btn-success me-1 mb-1">Actualizar <i class="fal fa-save"></i></button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear <i class="fal fa-sync-alt"></i></button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                    <button class="btn btn-success" type="submit" form="prodForm">Actualizar <i class="fal fa-save"></i></button>
                                    <a class="btn btn-danger" type="button" href="{{ url('/admin/ofertas') }}">
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
@push('datatable-scripts')
<script type="text/javascript">
    $(document).ready(function(){

      $( ".tipo_oferta" ).select2({
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
          url: "{{url('admin/ofertas/select')}}",
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