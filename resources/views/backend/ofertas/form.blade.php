@extends('backend')
@if ($type == 'add')
@section('title','Agregar Oferta')
@else
@section('title','Edición de Oferta')
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
                    <h4 class="card-title">Agregar Oferta</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{url('admin/ofertas/save')}}">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre de la oferta</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre de la oferta" name="nombre" maxlength="200">
                                        <div class="form-text">
                                            El nombre de la <strong>Oferta</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="date" class="form-label date">Fecha Limite de la oferta</label>
                                        <input type="date" id="date" class="form-control" name="limite">
                                        <div class="form-text">
                                            La <strong>Fecha Limite</strong> determinará la duración de la Oferta
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="tipo_oferta" class="form-label">Tipo de Oferta</label>

                                        <select class="tipo_oferta form-control" name="tipo_oferta" id="tipo_oferta">
                                            <option></option>
                                        </select>
                                        <div class="form-text">
                                            El <strong>Tipo de Oferta</strong> determinará a que campo irá dirigida la
                                            oferta
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                        <a href="/admin/ofertas" class="btn btn-danger me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit" class="btn btn-success me-1 mb-1">Guardar <i class="fal fa-save"></i></button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear <i class="fal fa-sync-alt"></i></button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                    <button class="btn btn-success" type="submit" form="prodForm">Guardar <i class="fal fa-save"></i></button>
                                    <a class="btn btn-danger" type="button" href="{{ url('/admin/marcas') }}">
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
                    <h4 class="card-title">Editar Oferta</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        @foreach ($ofertas as $oferta)
                        @php
                        $parameter =[
                        'id' =>$oferta->id_oferta,
                        ];
                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" method="POST" action="{{url('admin/ofertas/update/')}}/{{$parameter}}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre de la oferta</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre de la oferta" name="nombre" maxlength="200"
                                            value="{{$oferta->nombre}}">
                                        <div class="form-text">
                                            El nombre de la <strong>Oferta</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Fecha Limite de la oferta</label>
                                        <input type="date" id="date" class="form-control" name="limite"
                                            value="{{$oferta->tiempo_limite}}">
                                        <div class="form-text">
                                            La <strong>Fecha Limite</strong> determinará la duración de la Oferta
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Tipo de Oferta</label>

                                        <select class="tipo_oferta form-select form-control" name="tipo_oferta"
                                            id="tipo_oferta">
                                            <option value="{{$oferta->id_tipo_oferta}}">{{$oferta->tipo_oferta}}
                                            </option>
                                        </select>
                                        <div class="form-text">
                                            El <strong>Tipo de Oferta</strong> determinará a que campo irá dirigida la
                                            oferta
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-3">
                                    <div class="form-group">
                                        <label for="imagen" class="form-label">Estado</label>
                                        <select class="form-select" aria-label="Default select example" name="estado">
                                            @if ($oferta->estado == 1)
                                            <option value="1" selected>Activa</option>
                                            <option value="0">Desactivar</option>
                                            @else
                                            <option value="1">Activar</option>
                                            <option value="0" selected>Desactivada</option>
                                            @endif

                                        </select>
                                        <div class="form-text">
                                            El <strong>estado de la Oferta</strong> prodrá ser <strong>activa o
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