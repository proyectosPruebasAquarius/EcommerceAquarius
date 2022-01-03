<div>
    <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
        @if(sizeof ($notifications) <>  0)
        <span
            class="position-absolute top-10 start-50 translate-middle p-1 bg-primary border border-light rounded-circle">
          
        </span>
       
      
    </span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
        <li>
            <h6 class="dropdown-header">Notificaciones </h6>
        </li>
        <div class="table-wrapper-scroll-y my-custom-scrollbar" >
        @forelse ($notifications as $notify)
       
        
            <li>
                @if (isset($notify->data['id_inventario']))
                @php
                $product = DB::table('inventarios')->join('productos','inventarios.id_producto','=','productos.id')->select('productos.nombre')->where('inventarios.id','=',$notify->data['id_inventario'])->get();
                @endphp 
                <a class="dropdown-item" href="/admin/inventarios/notificacion/{{Crypt::encrypt($notify->data['id_inventario'])}}/{{ $notify->id }}" title="Minimo de Stock Alcanzado">Minimo de Stock Alcanzado: <b>{{ $product[0]->nombre }}</b> &nbsp; <i class="fal fa-external-link"></i>
                </a>   
                @else
                <a class="dropdown-item" href="/admin/ventas/notificacion/{{Crypt::encrypt($notify->data['venta_id'])}}/{{ $notify->id }}" title="Detalle de la Venta">Compra Realizada: <b>{{ $notify->data['estado'] ? '' : 'Pendiente de Aprobación'
                }}</b>&nbsp; <i class="fal fa-external-link"></i>
                </a> 
                @endif  
            </li>
            @empty
            <li>
                <p class="badge text-wrap text-black">{{ __('No hay notificaciones disponibles') }}</p>
            </li>
            @endforelse
        </div>
        
    </ul>
</div>