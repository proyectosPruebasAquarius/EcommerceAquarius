@extends('backend')

@section('title','Historial del Producto')
    

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
           
            <div class="card">
                @foreach ($actual as $h)
                    
              
                <div class="card-header">
                    <h4 class="card-title">Historial del Producto: {{ $h->codigo }}</h4>
                    <br>
                  
                </div>
                <div >
                    <h6 class="text-start ms-5">Precio de Compra Actual: ${{$h->precio_compra_actual}}</h6>
                    <h6 class="text-end me-5">Precio de Venta Actual: ${{ $h->precio_venta_actual }}</h6>
                    <div class="text-center">
                        <img src="{{ json_decode($h->imagen)[0] }}" class="text-center h-25 w-25" alt="Imagen del Producto">
                    </div>
                    
                   
                </div>
               
                @endforeach
                <div class="card-content">
                    <div class="card-body">
                        <table class="table">
                            <thead class="text-center">
                              <tr>
                                <th scope="col">Fecha de Registro</th>
                                <th scope="col">Precio de Compra</th>
                                <th scope="col">Precio de Venta</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Stock Minimo</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($historial as $hi)
                                <tr>
                                    <th scope="row">{{ $hi->fecha }}</th>
                                    <td>${{ $hi->precio_compra_historial }}</td>
                                    <td>${{ $hi->precio_venta_historial }}</td>
                                    <td>{{ $hi->stock }}</td>
                                    <td>{{ $hi->stock_minimo }}</td>  
                                  </tr>
                                @endforeach
                              
                             
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end mt-3">

                    <a href="/admin/inventarios" class="btn btn-primary me-5 mb-5"><i
                            class="fal fa-long-arrow-left"></i> Regresar</a>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
