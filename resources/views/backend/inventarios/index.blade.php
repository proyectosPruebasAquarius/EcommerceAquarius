@extends('backend')

@section('title','Inventarios')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Inventarios</h3>
                
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
        <div class="alert alert-danger alert-dismissible fade show m-5 text-center" role="alert">
        <i class="fal fa-check-circle"></i>
        <strong>{!! \Session::get('message') !!}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>  
        @break
    
        
@endswitch
@endif
    <section class="section mx-3">
        <div class="card">
            <div class="col-12 d-flex justify-content-end mt-3">
               
                <a href="{{ url('/admin/inventarios/add') }}" class="btn btn-primary mx-4"><i class="fal fa-plus"></i> Nuevo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                <table class="table table-striped text-center table-bordered pt-3 pb-3" id="prodTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>C??digo del Producto</th>
                            <th>Producto</th>
                            <th>Precio de Compra</th>
                            <th>Precio de Venta</th>
                            <th>Precio Descuento</th>                           
                            <th>Stock Minimo</th>
                            <th>Stock</th>
                            <th>Oferta</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventarios as $inventario)
                        <tr>
                            <td>{{$inventario->codigo}}</td>
                            <td>{{$inventario->producto}}</td>
                            <td>
                               $ {{$inventario->precio_compra}}
                            </td>
                            <td>
                                $ {{$inventario->precio_venta}}</td>
                            <td>
                                @if ($inventario->precio_descuento != null)
                                $ {{$inventario->precio_descuento}}
                                @else
                                    Sin precio de oferta
                                @endif

                           </td>
                         
                           <td>{{ $inventario->min_stock }}</td>
                           <td>{{ $inventario->stock }}</td>
                           <td>
                                @if ($inventario->oferta != null)
                                {{$inventario->oferta}}
                                @else
                                    Sin oferta
                                @endif

                           </td>
                            @if ($inventario->estado == 1)
                            <td>
                                <span class="badge bg-success">Activo</span>
                            </td>
                            @else
                            <td>
                                <span class="badge bg-danger">Desactivado</span>
                            </td> 
                            @endif   
                            <td>

                                <ul class="list-group list-group-horizontal">
                                    @php
                                        $parameter =[
                                            'id' => $inventario->id,
                                        ];
                                        $parameter= Crypt::encrypt($parameter);
                                    @endphp 
                                    <li class="list-group-item">
                                        <a href="inventarios/edit/{{$parameter}}" class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fal fa-pencil-alt"></i></a>
                                    </li>
                                    <li class="list-group-item">
                                        <form action="{{url('admin/inventarios/delete/')}}/{{$parameter}}" method="post" id="formDel">
                                            @method('DELETE')
                                            @csrf
                                           
                                                
                                            
                                            <button type="submit" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fal fa-trash-alt"></i></button>
                                          </form>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="inventarios/detail/{{$parameter}}" class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Detalle del Inventario"><i class="fal fa-eye"></i></a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="inventarios/historial/{{$parameter}}" class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Historial del Producto"><i class="fas fa-history"></i></a>
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