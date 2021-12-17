@extends('app')

@section('title',  'Verificar Compra')
@section('content')
        
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Confirmar Compra</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Inicio</a></li>
                        <li><a href="{{ route('productos') }}">Productos</a></li>
                        <li>Confirmar Compra</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    
    <section class="checkout-wrapper section">
        <div class="row mb-2">
            <div class="col-12 col-md-6 text-center mx-auto">
                <nav class="nav nav-pills flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link border border-1" href="{{ url('/carrito') }}"><i class="fal fa-check-circle text-success"></i> Carrito <i class="fal fa-shopping-cart"></i></a>
                    <a class="flex-sm-fill text-sm-center nav-link active border border-1" aria-current="page" href="javascript:void(0)" id="entregaInfo">Información de Entrega <i class="fal fa-truck"></i></a>
                    <a class="flex-sm-fill text-sm-center nav-link border border-1" href="javascript:void(0)" id="metodoPago">Métodos de Pago <i class="fal fa-credit-card"></i></a>
                    {{-- <a class="nav-link" href="#">Link</a>
                    <a class="flex-sm-fill text-sm-center nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> --}}
                </nav>
                {{-- <nav class="nav nav-pills flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Active</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="#">Longer nav link</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="#">Link</a>
                    <a class="flex-sm-fill text-sm-center nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                  </nav> --}}
            </div>
        </div>
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
                                        <div class="row">
                                            @forelse ($direcciones as $key => $direccion)
                                                @if ($loop->first)
                                                    <h6>Tús Direcciones:</h6>
                                                    <p>Selecciona una opción</p>
                                                    <div class="checkout-payment-option">
                                                    <div class="col-md-12">
                                                        <div class="payment-option-wrapper">
                                                @endif
                                                
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="id_direccion"  id="shipping-{{ $key }}" value="{{ $direccion->id }}" onclick="toggle('shipping-{{ $loop->count }}')">
                                                            <label for="shipping-{{ $key }}">
                                                            
                                                            <p>{{ $direccion->direccion }}</p>
                                                            {{-- <span class="price">Municipio: {{ $direccion->municipio }}</span> --}}
                                                            </label>
                                                        </div>
                                                
                                                        
                                                @if ($loop->last)  
                                                            <div class="single-payment-option">
                                                                <input type="radio" name="id_direccion" id="shipping-{{ $key+1 }}" onclick="toggle(this.id)">
                                                                <label for="shipping-{{ $key+1 }}">
                                                                
                                                                <p><b>Otra Dirección</b></p>
                                                                {{-- <span class="price">Municipio: {{ $direccion->municipio }}</span> --}}
                                                                </label>
                                                            </div>       
                                                        </div>                                                
                                                    </div>  
                                                    </div>  
                                                @endif                                                                          
                                            @empty
                                            
                                            <div class="col-md-12">
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
                                            </div>
                                            <div class="col-md-6">
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
                                                        <input type="text" placeholder="Dirección" name="direccion" class="form-control required global">
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Dirección de facturación</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Facturación" name="facturacion">
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="isSame">
                                                    <label class="form-check-label" for="isSame">
                                                      Misma dirección de envio
                                                    </label>
                                                  </div>
                                            </div>    
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Punto de referencia (Opcional)</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Referencia" name="referencia">
                                                    </div>
                                                </div>
                                            </div>                                  
                                            {{-- <div class="col-md-12">
                                                <div class="checkout-payment-option">
                                                    <h6 class="heading-6 font-weight-400 payment-title">Select Delivery Option
                                                    </h6>
                                                    <div class="payment-option-wrapper">
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" checked id="shipping-1">
                                                            <label for="shipping-1">
                                                            <img src="{{ asset('assets/images/shipping/shipping-1.png')}}" alt="Sipping">
                                                            <p>Standerd Shipping</p>
                                                            <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-2">
                                                            <label for="shipping-2">
                                                            <img src="{{asset('assets/images/shipping/shipping-2.png')}}" alt="Sipping">
                                                            <p>Standerd Shipping</p>
                                                            <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-3">
                                                            <label for="shipping-3">
                                                            <img src="{{asset('assets/images/shipping/shipping-3.png')}}" alt="Sipping">
                                                            <p>Standerd Shipping</p>
                                                            <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                        <div class="single-payment-option">
                                                            <input type="radio" name="shipping" id="shipping-4">
                                                            <label for="shipping-4">
                                                            <img src="{{asset('assets/images/shipping/shipping-4.png')}}" alt="Sipping">
                                                            <p>Standerd Shipping</p>
                                                            <span class="price">$10.50</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-md-12">
                                                <div class="single-form button">
                                                    <a type="button" class="btn" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Siguiente Paso</a>
                                                </div>
                                            </div> --}}
                                                                                        
                                            @endforelse
                                            
                                            <div id="formHidden" class="d-none">
                                                <div class="col-md-12">
                                                    <div class="single-form form-default">
                                                        <label>Nombres y Apellidos</label>
                                                        <div class="row">
                                                            <div class="col-md-6 form-input form">
                                                                <input type="text" placeholder="Nombres" name="first_name">
                                                            </div>
                                                            <div class="col-md-6 form-input form">
                                                                <input type="text" placeholder="Apellidos" name="last_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form form-default">
                                                        <label>Correo Electronico</label>
                                                        <div class="form-input form">
                                                            <input type="text" placeholder="Email" name="email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form form-default">
                                                        <label>Número de teléfono</label>
                                                        <div class="form-input form">
                                                            <input type="text" placeholder="Teléfono" name="telefono">
                                                        </div>
                                                    </div>
                                                </div>                                       
                                                @livewire('departamentos')
                                                <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Dirección de envío</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Dirección" name="direccion">
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Dirección de facturación</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Facturación" name="facturacion">
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="isSame">
                                                    <label class="form-check-label" for="isSame">
                                                      Misma dirección de envio
                                                    </label>
                                                  </div>
                                            </div>    
                                            <div class="col-md-12">
                                                <div class="single-form form-default">
                                                    <label>Punto de referencia (Opcional)</label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="Referencia" name="referencia">
                                                    </div>
                                                </div>
                                            </div>                                      
                                                {{-- <div class="col-md-12">
                                                    <div class="checkout-payment-option">
                                                        <h6 class="heading-6 font-weight-400 payment-title">Select Delivery Option
                                                        </h6>
                                                        <div class="payment-option-wrapper">
                                                            <div class="single-payment-option">
                                                                <input type="radio" name="shipping" checked id="shipping-1">
                                                                <label for="shipping-1">
                                                                <img src="{{ asset('assets/images/shipping/shipping-1.png')}}" alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                                </label>
                                                            </div>
                                                            <div class="single-payment-option">
                                                                <input type="radio" name="shipping" id="shipping-2">
                                                                <label for="shipping-2">
                                                                <img src="{{asset('assets/images/shipping/shipping-2.png')}}" alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                                </label>
                                                            </div>
                                                            <div class="single-payment-option">
                                                                <input type="radio" name="shipping" id="shipping-3">
                                                                <label for="shipping-3">
                                                                <img src="{{asset('assets/images/shipping/shipping-3.png')}}" alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                                </label>
                                                            </div>
                                                            <div class="single-payment-option">
                                                                <input type="radio" name="shipping" id="shipping-4">
                                                                <label for="shipping-4">
                                                                <img src="{{asset('assets/images/shipping/shipping-4.png')}}" alt="Sipping">
                                                                <p>Standerd Shipping</p>
                                                                <span class="price">$10.50</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}                                                
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="single-form button">
                                                    <a type="button" class="btn bg-white border border-1 text-dark" href="{{ url('/carrito') }}"><i class="fas fa-arrow-left"></i> Carrito</a>
                                                    <a type="button" class="btn" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive" id="nextBtn">Siguiente Paso</a>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </li>
                                <li class="d-none" id="collapsefiveC">
                                    <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Métodos de Pago</h6>
                                    <section class="checkout-steps-form-content collapse" id="collapsefive" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
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
                            <p>Appy Coupon to get discount!</p>
                            <form action="#">
                                <div class="single-form form-default">
                                    <div class="form-input form">
                                        <input type="text" placeholder="Coupon Code">
                                    </div>
                                    <div class="button">
                                        <button class="btn">apply</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @livewire('checkout')
                        <div class="checkout-sidebar-banner mt-30">
                            <a href="product-grids.html">
                                <img src="{{asset('assets/images/banner/banner.jpg')}}" alt="#">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('helpers.js') }}"></script>
    <script>
        window.addEventListener('load', function() {
            document.getElementById('principalForm').reset();
            dt = '{{ json_encode($direcciones) }}'
            console.log(dt);
            if (dt == '[]') {
                document.getElementById('formHidden').remove()
            }
        })
        startValidate(document.getElementById('principalForm'))

        let toggle = (id) => {
            console.log(id);
            let shipping = document.getElementById(id)
            let form = document.getElementById('formHidden')

            if (shipping.checked) {
                form.classList.remove('d-none')
            } else {
                form.classList.add('d-none')
            }
        }
        /* let form = document.forms[0]
            let elements = form.querySelectorAll('input[name="numero"]'); */
        /* let elements = document.querySelectorAll('input[name="numero"]');
        elements.forEach(element => {
            /* elements[0].value= 'hola' */
           /*  if (!element.value) {
                console.log(element);
            } 
        }); */
                
        let remove = () => {
            
            let elements = document.querySelectorAll('.accordion-collapse');
            elements.forEach(element => {
                if (!element.classList.contains('show')) {
                    element.remove()
                }
            });

        }

        let steppers = Array.from(document.querySelectorAll('.nav-link'))
        
        const handleClick = (e) => {
            e.preventDefault();
            
            let formP = document.getElementById('principalForm')/* .elements */
            const formData = new FormData(formP);

            if(e.target.id == 'entregaInfo') {
                

               /*  if (formData.get('id_direccion')) { */
                    document.getElementById('collapsefiveC').classList.add('d-none')
                    document.getElementById('collapseFourC').classList.remove('d-none')
                    console.log('epa');
                /* } else {
                    if(formData.get('first_name') && formData.get('last_name') && formData.get('email') && formData.get('telefono') && formData.get('id_municipio') && formData.get('direccion')) {
                        document.getElementById('collapsefiveC').classList.add('d-none')
                        document.getElementById('collapseFourC').classList.remove('d-none')
                        console.log('adios');
                    } else {
                        document.getElementById('collapseFourC').style.backgroundColor = 'red !important'
                        console.log('hola');
                    }
                } */
                steppers.forEach(node => {
                        node.classList.remove('active');
                    });
                    e.currentTarget.classList.add('active');
                
                
            } else if(e.target.id == 'metodoPago') {
                if (formData.get('id_direccion') && formData.get('id_direccion') != 'on') {
                    document.getElementById('collapseFourC').classList.add('d-none')
                    document.getElementById('collapsefiveC').classList.remove('d-none')
                    steppers.forEach(node => {
                        node.classList.remove('active');
                    });
                    e.currentTarget.classList.add('active');

                    document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-check-circle  text-success"></i> Información de Entrega <i class="fal fa-truck"></i>'
                    if (document.getElementById('entregaInfo').classList.contains('bg-danger')) {
                        document.getElementById('entregaInfo').classList.remove('bg-danger')
                    }
                } else {
                    if(formData.get('first_name') && formData.get('last_name') && formData.get('email') && formData.get('telefono') && formData.get('id_municipio') && formData.get('direccion')) {
                        document.getElementById('collapseFourC').classList.add('d-none')
                        document.getElementById('collapsefiveC').classList.remove('d-none')
                        steppers.forEach(node => {
                            node.classList.remove('active');
                        });
                        e.currentTarget.classList.add('active');
                        document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-check-circle  text-success"></i> Información de Entrega <i class="fal fa-truck"></i>'
                        if (document.getElementById('entregaInfo').classList.contains('bg-danger')) {
                            document.getElementById('entregaInfo').classList.remove('bg-danger')
                        }
                    } else {
                        document.getElementById('entregaInfo').classList.add('bg-danger')
                        document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-times-circle"></i> Información de Entrega <i class="fal fa-truck"></i>'
                    }
                } 
                
            } else {
                window.location.href = "{{ url('/carrito') }}";
            }
                                
        }

        steppers.forEach(node => {
            node.addEventListener('click', handleClick)
        });

        document.getElementById('nextBtn').addEventListener('click', (e) => {
            let formP = document.getElementById('principalForm')/* .elements */
            const formData = new FormData(formP);

            
                if (formData.get('id_direccion') && formData.get('id_direccion') != 'on') {
                    document.getElementById('collapseFourC').classList.add('d-none')
                    document.getElementById('collapsefiveC').classList.remove('d-none')                  

                    steppers[1].classList.remove('active')
                    steppers[2].classList.add('active')
                    document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-check-circle  text-success"></i> Información de Entrega <i class="fal fa-truck"></i>'
                    if (document.getElementById('entregaInfo').classList.contains('bg-danger')) {
                        document.getElementById('entregaInfo').classList.remove('bg-danger')
                    }
                } else {
                    if(formData.get('first_name') && formData.get('last_name') && formData.get('email') && formData.get('telefono') && formData.get('id_municipio') && formData.get('direccion')) {
                        document.getElementById('collapseFourC').classList.add('d-none')
                        document.getElementById('collapsefiveC').classList.remove('d-none')             
                        steppers[1].classList.remove('active')
                        steppers[2].classList.add('active')           
                        document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-check-circle  text-success"></i> Información de Entrega <i class="fal fa-truck"></i>'
                        if (document.getElementById('entregaInfo').classList.contains('bg-danger')) {
                            document.getElementById('entregaInfo').classList.remove('bg-danger')
                        }
                    } else {
                        document.getElementById('entregaInfo').classList.add('bg-danger')
                        document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-times-circle"></i> Información de Entrega <i class="fal fa-truck"></i>'
                    }
                } 
                             

            console.log(steppers[2]);
        })

        document.getElementById('isSame').addEventListener('click', (e) => {
            if (e.target.checked) {
                document.getElementsByName('facturacion')[0].value = document.getElementsByName('direccion')[0].value
                console.log(document.getElementsByName('facturacion')[0].value);
            }            
        })
    </script>
@endpush