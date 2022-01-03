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
              <div class="col-md-5 col-lg-5 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-primary">Productos De la Venta</span>
                  <span class="badge bg-primary rounded-pill">{{ sizeof($productos) }}</span>
                </h4>
                <ul class="list-group mb-3">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Imagen</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                       
                        @foreach ($productos as $pt)
                        <tr>
                        <td>{{ $pt->nombre }}</td>
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
                        <td><img src="{{ json_decode($pt->imagen)[0] }}" class="w-75 h-25" alt=""></td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                  

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
              <div class="col-md-7 col-lg-7">
                <h4 class="mb-3">Datos del Cliente</h4>
                <form>
                  <div class="row g-3">
                    <div class="col-sm-6">
                      <label for="firstName" class="form-label">Nombre del Cliente</label>
                      <input type="text" class="form-control" id="firstName" value="{{ $ventas->cliente }}">

                    </div>
                    <div class="col-sm-6">
                      <label for="telefono" class="form-label">Telefono del Cliente</label>
                      <input type="text" class="form-control" id="telefono" value="{{ $ventas->telefono }}">
                    </div>
                    <div class="col-12">
                      <label for="email" class="form-label">Correo Electrónico </label>
                      <input type="email" class="form-control" id="email" value="{{ $ventas->correo }}">

                    </div>

                    <div class="col-12">
                      <label for="direccion" class="form-label">Dirección</label>
                      <div class="input-group ">
                        <textarea id="direccion" class="form-control" id="direccion" cols="30"
                          rows="2">{{ $ventas->direccion }}</textarea>
                      </div>
                    </div>
                    <div class="col-12">
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
                    <div class="col-12">
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
                    <div class="col-12">
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

                    <!--<div class="col-md-5">
                      <label for="country" class="form-label">Country</label>
                      <select class="form-select" id="country" required>
                        <option value="">Choose...</option>
                        <option>United States</option>
                      </select>
                      <div class="invalid-feedback">
                        Please select a valid country.
                      </div>
                    </div>

                    <div class="col-md-4">
                      <label for="state" class="form-label">State</label>
                      <select class="form-select" id="state" required>
                        <option value="">Choose...</option>
                        <option>California</option>
                      </select>
                      <div class="invalid-feedback">
                        Please provide a valid state.
                      </div>
                    </div>

                    <div class="col-md-3">
                      <label for="zip" class="form-label">Zip</label>
                      <input type="text" class="form-control" id="zip" placeholder="" required>
                      <div class="invalid-feedback">
                        Zip code required.
                      </div>
                    </div>
                  </div>-->

                    <!--<hr class="my-4">

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="same-address">
                    <label class="form-check-label" for="same-address">Shipping address is the same as my billing
                      address</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="save-info">
                    <label class="form-check-label" for="save-info">Save this information for next time</label>
                  </div>-->

                    <hr class="my-4">

                    <h4 class="mb-3">Datos de Pago</h4>

                    <!--   <div class="my-3">
                    <div class="form-check">
                      <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                      <label class="form-check-label" for="credit">Credit card</label>
                    </div>
                    <div class="form-check">
                      <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                      <label class="form-check-label" for="debit">Debit card</label>
                    </div>
                    <div class="form-check">
                      <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                      <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                  </div>-->

                    <div class="row gy-3">
                      <div class="col-md-6">
                        <label for="cc-name" class="form-label">Método de Pago</label>
                        <input type="text" class="form-control" id="cc-name" value="{{ $ventas->metodo_pago }}">

                      </div>



                      <div class="col-md-6">
                        <label for="cc-expiration" class="form-label">Numero de Transacción del Cliente</label>
                        <input type="text" class="form-control" id="cc-expiration"
                          value="{{ $ventas->numeroTransaccion }}">

                      </div>
                      <div class="col-md-6">
                        <label for="cc-expiration" class="form-label">Estado de la Venta</label>
                       
                        @if ($ventas->estadoVenta == 0)
                        <input type="text" class="form-control" id="cc-expiration" value="Pendiente de revisión">

                        @elseif($ventas->estadoVenta == 1)
                        <input type="text" class="form-control" id="cc-expiration" value="Aprobada">

                        @elseif ($ventas->estadoVenta == 2)
                        <input type="text" class="form-control" id="cc-expiration" value="Aprobación Manual">

                        @else
                        <input type="text" class="form-control" id="cc-expiration" value="Rechazada">

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
                          src="{{ asset('storage/imagenes/datosCliente/') }}/{{ $ventas->id_usuario }}/{{ $ventas->imagenDatoVenta }}" class="img-fluid">
                      </div>


                    </div>

                    <hr class="my-4">
                   
                       <div class="col-12 d-flex justify-content-end mt-3">

                        <a href="/admin/ventas" class="btn btn-primary me-1 mb-1"><i
                                class="fal fa-long-arrow-left"></i> Regresar</a>
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
                                <button type="submit" class="btn btn-danger me-1 mb-1"
                                    form="formRepro"> <i class="fal fa-times-circle"></i> Rechazar</button>
                            </form>
                            <form
                                action="{{ url('admin/ventas/detalle/verificacion') }}/{{ Crypt::encrypt($ventas->id_venta) }}"
                                method="post" id="formRepro2">
                                @method('PUT')
                                @csrf
                                <input type="hidden" value="1" name="aprobacion">
                                <button type="submit" class="btn btn-success me-1 mb-1"
                                    form="formRepro2"><i class="fal fa-check"></i> Aprobar</button>
                            </form>
                        @endif
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