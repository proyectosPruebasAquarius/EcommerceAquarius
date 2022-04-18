<div>
    <!-- Modal -->
    <div class="modal fade" id="atencionClienteModal" tabindex="-1" aria-labelledby="atencionClienteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="atencionClienteModalLabel">
                    @if($type === 'services')
                        Servicio de atención al cliente
                    @elseif ($type === 'sucursal')
                        Sucursales Mi Tiendita
                    @elseif ($type === 'promocion')
                        Promociones
                    @endif
                </h5>
                <button type="button" class="btn-close border rounded border-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($type === 'services')
                    <div class="row">
                        <div class="col-12 p-0">
                            <img src="{{ asset('frontend/assets/images/call-center.jpg') }}" alt="Service Modal" class="img-fluid h-auto w-100 curve-border" >
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            
                            <div class="col-12 mt-2">
                                <h5>Nuestras Lineas de Contacto</h5>
                                <p>Horarios de Atención: <br>
                                    <span>Lunes - Viernes: 8:00am - 5:00pm</span><br>
                                    <span>Sabados: 8:00am - 12:00md</span><br>
                                </p>
                            </div>
                            <div class="col-12 mt-2">
                                <p>Whatsapp: <span><a href="https://wa.me/50377948668" target="_blank">7794-8668</a></span></p>
                            </div>
                            <div class="col-12 mt-2">
                                <p>Facebook Messenger: <span><a href="https://m.me/110812464804606">Mi Tiendita</a></span></p>
                            </div>
                            <div class="col-12 mt-2">
                                <p>Teléfono: <span><a href="tel:23059181">2305-9181</a></span></p>
                            </div>
                            <div class="col-12 mt-2">
                                <p>Email: <span><a href="mail:contacto@aquariusit-sv.com">contacto@aquariusit-sv.com</a></span></p>
                            </div>  
                            <div class="col-12 mt-2">
                                <p>Formulario de Contacto: <span><a href="{{ url('/contacto') }}">Formulario</a></span></p>
                            </div> 
                            <div class="col-12 mt-2">
                                <p>Dirección: <span><p>4a Calle Oriente, Barrio San Antonio, Chalatenango, Chalatenango</p></span></p>
                            </div>                      
                        </div>
                    </div>
                @elseif ($type === 'sucursal')
                    <div class="ratio" style="--bs-aspect-ratio: 100%;">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1kiA7vev36cVLbBhC9jNc4DVAAQo&ehbc=2E312F" allowfullscreen></iframe>
                    </div>
                @elseif ($type === 'promocion')
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="{{ asset('frontend/assets/images/banner/banner_prueba.png') }}" class="d-block w-100" alt="...">
                            {{-- <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                            </div> --}}
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="{{ asset('frontend/assets/images/banner/banner_prueba.png') }}" class="d-block w-100" alt="...">
                            {{-- <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                            </div> --}}
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('frontend/assets/images/banner/banner_prueba.png') }}" class="d-block w-100" alt="...">
                            {{-- <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
                            </div> --}}
                        </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                @endif
                
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            'use strict';

            var modalAtn = document.getElementById('atencionClienteModal');
            modalAtn.addEventListener('hide.bs.modal', function (event) {
                Livewire.emit('cleanModalType');
            });
        </script>
    @endpush
</div>
