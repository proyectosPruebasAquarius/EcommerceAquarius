@extends('app')

@section('title',  'Verificar Compra')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item"><a href="{{ route('productos') }}">Productos</a></li>
<li class="breadcrumb-item"><a href="{{ route('carrito') }}">carrito</a></li>
<li class="breadcrumb-item active" aria-current="page">Finalizar Compra</li>

@endsection
@section('content')
        
    {{-- <div class="breadcrumbs">
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
    </div> --}}


    
    <section class="checkout-wrapper section">
        {{-- Stepper --}}
        
                <nav class="nav nav-pills flex-column flex-sm-row col-12 col-md-6 mx-auto text-center mb-2">
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
           
        {{-- End Stepper --}}

        @livewire('checkout-form')
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('helpers.js') }}"></script>
    <script>       
        window.addEventListener('load', function() {
            document.getElementById('principalForm').reset();
            dt = '{{ json_encode($direcciones) }}'
            console.log(dt);
            
        })
        startValidate(document.getElementById('principalForm'))

       /*  let toggle = (id) => {
            console.log(id);
            let shipping = document.getElementById(id)
            let form = document.getElementById('formHidden')

            if (shipping.checked) {
                form.classList.remove('d-none')
                document.querySelector('input[name="id_facturacion"]').checked = false;
            } else {
                form.classList.add('d-none')
            }
        } */
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

        let steppers = Array.from(document.querySelectorAll('.flex-sm-fill'))
        
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
                /* pasa si escogio una dirección existente */
                if (formData.get('id_direccion') && formData.get('id_direccion') != 'on' && formData.get('id_facturacion') && formData.get('id_facturacion') != 'on' || formData.get('recoger_tienda')) {
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

                    if (!document.getElementById('hidden-alert').classList.contains('d-none'))
                        document.getElementById('hidden-alert').classList.add('d-none')
                } else {
                    /* pasa si los campos obligatorios estan llenos */
                    if(formData.get('telefono') && formData.get('id_municipio') && formData.get('direccion') && formData.get('facturacion') && formData.get('municipio_facturacion')) {
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

                        if (!document.getElementById('hidden-alert').classList.contains('d-none'))
                        document.getElementById('hidden-alert').classList.add('d-none')
                    } else {
                        /* Ocurrio un error, campos no validados */
                        document.getElementById('entregaInfo').classList.add('bg-danger')
                        document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-times-circle"></i> Información de Entrega <i class="fal fa-truck"></i>'
                        /* console.log(formP.querySelectorAll('select')); */

                        document.getElementById('hidden-alert').classList.remove('d-none')
                        document.getElementById('alert-text').innerText = @json($direcciones).length > 0 ? 'Seleccione una dirección o si lo prefiere rellene el formulario.' : 'Rellene el formulario.'
                        
                        formP.querySelectorAll('input[type="text"], select').forEach(element => {
                            if (typeof element.options !== 'undefined') {
                                if (element.options[element.selectedIndex].text == 'Departamento') {
                                    element.classList.add('invalid-select')
                                    element.classList.add('is-invalid')
                                    document.getElementsByName('id_municipio')[0].classList.add('invalid-select')
                                    document.getElementsByName('municipio_facturacion')[0].classList.add('invalid-select')
                                    /* console.log('hola');
                                    console.log('i go it '); */
                                }

                                if (element.options[element.selectedIndex].text !== 'Departamento' && element.options[element.selectedIndex].text !== 'Seleccione un departamento') {
                                    if (element.classList.contains('invalid-select')) {
                                        element.classList.remove('invalid-select')
                                    }
                                }
                            }

                            if (element.value == '' && element.name != "referencia" && element.name != "referencia_facturacion" || element.value == null && element.name != "referencia" && element.name != "referencia_facturacion") {
                                element.classList.add('invalid')
                                element.classList.add('is-invalid')
                            } else {
                                if (element.classList.contains('invalid') && element.classList.contains('is-invalid')) {
                                    element.classList.remove('invalid')
                                    element.classList.remove('is-invalid')
                                }
                            }
                        });
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

            
                if (formData.get('id_direccion') && formData.get('id_direccion') != 'on' && formData.get('id_facturacion') && formData.get('id_facturacion') != 'on' || formData.get('recoger_tienda')) {
                    /* pasa si escogio una dirección existente */
                    document.getElementById('collapseFourC').classList.add('d-none')
                    document.getElementById('collapsefiveC').classList.remove('d-none')                  

                    steppers[1].classList.remove('active')
                    steppers[2].classList.add('active')
                    document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-check-circle  text-success"></i> Información de Entrega <i class="fal fa-truck"></i>'
                    if (document.getElementById('entregaInfo').classList.contains('bg-danger')) {
                        document.getElementById('entregaInfo').classList.remove('bg-danger')
                    }

                    if (!document.getElementById('hidden-alert').classList.contains('d-none'))
                        document.getElementById('hidden-alert').classList.add('d-none')
                } else {
                    /* pasa si los campos obligatorios estan llenos */
                    console.log(formData.get('id_direccion'));
                    if (formData.get('id_direccion') === 'on') {
                        if(formData.get('telefono') && formData.get('id_municipio') && formData.get('direccion') && formData.get('municipio_facturacion')) {
                            document.getElementById('collapseFourC').classList.add('d-none')
                            document.getElementById('collapsefiveC').classList.remove('d-none')             
                            steppers[1].classList.remove('active')
                            steppers[2].classList.add('active')           
                            document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-check-circle  text-success"></i> Información de Entrega <i class="fal fa-truck"></i>'
                            if (document.getElementById('entregaInfo').classList.contains('bg-danger')) {
                                document.getElementById('entregaInfo').classList.remove('bg-danger')
                            }

                            if (!document.getElementById('hidden-alert').classList.contains('d-none'))
                            document.getElementById('hidden-alert').classList.add('d-none')
                        } else {
                            /* Ocurrio un error, campos no validados */
                            document.getElementById('entregaInfo').classList.add('bg-danger')
                            document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-times-circle"></i> Información de Entrega <i class="fal fa-truck"></i>'

                            document.getElementById('hidden-alert').classList.remove('d-none')
                            document.getElementById('alert-text').innerText = @json($direcciones).length > 0 ? 'Seleccione una dirección o si lo prefiere rellene el formulario.' : 'Rellene el formulario.'
                            
                            formP.querySelectorAll('input[type="text"], select').forEach(element => {
                                if (typeof element.options !== 'undefined') {
                                    if (element.options[element.selectedIndex].text == 'Departamento') {
                                        element.classList.add('invalid-select')
                                        element.classList.add('is-invalid')
                                        document.getElementsByName('id_municipio')[0].classList.add('invalid-select')
                                        document.getElementsByName('municipio_facturacion')[0].classList.add('invalid-select')
                                        console.log('i go it ');
                                    }
                                }

                                if (element.value == '' && element.name != "referencia" || element.value == null && element.name != "referencia") {
                                    element.classList.add('invalid')
                                    element.classList.add('is-invalid')
                                } else {
                                    if (element.classList.contains('invalid') && element.classList.contains('is-invalid')) {
                                        element.classList.remove('invalid')
                                        element.classList.remove('is-invalid')
                                    }
                                }
                            });

                            document.getElementById('collapseFour').classList.add('show')
                        }
                    } else {
                        if(formData.get('telefono') && formData.get('id_municipio') && formData.get('direccion') && formData.get('municipio_facturacion')) {
                            document.getElementById('collapseFourC').classList.add('d-none')
                            document.getElementById('collapsefiveC').classList.remove('d-none')             
                            steppers[1].classList.remove('active')
                            steppers[2].classList.add('active')           
                            document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-check-circle  text-success"></i> Información de Entrega <i class="fal fa-truck"></i>'
                            if (document.getElementById('entregaInfo').classList.contains('bg-danger')) {
                                document.getElementById('entregaInfo').classList.remove('bg-danger')
                            }

                            if (!document.getElementById('hidden-alert').classList.contains('d-none'))
                            document.getElementById('hidden-alert').classList.add('d-none')
                        } else {
                            /* Ocurrio un error, campos no validados */
                            document.getElementById('entregaInfo').classList.add('bg-danger')
                            document.getElementById('entregaInfo').innerHTML = '<i class="fal fa-times-circle"></i> Información de Entrega <i class="fal fa-truck"></i>'

                            document.getElementById('hidden-alert').classList.remove('d-none')
                            document.getElementById('alert-text').innerText = @json($direcciones).length > 0 ? 'Seleccione una dirección o si lo prefiere rellene el formulario.' : 'Rellene el formulario.'
                            
                            formP.querySelectorAll('input[type="text"], select').forEach(element => {
                                if (typeof element.options !== 'undefined') {
                                    if (element.options[element.selectedIndex].text == 'Departamento') {
                                        element.classList.add('invalid-select')
                                        element.classList.add('is-invalid')
                                        document.getElementsByName('id_municipio')[0].classList.add('invalid-select')
                                        document.getElementsByName('municipio_facturacion')[0].classList.add('invalid-select')
                                        /* console.log('i go it '); */
                                    }
                                }

                                if (element.value == '' && element.name != "referencia" && element.name != "referencia_facturacion" || element.value == null && element.name != "referencia" && element.name != "referencia_facturacion") {
                                    element.classList.add('invalid')
                                    element.classList.add('is-invalid')
                                } else {
                                    if (element.classList.contains('invalid') && element.classList.contains('is-invalid')) {
                                        element.classList.remove('invalid')
                                        element.classList.remove('is-invalid')
                                    }
                                }
                            });

                            document.getElementById('collapseFour').classList.add('show')
                        }
                    }
                } 
                             

            console.log(steppers[2]);
        })

        let isSame = document.getElementById('isSame')
        if (isSame) {
            isSame.addEventListener('click', (e) => {
            if (e.target.checked) {
                document.getElementsByName('facturacion')[0].value = document.getElementsByName('direccion')[0].value
                document.getElementsByName('departamento_facturacion')[0].value = document.getElementsByName('departamento')[0].value
                /* Livewire.emit('updateMnList') */
                var opt = document.createElement('option');
                opt.value = document.getElementsByName('id_municipio')[0].value;
                console.log(document.getElementsByName('id_municipio')[0].selectedOptions[0].innerText);
                opt.innerHTML = document.getElementsByName('id_municipio')[0].selectedOptions[0].innerText
                opt.selected = true;
                opt.setAttribute('id', 'isSameMunicipio');
                document.getElementsByName('municipio_facturacion')[0].appendChild(opt);
                document.getElementsByName('referencia_facturacion')[0].value = document.getElementsByName('referencia')[0].value
                /* setTimeout(() => {
                    document.getElementsByName('municipio_facturacion')[0].value = document.getElementsByName('id_municipio')[0].value
                }, 1000) */
                /* console.log(document.getElementsByName('facturacion')[0].value); */
            } else {
                let removeMn = document.getElementById('isSameMunicipio')
                console.log(removeMn);
                if (removeMn) {
                    let selectobject = document.getElementById('municipio_facturacion');
                    for (var i=0; i<selectobject.length; i++) {
                        if (selectobject.options[i].value == document.getElementsByName('id_municipio')[0].value)
                        selectobject.remove(i);
                    }
                }
            }            
        })
        }

        let updateDir = (e) => {            
            Livewire.emit('updateModalDir', e)
        } 

        let whoClicked = (e) => {
            if (e.name == 'id_facturacion') {
                Livewire.emit('newValues', 'facturacion')
            } else {
                Livewire.emit('newValues', 'direccion')
            }

            var modal = new bootstrap.Modal(document.getElementById('modalDirecciones'));
                /* console.log(modal); */
                modal.show();
        }
    </script>
@endpush