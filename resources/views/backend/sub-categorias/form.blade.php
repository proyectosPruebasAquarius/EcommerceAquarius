@extends('backend')

@if ($type == 'add')
@section('title','Nueva Sub Categoria')
@else
@section('title','Edición de Sub Categoria')
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
                    <h4 class="card-title">Nueva Sub Categoria</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{url('admin/sub-categorias/save')}}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
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
                                <div class="col-md-6 col-12">
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
                                    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                        <a href="{{ url('/admin/sub-categorias') }}" class="btn btn-danger me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit" class="btn btn-success me-1 mb-1">Enviar</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                    <button class="btn btn-success" type="submit" form="prodForm">Guardar <i class="fal fa-save"></i></button>
                                    <a class="btn btn-danger" type="button" href="{{ url('/admin/sub-categorias') }}">
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
                    <h4 class="card-title">Edición de Sub Categoria</h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        @foreach ($subc as $s)
                        @php
                        $parameter =[
                        'id' =>$s->id_sub,
                        ];

                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" method="POST" action="{{url('admin/sub-categorias/update/')}}/{{$parameter}}"
                            id="updateForm">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                @foreach ($subc as $sb)
                                    
                                


                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre de la sub categoria</label>

                                        <input type="text" id="name" class="form-control"
                                            placeholder="Escriba el nombre de la categoria" name="nombre"
                                            maxlength="200" value="{{ $sb->nombre }}">
                                        <div class="form-text">
                                            El nombre de la <strong>Sub Categoria</strong> debe contener un máximo de
                                            200 caracteres
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Categoria pricipal</label>

                                        <select class="categorias form-control" name="categoria">
                                            <option value="{{ $sb->id_categoria }}">{{ $sb->categoria }}</option>
                                        </select>
                                        <div class="form-text">
                                            Selecciona la <strong>Categoria Principal</strong> de la <strong>Sub
                                                Categoria</strong>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12 d-flex justify-content-end mt-3">
                                    <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block d-xxl-block">
                                        <a href="{{ url('/admin/sub-categorias') }}" class="btn btn-danger me-1 mb-1"><i
                                                class="fal fa-long-arrow-left"></i> Regresar</a>
                                        <button type="submit" class="btn btn-success me-1 mb-1">Enviar</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Formatear</button>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none">
                                    <button class="btn btn-success" type="submit" form="prodForm">Guardar <i class="fal fa-save"></i></button>
                                    <a class="btn btn-danger" type="button" href="{{ url('/admin/sub-categorias') }}">
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






@push('select-scripts')
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