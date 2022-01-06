<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="{{ url('ventas/save/') }}" method="POST" id="principalForm" enctype="multipart/form-data">
                @method('POST')
                @csrf
            <div class="checkout-steps-form-style-1">
                
                    <ul id="accordionExample">                            
                        <li id="collapseFourC">
                            <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Datos de envio</h6>
                            <section class="checkout-steps-form-content collapse show" id="collapseFour" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="row mt-3 d-none" id="hidden-alert">
                                    <div class="col-12 col-md-6 mx-auto">
                                        <div class="alert alert-danger" role="alert">
                                            <p id="alert-text" class="text-center"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fal fa-map"></i> <span>Dirección</span></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                          <button class="nav-link" id="pills-tienda-tab" data-bs-toggle="pill" data-bs-target="#pills-tienda" type="button" role="tab" aria-controls="pills-tienda" aria-selected="false"><i class="fas fa-store-alt"></i> <span>Recoger en tienda</span></button>
                                        </li>                                        
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            @forelse ($direcciones as $key => $direccion)
                                            @if ($loop->first)
                                            <div class="card">
                                            
                                            <div class="card-body">
                                                <h4 class="card-title">Tús Direcciones:</h4>
                                                <p class="card-text">Selecciona una opción</p>
                                                <div class="col-md-12">
                                                    
                                                
                                                {{-- <h6>Tús Direcciones:</h6>
                                                <p>Selecciona una opción</p>
                                                <div class="checkout-payment-option">
                                                <div class="col-md-12">
                                                    <div class="payment-option-wrapper"> --}}
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col"></th>
                                                                            <th scope="col">Dirección de envío</th>
                                                                            {{-- <th scope="col">Dirección de facturación</th> --}}
                                                                            {{-- <th scope="col">Departamento</th>
                                                                            <th scope="col">Municipio</th> --}}
                                                                            <th scope="col">Teléfono</th>
                                                                            <th scope="col">Editar</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                            @endif
                                            
                                                    
                                                        {{-- <div class="single-payment-option w-auto overflow-auto">
                                                            <input type="radio" name="id_direccion"  id="shipping-{{ $key }}" value="{{ $direccion->id }}" onclick="toggle('shipping-{{ $loop->count }}')">
                                                            <label for="shipping-{{ $key }}" class="w-100"> --}}

                                                            
                                                                        <tr>
                                                                            <th scope="row">
                                                                                @if ($loop->first)
                                                                                <input type="radio" name="id_direccion"  id="shipping-{{ $key }}" value="{{ $direccion->id }}" checked>
                                                                                @else
                                                                                <input type="radio" name="id_direccion"  id="shipping-{{ $key }}" value="{{ $direccion->id }}">
                                                                                @endif
                                                                            </th>
                                                                            <td >{{ $direccion->direccion . ". " . $direccion->departamento . ", " . $direccion->municipio }}</td>                                                                            
                                                                            {{-- <td>{{ $direccion->facturacion }}</td> --}}
                                                                            {{-- <td>{{ $direccion->departamento }}</td>
                                                                            <td>{{ $direccion->municipio }}</td> --}}
                                                                            <td>{{ $direccion->telefono }}</td>
                                                                            <td><button class="btn btn-default" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="updateDir(@js($direccion))"><i class="fal fa-edit"></i></button></td>
                                                                        </tr>
                                                                        
                                                                    
                                                            
                                                            
                                                            
                                                            {{--</label>
                                                        </div>--}}
                                                    
                                            
                                                    
                                            @if ($loop->last)  
                                                        {{--  <div class="col-12">
                                                            <div class="single-payment-option w-auto">
                                                                <input type="radio" name="id_direccion" id="shipping-{{ $key+1 }}" onclick="toggle(this.id)">
                                                                <label for="shipping-{{ $key+1 }}">
                                                                
                                                                <p><b>Otra Dirección</b></p>
                                                                
                                                                </label>
                                                            </div>
                                                        </div>       --}}
                                                        
                                                        <tr>
                                                            <th scope="row">
                                                                
                                                                    <input type="radio" value="on" name="id_direccion" onclick="whoClicked(this)">
                                                                
                                                            </th>
                                                            <td colspan="3" class="text-center">Otra Dirección de envío</td>
                                                        </tr>
                                                                        
                                                    </tbody>
                                                                </table>

                                                                <div class="table-responsive">
                                                                <table class="table table-secondary">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col"></th>
                                                                            <th scope="col">Dirección de Facturación</th>
                                                                            <th scope="col">Editar</th>                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse ($facturaciones as $facturacion)
                                                                        <tr>                                                                                
                                                                            <th scope="row">
                                                                                <div class="form-check">
                                                                                    @if($loop->first)
                                                                                    <input type="radio" value="{{ $facturacion->id }}" name="id_facturacion" checked>
                                                                                    @else
                                                                                    <input type="radio" value="{{ $facturacion->id }}" name="id_facturacion">
                                                                                    @endif                                                                                     
                                                                                </div>
                                                                            </th>
                                                                            <td>
                                                                                {{ $facturacion->direccion . '. ' . $facturacion->departamento . ' ' . $facturacion->municipio }}
                                                                            </td>
                                                                            <td><button class="btn btn-default" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="updateDir(@js($facturacion))"><i class="fal fa-edit"></i></button></td>
                                                                        </tr>
                                                                        @if ($loop->last)
                                                                            <tr>
                                                                                <th scope="row">
                                                                                    <div class="form-check">
                                                                                        <input type="radio" value="on" name="id_facturacion" onclick="whoClicked(this)">
                                                                                    </div>
                                                                                </th>
                                                                                <td colspan="2" class="text-center">Otra Dirección de facturación</td>
                                                                            </tr>
                                                                        @endif  
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="3"><p>Ocurrió un error, no se encontraron datos de facturación</p></td>
                                                                            </tr>
                                                                        @endforelse                                                                       
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                            </div>
                                                    </div>
                                                    </div>                                                
                                                </div>  
                                                </div>  
                                            @endif                                                                          
                                            @empty
                                            
                                            {{--  <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Nombres y Apellidos</label>
                                                    <div class="row">
                                                        <div class="col-md-6 form-input form">
                                                            <input type="text" placeholder="Nombres" name="first_name" class="form-control required global">
                                                        </div>
                                                        <div class="col-md-6 form-input form">
                                                            <input type="text" placeholder="Apellidos" name="last_name" class="form-control required global">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-form form-default">
                                                    <label>Correo Electronico</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Email" name="email" class="form-control required email">
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col mt-2">
                                                <h6>
                                                    Dirección de envío del producto
                                                </h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Número de teléfono</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Teléfono" name="telefono" class="form-control required phone">
                                                    </div>
                                                </div>
                                            </div>                                       
                                            @livewire('departamentos')
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Dirección de envío</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Dirección" name="direccion" class="form-control required direccion">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Punto de referencia de dirección de envío (Opcional)</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Referencia de envío" name="referencia">
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col mt-2">
                                                <h6>
                                                    Dirección de facturación
                                                </h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Dirección de facturación</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Facturación" name="facturacion" class="form-control required direccion">
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="isSame">
                                                    <label class="form-check-label" for="isSame">
                                                    Usar los mismos datos de envío
                                                    </label>
                                                </div>
                                            </div>    
                                            
                                            <div class="col-md-12">
                                                <div class="form-input form">
                                                    <div class="select-items">
                                                        <label for="departamento_facturacion">Departamento</label>
                                                        <select class="form-control" aria-label="Default select example" id="departamento_facturacion" name="departamento_facturacion" wire:model="departamento">
                                                            <option >Departamento</option>                                                
                                                            @forelse ($departamentos as $departamento)
                                                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>  
                                                            @empty
                                                            <option>Ocurrio un error inesperado</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-input form">
                                                    <div class="select-items">
                                                        <label for="municipio_facturacion">Municipio</label>
                                                        <select class="form-control" aria-label="Default select example" id="municipio_facturacion" name="municipio_facturacion">                                                                                                
                                                            @forelse ($municipios as $municipio)
                                                            @if ($loop->first)
                                                            <option >Seleccione un municipio</option>    
                                                            @endif
                                                            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>  
                                                            @empty
                                                            <option >Seleccione un departamento</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Punto de referencia de dirección de facturación (Opcional)</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Referencia de facturación" name="referencia_facturacion">
                                                    </div>
                                                </div>
                                            </div>                                                                      
                                                                                        
                                            @endforelse
                                        </div>
                                        <div class="tab-pane fade" id="pills-tienda" role="tabpanel" aria-labelledby="pills-tienda-tab">
                                            <div class="card text-center">                                              
                                              <div class="card-body">
                                                <h4 class="card-title">Mi Tiendita</h4>
                                                <p class="card-text"><span class="position-absolute top-50 start-0 translate-middle-y ms-2"><input type="checkbox" name="recoger_tienda" value="1"></span><i class="fal fa-map-marker"></i> 4a Calle, Chalatenango, Chalatenango <br> <a href="https://goo.gl/maps/7f2DnKKNGqhcR6eZA" target="_blank">ver dirección</a></p>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                      
                                    
                                    
                                   
                                    <div class="col-12 col-md-6">
                                        <div class="single-form button">
                                            <a type="button" class="btn bg-white border border-1 text-dark" href="{{ url('/carrito') }}"><i class="fas fa-arrow-left"></i> Carrito</a>
                                            <a type="button" class="btn"  id="nextBtn">Siguiente Paso</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </li>
                        <li class="d-none" id="collapsefiveC">
                            <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Métodos de Pago</h6>
                            <section class="checkout-steps-form-content collapse show" id="collapsefive" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            @forelse ($metodos_pagos as $pago)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-heading{{ $loop->index }}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapse{{ $loop->index }}" aria-expanded="false" aria-controls="flush-collapse{{ $loop->index }}">
                                                        {{ $pago->nombre }}
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $loop->index }}"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                        @forelse (json_decode($pago->qr) as $qr)
                                                        
                                                            <div class="col-12 col-md-6 mx-auto">
                                                                <img class="img-fluid" src="{{ asset('/storage/imagenes/qr/'.$qr)}}" alt="qr" width="250px" height="250px">
                                                            </div>
                                                                                                                                                                                      
                                                        @empty
                                                            
                                                        @endforelse                                                                
                                                        </div> 
                                                        @if($pago->numero)
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6 class="text-center">Número de cuenta<b> Bancaria/Chivo Wallet</b></h6>
                                                            </div>
                                                            <div class="col-12 text-center">
                                                                <h3><code>{{ $pago->numero }}</code></h3>
                                                            </div>
                                                        </div> 
                                                        @endif   
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6 class="text-center">Porfavor, adjunte una captura de pantalla, donde se muestre una imagen legible del comprobante de trasacción; proveído por su banco o chivo wallet.</h6>
                                                            </div>
                                                            <div class="checkout-payment-form">
                                                                
                                                                    <input type="hidden" name="id_metodo_pago" value="{{ $pago->id }}">
                                                                    <input type="hidden" name="nombre_metodo_pago" value="{{ $pago->nombre }}">
                                                                    <div class="single-form form-default">
                                                                        <label>Número de Trasacción</label>
                                                                        <div class="form-input form">
                                                                            <input type="text" name="numero" placeholder="Número de Trasacción" class="form-control required cdTransaction" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="manual" data-bs-content="Ingrese el número de transacción" required>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                        <label>Adjunte captura de pantalla del recibo de Trasacción</label>
                                                                        
                                                                            <input class="form-control" type="file"  name="imagen" accept="image/*" class="form-control required"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="manual" required>
                                                                        
                                                                    
                                                                
                                                                    <div class="single-form form-default button">
                                                                        <button onclick="remove()" type="submit" class="btn" >Finalizar Compra</button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            @empty
                                                {{ __('No se encontraron metodos de pago') }}
                                            @endforelse                                                   
                                        </div>
                                        {{-- <div class="checkout-payment-form">
                                            <div class="single-form form-default">
                                                <label>Cardholder Name</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="Cardholder Name">
                                                </div>
                                            </div>
                                            <div class="single-form form-default">
                                                <label>Card Number</label>
                                                <div class="form-input form">
                                                    <input id="credit-input" type="text" placeholder="0000 0000 0000 0000">
                                                    <img src="{{asset('assets/images/payment/card.png')}}" alt="card">
                                                </div>
                                            </div>
                                            <div class="payment-card-info">
                                                <div class="single-form form-default mm-yy">
                                                    <label>Expiration</label>
                                                    <div class="expiration d-flex">
                                                        <div class="form-input form">
                                                            <input type="text" placeholder="MM">
                                                        </div>
                                                        <div class="form-input form">
                                                            <input type="text" placeholder="YYYY">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-form form-default">
                                                    <label>CVC/CVV <span><i class="mdi mdi-alert-circle"></i></span></label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="***">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-form form-default button">
                                                <button type="submit" class="btn" >Pagar</button>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </section>
                        </li>
                    </ul>
                
            </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="checkout-sidebar">
                <div class="checkout-sidebar-coupon">
                    <p>Aplicar cupón para obtener descuento</p>
                    <form action="#">
                        <div class="single-form form-default">
                            <div class="form-input form">
                                <input type="text" placeholder="Código del cupón">
                            </div>
                            <div class="button">
                                <button class="btn">aplicar</button>
                            </div>
                        </div>
                    </form>
                </div>
                @livewire('checkout')
                {{--<div class="checkout-sidebar-banner mt-30">
                    <a href="product-grids.html">
                        <img src="{{asset('assets/images/banner/banner.jpg')}}" alt="#">
                    </a>
                </div>--}}
            </div>
        </div>
    </div>

    <!-- Modals -->
    @livewire('update-dir-modal')
    @livewire('modal-direcciones')
    <!-- End Modals -->
</div>