@extends('backend')
@section('title','Metodos de Pago')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Métodos de pago</h3>
                
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
               
                <a href="{{ url('/admin/metodos-pagos/add') }}" class="btn btn-primary mx-4"><i class="fal fa-plus"></i> Nuevo</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                <table class="table table-striped text-center table-bordered pt-3 pb-3" id="prodTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nombre</th>
                            <th>QR</th>
                            <th>Nùmero de cuenta</th>
                            <th>Nombre asociado</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($metodos as $metodo)
                        <tr>
                            <td>{{$metodo->nombre}}</td>
                            <td>
                                @forelse (json_decode($metodo->qr) as $qr)
                                    <img src="{{ asset('/storage/imagenes/qr/'.$qr)}}" alt="QR" width="120px" height="120px" >
                                @empty
                                    {{ __('--') }}
                                @endforelse
                                
                            </td>
                            <td>{{$metodo->numero}}</td>
                            <td>{{$metodo->cuenta_asociado}}</td>
                            @if ($metodo->estado == 1)
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
                                            'id' =>$metodo->id,
                                        ];
                                        $parameter= Crypt::encrypt($parameter);
                                    @endphp 
                                    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <a href="metodos-pagos/edit/{{$parameter}}" class="btn btn-success btn-sm rounded-0" type="button"><i class="fal fa-pencil-alt"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <form action="{{url('admin/metodos-pagos/delete/')}}/{{$parameter}}" method="post" id="formDel">
                                            @method('DELETE')
                                            @csrf
                                           
                                                
                                            <input type="hidden" name="imagen_actual" value="{{$metodo->qr}}">
                                            <button type="submit" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fal fa-trash-alt"></i></button>
                                          </form>
                                        
                                    </li>
                                </ul>
                            </td> 
                                               
                        </tr>
                        @empty
                        <tr>
                            <p class="text-center title">No se encontraron registros de datos...</p>
                        </tr>                      
                        @endforelse
                      
                       
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