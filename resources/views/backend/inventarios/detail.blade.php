@extends('backend')

@section('title','Detalle de Inventario')


@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
           
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detalle de inventario</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        @foreach ($inventarios as $inventario)
                        @php
                        $parameter =[
                        'id' =>$inventario->id_inventario,
                        ];
                        $parameter= Crypt::encrypt($parameter);
                        @endphp
                        <form class="form" action="{{url('admin/inventarios/update')}}/{{$parameter}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-2 col-4">
                                    <div class="form-group">
                                        <label for="producto" class="form-label">Producto</label>
                                        <input type="text" class="form-control" name="min_stock" min=0 disabled
                                        value="{{$inventario->producto}}">
                                       
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="city-column" class="form-label">Codigo del producto</label>
                                        <input type="text" id="city-column" class="form-control" name="codigo" disabled
                                            value="{{$inventario->codigo}}">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column" class="form-label">Precio de compra</label>
                                        <input type="text" class="form-control" name="precio_compra" min=0 step="any" disabled
                                            value="${{$inventario->precio_compra}}">
                                       
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column" class="form-label">Precio de venta</label>
                                        <input type="text" class="form-control" name="precio_venta" step="any" min=0 disabled
                                            value="${{$inventario->precio_venta}}">
                                      
                                    </div>
                                </div>
                              
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Stock del producto</label>
                                        <input type="number" class="form-control" name="stock" min=0 disabled
                                            value="{{$inventario->stock}}">
                                       
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Stock Mínimo del
                                            producto</label>
                                        <input type="number" class="form-control" name="min_stock" min=0 disabled
                                            value="{{$inventario->min_stock}}">
                                       
                                    </div>
                                </div>
                               
                                <div class="col-md-2 col-4">
                                    <div class="form-group">
                                        <label for="oferta" class="form-label">Oferta</label>
                                      

                                            @if ($inventario->oferta == null)
                                            <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="Sin Oferta">
                                            @else
                                            <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="{{$inventario->oferta}}%">
                                            @endif
                                           
                                           
                                        
                                    </div>
                                </div>
                                <div class="col-md-2 col-4">
                                    <div class="form-group">
                                        <label for="estado" class="form-label">Estado</label>

                                        @if ($inventario->estado == 1)
                                        <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="Activo">
                                        @else
                                        <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="Desactivado">
                                        @endif
                                        

                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="form-group">
                                        <label for="estado" class="form-label">Proveedor</label>

                                        
                                        <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="{{ $inventario->proveedor }}">
                                        
                                        

                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Marca</label>
                                        <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="{{$inventario->marca}}">
                                       
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Categoria</label>
                                        <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="{{$inventario->categoria}}">
                                       
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="country-floating" class="form-label">Sub Categoria</label>
                                        <input type="text" class="form-control" name="min_stock" min=0 disabled
                                            value="{{$inventario->subcat}}">
                                       
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12 text-center">
                                        <div class="form-group">
                                            <label for="estado" class="form-label">Imagen del Producto</label>
    
                                            <br>
                                            <img src="{{ json_decode($inventario->imagen)[0] }}" class="h-25 w-25" > 
                                            
                                            
    
                                        </div>
                                    </div>
                                </div>
                              
                              
                                @endforeach

                                <div class="col-12 d-flex justify-content-end mt-3">

                                    <a href="/admin/inventarios" class="btn btn-primary me-1 mb-1"><i
                                            class="fal fa-long-arrow-left"></i> Regresar</a>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection