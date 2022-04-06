@extends('backend')

@section('title','Proveedores')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Proveedores</h3>
                
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
        <div class="alert alert-danger alert-dismissible fade show m-5" role="alert">
        <i class="fal fa-check-circle"></i>
        <strong>{!! \Session::get('message') !!}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert text-center" aria-label="Close"></button>
    </div>  
        @break
    
        
@endswitch
@endif
    <section class="section mx-3">
        <div class="card">
            <div class="col-12 d-flex justify-content-end mt-3">
               
                <a href="/admin/proveedores/add" class="btn btn-primary mx-4"><i class="far fa-plus"></i>&nbsp;Nuevo</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                <table class="table table-striped text-center table-bordered pt-3 pb-3" id="prodTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nombre del Proveedor</th>
                            <th>Dirección del Proveedor</th>
                            <th>teléfono del Proveedor</th>
                            <th>Nombre del Contacto</th>
                            <th>Teléfono del Contacto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                        <tr>
                            <td>{{$proveedor->nombre}}</td>
                            <td>
                                {{$proveedor->direccion}}
                            </td>
                            <td>{{$proveedor->telefono}}</td>
                            <td>{{$proveedor->nombre_contacto}}</td>
                            <td>{{$proveedor->tel_contacto}}</td>
                            @if ($proveedor->estado == 1)
                            <td>
                                <span class="badge bg-success">Activo</span>
                            </td>
                            @else
                            <td>
                                <span class="badge bg-danger">Desactivado</span>
                            </td> 
                            @endif   
                            <td>

                                <ul class="list-inline m-0">
                                    @php
                                        $parameter =[
                                            'id' =>$proveedor->id,
                                        ];
                                        $parameter= Crypt::encrypt($parameter);
                                    @endphp 
                                    <li class="list-inline-item">
                                        <a href="{{url('admin/proveedores/edit')}}/{{$parameter}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fal fa-pencil-alt"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <form action="{{url('admin/proveedores/delete/')}}/{{$parameter}}" method="post" id="formDel">
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
        </div>

    </section>
</div>
@endsection

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

