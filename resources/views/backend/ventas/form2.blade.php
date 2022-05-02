@extends('backend')
@section('title','Detalle de Venta')
@section('content')
<div class="container">
  <div class="row match-height mx-3">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <main>
            <div class="py-5 text-center">
              <h2>Detalle de la Venta</h2>
            </div>
            <div class="row g-5">
             
              <div class="col-md-12 col-lg-12 col-12">
                <h4 class="mb-3">Datos del Cliente</h4>
                <form>
                  <div class="row g-3">
                    <div class="col-sm-4">
                      <label for="firstName" class="form-label">Nombre del Cliente</label>
                      <input type="text" class="form-control" id="firstName" value="{{ $ventas->cliente }}">

                    </div>
                    <div class="col-sm-3">
                      <label for="telefono" class="form-label">Telefono del Cliente</label>
                      <input type="text" class="form-control" id="telefono" value="{{ $ventas->telefono }}">
                    </div>
                    <div class="col-5">
                      <label for="email" class="form-label">Correo Electrónico </label>
                      <input type="email" class="form-control" id="email" value="{{ $ventas->correo }}">

                    </div>

                    <div class="col-6">
                      <label for="direccion" class="form-label">Dirección</label>
                      <div class="input-group ">
                        <textarea id="direccion" class="form-control" id="direccion" cols="30"
                          rows="2">{{ $ventas->direccion }}</textarea>
                      </div>
                    </div>
                    <div class="col-6">
                      <label for="" class="form-label">Referencias</label>
                      <div class="input-group ">
                        @if ($ventas->referencia == null)
                        <textarea id="referencia" class="form-control" cols="30" rows="2">No hay referencias</textarea>
                        @else
                        <textarea id="referencia" class="form-control" cols="30"
                          rows="2">{{ $ventas->referencia }}</textarea>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <label for="direccion-f" class="form-label"> Dirección de
                        Facturación</label>
                      <div class="input-group ">
                        @if ($ventas->facturacion == null)
                        <textarea id="direccion-f" class="form-control" cols="30"
                          rows="2">No hay dirección de facturación</textarea>
                        @else
                        <textarea id="direccion-f" class="form-control" cols="30"
                          rows="2">{{ $ventas->facturacion }}</textarea>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <label for="referencia-f" class="form-label"> Referencias de
                        Facturación</label>
                      <div class="input-group ">
                        @if ($ventas->referencia_facturacion == null)
                        <textarea id="referencia-f" class="form-control" cols="30"
                          rows="2">No hay referencias de facturación</textarea>
                        @else
                        <textarea id="referencia-f" class="form-control" cols="30"
                          rows="2">{{ $ventas->referencia_facturacion }}</textarea>
                        @endif
                      </div>
                    </div>



                    <div class="col-6">
                      <label for="address" class="form-label">Departamento</label>
                      <input type="text" class="form-control" id="address" value="{{ $ventas->departamento }}">

                    </div>

                    <div class="col-6">
                      <label for="address2" class="form-label">Municipio</label>
                      <input type="text" class="form-control" id="address2" value="{{ $ventas->municipio }}">
                    </div>

                    
                    <hr class="my-4">

                    <h4 class="mb-3">Datos de Pago</h4>

                

                    <div class="row gy-3">
                      <div class="col-md-4">
                        <label for="cc-name" class="form-label">Método de Pago</label>
                        <input type="text" class="form-control" id="cc-name" value="{{ $ventas->metodo_pago }}">

                      </div>



                      <div class="col-md-4">
                        <label for="" class="form-label">Numero de Transacción del Cliente</label>
                        <input type="text" class="form-control" id=""
                          value="{{ $ventas->numeroTransaccion }}">

                      </div>
                      <div class="col-md-4">
                        <label for="" class="form-label">Estado de la Venta</label>

                        @if ($ventas->estadoVenta == 0)
                        <input type="text" class="form-control" id="" value="Pendiente de revisión">

                        @elseif($ventas->estadoVenta == 1)
                        <input type="text" class="form-control" id="" value="Aprobada">

                        @elseif ($ventas->estadoVenta == 2)
                        <input type="text" class="form-control" id="" value="Aprobación Manual">

                        @else
                        <input type="text" class="form-control" id="" value="Rechazada">

                        @endif
                      </div>
                      <div class="col-md-12">
                        <label for="cc-number" class="form-label">Numero de Transacción de la Venta</label>
                        <input type="text" class="form-control" id="cc-number"
                          value="{{ $ventas->numeroTransaccionVenta }}">

                      </div>
                      <div class="col-md-12 col-12 text-center">
                        <br>
                        <h3>Imagen de revisión del Cliente </h3>
                        <br>

                        <img
                          src="{{ asset('storage/imagenes/datosCliente/') }}/{{ $ventas->id_usuario }}/{{ $ventas->imagenDatoVenta }}"
                          class="img-fluid">
                      </div>


                    </div>

                    <hr class="my-4">

                    <div class="row">
                      <div class="col-md-12 col-lg-12 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                          <span class="text-primary">Productos De la Venta</span>
                          <span class="badge bg-primary rounded-pill">{{ sizeof($productos) }}</span>
                        </h4>
                        <ul class="list-group mb-3">
                          <div class="table-responsive">
        
        
                            <table class="table text-center">
                              <thead>
                                <tr>
        
                                  <th scope="col" class="text-start" >Producto</th>
                                  <th scope="col">Precio</th>
                                  <th scope="col">Descuento</th>
                                  <th scope="col">Cantidad</th>
                                  <th scope="col">Imagen</th>
                                </tr>
                              </thead>
                              <tbody>
        
        
                                @foreach ($productos as $pt)
                                <tr>
                                  <td class="text-start" >{{ $pt->nombre }}</td>
                                  <td>${{ $pt->precio_venta }}</td>
                                  <td>@if ($pt->oferta == null)
                                    Sin Oferta
                                    @else
                                    {{ $pt->oferta }}%
                                    @endif
                                  </td>
                                  <td>
                                    {{ $pt->cantidad }}
                                  </td>
                                  <td><img src="{{ json_decode($pt->imagen)[0] }}" class="w-25 h-25" alt=""></td>
                                </tr>
                                @endforeach
        
        
                              </tbody>
                            </table>
                          </div>
        
                          <!--  <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                              <h6 class="my-0">Promo code</h6>
                              <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">−$5</span>
                          </li>-->
                          <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>${{ $ventas->totalVenta }}</strong>
                          </li>
                        </ul>
        
        
                      </div>
                    </div>

                    <hr class="my-4">

                    
                      <div class="d-none d-sm-none d-md-inline-block d-lg-inline-block d-xl-inline-block d-xxl-inline-block">
                        <div class="col-12 d-md-flex justify-content-md-end mt-3">
                        <a href="{{ url('/admin/ventas') }}" class="btn btn-primary me-1 mb-1"><i class="fal fa-long-arrow-left"></i>
                          Regresar</a>
                        <form method="post" id="formApro">

                          <button type="submit" hidden class="btn" form="formApro"></button>
                        </form>
                        @if ($ventas->estadoVenta == 0 || $ventas->estadoVenta == 4)
                        <form
                          action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                          method="post" id="formRepro">
                          @method('PUT')
                          @csrf
                          <input type="hidden" value="0" name="aprobacion">
                          <button type="submit" class="btn btn-danger me-1 mb-1" form="formRepro"> <i
                              class="fal fa-times-circle"></i> Rechazar</button>
                        </form>
                        <form
                          action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                          method="post" id="formRepro2">
                          @method('PUT')
                          @csrf
                          <input type="hidden" value="1" name="aprobacion">
                          <button type="submit" class="btn btn-success me-1 mb-1" form="formRepro2"><i
                              class="fal fa-check"></i> Aprobar</button>
                        </form>
                        @endif
                      </div>
                    </div>

                    
                    <div class="d-grid gap-2 col-12 mx-auto  d-sm-block d-md-none d-xl-none d-lg-none">

                      @if ($ventas->estadoVenta == 0 || $ventas->estadoVenta == 4)
                      <form
                        action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                        method="post" id="formRepro">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="0" name="aprobacion">
                        
                      </form>
                      <form
                        action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                        method="post" id="formRepro2">
                        @method('PUT')
                        @csrf
                        <input type="hidden" value="1" name="aprobacion">
                        
                      </form>
                      @endif
                      @if ($ventas->estadoVenta == 0 || $ventas->estadoVenta == 4)

                      <button type="submit" class="btn btn-success " form="formRepro2"><i
                          class="fal fa-check"></i> Aprobar</button>
                      <button type="submit" class="btn btn-danger" form="formRepro"><i
                          class="fal fa-times-circle"></i> Rechazar </button>
                      @endif
                      <a class="btn btn-secondary" type="button" href="{{ url('/admin/ventas') }}">
                        <i class="fal fa-long-arrow-left"></i>&nbsp;Regresar
                      </a>
                    </div>
                </form>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection