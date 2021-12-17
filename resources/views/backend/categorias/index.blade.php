@extends('backend')

@section('title','Categorias')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Categorias</h3>
                
            </div>
           
        </div>
    </div>
    <br>
    @if (\Session::has('alert'))
       
        @switch(\Session::get('alert'))
        @case('warning')
        <div class="alert alert-warning alert-dismissible fade show m-5 text-center" role="alert">
          <i class="fal fa-exclamation"></i>
          <strong>{!! \Session::get('message') !!}</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>  
            @break
        @case('success' || 'update')
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



   
    
    <section class="section mx-3">
        <div class="card">
            <div class="col-12 d-flex justify-content-end mt-3">
               
                <a href="/admin/categorias/add" class="btn btn-primary mx-4"><i class="fal fa-plus"></i> Agregar</a>
                <a href="/admin/categorias/subadd" class="btn btn-primary mx-4"><i class="fal fa-plus"></i> Agregar sub Categoria</a>
            </div>
            <div class="card-body">
                <table class="table table-striped text-center pt-3 pb-3" id="prodTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nombre</th>
                            <th>Sub Categorias</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        @php
                            $subcats = DB::select('select nombre from sub_categorias where id_categoria = ?', [$categoria->id])
                        @endphp
                            <tr>
                                <td>{{$categoria->nombre}}</td>
                                
                                <td>
                                    @if (empty($subcats))
                                        No hay sub categorias dependinetes
                                    @else
                                    @foreach ($subcats as $subcat)
                                    <ul  class="list-unstyled">
                                        <li>{{$subcat->nombre}}</li>
                                        
                                      </ul>
                                    
                                    @endforeach
                                    @endif
                                   
                                    
                                
                                </td>
                                @if ($categoria->estado == 1)
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
                                                'id' =>$categoria->id,
                                            ];
                                            $parameter= Crypt::encrypt($parameter);
                                        @endphp 
                                        <li class="list-inline-item">
                                            <a href="categorias/edit/{{$parameter}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fal fa-pencil-alt"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <form action="{{url('admin/categorias/delete/')}}/{{$parameter}}" method="post" id="formDel">
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
</script>

@endpush

@push('partial-style')
<link rel="stylesheet" href="{{asset('backend/assets/css/datatables.css')}}">
@endpush