@extends('backend')

@section('title','Lista de Pedidos')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="text-center">
                <h3>Lista de Pedidos</h3>
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
    <section class="section mx-3">
        <div class="card">
            @livewire('pedidos.pedido-component')
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped text-center table-bordered pt-3 pb-3" id="pedidoTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Número de transacción</th>
                            <th>Usuario</th>
                            <th>Producto</th>
                            <th>Dirección de entrega</th>
                            <th>Dirección de facturación</th>                        
                            <th>Estado</th>                            
                            <th>Fecha de Entrega</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                        @php
                            $productos = DB::table('productos')->join('detalle_ventas','detalle_ventas.id_producto','=','productos.id')->join('ventas','detalle_ventas.id','=','ventas.id')->where('ventas.id',$pedido->id_venta)->select('productos.nombre')->get();
                            $status =  DB::table('pedidos')->select('preparacion','revision','envio','entregado','fecha_entrega')->where('id_venta',$pedido->id_venta)->get();
                        @endphp
                        <tr>
                            <td>{{$pedido->num_transaccion}}</td>
                            <td>{{ $pedido->usuario }}</td>
                            <td>
                                <ul>
                                @foreach ($productos as $pro)
                                    
                                    <li>
                                        {{ $pro->nombre }}
                                    </li>
                                    
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                {{$pedido->direccion}}
                            </td>
                            <td>{{ $pedido->direccion_facturacion }}</td>
                            <td>    

                                @foreach ($status as $s)
                                    @if ($s->preparacion == 1 && $s->revision == 0 && $s->envio == 0 && $s->entregado == 0)
                                       Preparción
                                    @elseif($s->revision == 1 && $s->revision == 1 && $s->envio == 0 && $s->entregado == 0)
                                        Revisión
                                    @elseif($s->envio == 1 && $s->revision == 1 && $s->envio == 1 && $s->entregado == 0)
                                        Envio
                                    @elseif($s->entregado == 1 && $s->revision == 1 && $s->envio == 1 && $s->entregado == 1)
                                        Entregado        
                                    @else
                                        Ninguno
                                    @endif
                                @endforeach

                            </td>
                            <td>
                                @foreach ($status as $sta)
                                    @if ($sta->fecha_entrega == null)
                                        No entregado
                                    @else
                                        {{ $sta->fecha_entrega }}
                                    @endif
                                @endforeach 
                            </td>                        
                            <td>                                
                                <ul class="list-inline m-0">                                    
                                    <li class="list-inline-item">
                                        <a  class="btn btn-success btn-sm rounded-0"
                                            type="button" data-bs-toggle="modal" data-bs-target="#pedidoModal"  onclick="Livewire.emit('asignStatus',[@js($pedido->id_venta)] )" ><i
                                                class="far fa-box"></i></a>
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
    $('#pedidoTable').DataTable({
        "language":{
            "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        }
    });
} );

</script>
@endpush