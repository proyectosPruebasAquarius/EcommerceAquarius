@extends('backend')

@section('title','Ofertas')

@section('content')
<div class="page-heading">
 
    <br>
    @if (\Session::has('alert'))
       
        @switch(\Session::get('alert'))
        @case('warning')
        <div class="alert alert-warning alert-dismissible fade show m-5 text-center" role="alert">
          <i class="fal fa-exclamation"></i>
          <strong>{!! \Session::get('message') !!}</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert " aria-label="Close"></button>
       </div>  
            @break
        @case('success')
            <div class="alert alert-success alert-dismissible fade show m-5 text-center" role="alert">
            <i class="fal fa-check-circle"></i>
            <strong>{!! \Session::get('message') !!}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
            @break
        @case('danger')
            <div class="alert alert-success alert-dismissible fade show m-5 text-center" role="alert">
            <i class="fal fa-check-circle"></i>
            <strong>{!! \Session::get('message') !!}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
            @break
        @default
            
    @endswitch
    @endif



    <div class="accordion accordion-flush text-center" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button btn show" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            <h4>  Listas de Ofertas </h4>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <section class="section mx-3">
                    <div class="card">
                        <div class="col-12 d-flex justify-content-end mt-3">
                           
                            <a href="/admin/ofertas/add" class="btn btn-primary mx-4"><i class="fal fa-plus"></i> Agregar</a>
                           
                        </div>
                        <div class="card-body">
                            <table class="table table-striped text-center pt-3 pb-3" id="prodTable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo de Oferta</th>
                                        <th>Tiempo limite de la oferta</th>
                                        <th>Fecha de Creacion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ofertas as $oferta)
                                   
                                        <tr>
                                            <td>{{$oferta->nombre}}</td>
                                            
                                            <td>
                                                {{$oferta->tipo_oferta}}
                                            </td>
                                            <td>{{$oferta->tiempo_limite}}</td>
                                            <td>
                                                {{$oferta->fecha}}
                                            </td>
                                            @if ($oferta->estado == 1)
                                            <td>
                                                <span class="badge bg-success">Activa</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge bg-danger">Desactivada</span>
                                            </td>
                                            @endif
                                            <td>
                                                <ul class="list-inline m-0">
                                                    @php
                                                        $parameter =[
                                                            'id' =>$oferta->id_oferta,
                                                        ];
                                                        $parameter= Crypt::encrypt($parameter);
                                                    @endphp 
                                                    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <a href="ofertas/edit/{{$parameter}}" class="btn btn-success btn-sm rounded-0" type="button"><i class="fal fa-pencil-alt"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <form action="{{url('admin/ofertas/delete/')}}/{{$parameter}}" method="post" id="formDel">
                                                            @method('DELETE')
                                                            @csrf
                                                           
                                                                
                                                            
                                                            <button type="submit" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fal fa-trash-alt"></i></button>
                                                          </form>
                                                        
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach 
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
            
                </section>

            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
               <h4> Listas de Tipos de Ofertas</h4>
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <section class="section mx-3">
                    <div class="card">
                        <div class="col-12 d-flex justify-content-end mt-3">
                           
                            <a href="/admin/ofertas/tipos/add" class="btn btn-primary mx-4"><i class="fal fa-plus"></i> Agregar</a>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-striped  text-center pt-3 pb-3" id="prodTable2">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Nombre</th>
                                       
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tiposofertas as $tipo)
                                   
                                    <tr>
                                        <td>{{$tipo->nombre}}</td>
                                        
                                       
                                        @if ($tipo->estado == 1)
                                        <td>
                                            <span class="badge bg-success">Activa</span>
                                        </td>
                                        @else
                                        <td>
                                            <span class="badge bg-danger">Desactivada</span>
                                        </td>
                                        @endif
                                        <td>
                                            <ul class="list-inline m-0">
                                                @php
                                                    $parameter =[
                                                        'id' =>$tipo->id,
                                                    ];
                                                    $parameter= Crypt::encrypt($parameter);
                                                @endphp 
                                                <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <a href="ofertas/tipos/edit/{{$parameter}}" class="btn btn-success btn-sm rounded-0" type="button"><i class="fal fa-pencil-alt"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <form action="{{url('admin/ofertas/tipos/delete/')}}/{{$parameter}}" method="post" id="formDel">
                                                        @method('DELETE')
                                                        @csrf
                                                       
                                                            
                                                        
                                                        <button type="submit" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fal fa-trash-alt"></i></button>
                                                      </form>
                                                    
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach 
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
            
                </section>

            </div>
          </div>
        </div>
        
      </div>
   
</div>
@endsection

@push('partial-scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/r-2.2.9/datatables.min.js"></script>

@endpush

@push('datatable-scripts')
<script>
    $(document).ready(function() {
    $('#prodTable').DataTable({
        "language":{
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        }
    });
} );

$(document).ready(function() {
    $('#prodTable2').DataTable({
        "language":{
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        }
    });
} );
</script>

@endpush

@push('partial-style')
<link rel="stylesheet" href="{{asset('backend/assets/css/datatables.css')}}">
@endpush