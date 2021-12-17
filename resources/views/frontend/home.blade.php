@extends('app')

@section('title',  'Inicio')
@section('content')

<section class="hero-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 custom-padding-right">
                <div class="slider-head">

                    <div class="hero-slider">

                        @forelse ($trending as $tren)
                        <div class="single-slider rounded-3" style="background-image: linear-gradient(to right, rgba(42, 159, 255, 0.2) 0%, #fff 100%), url({{ json_decode($tren->imagen)[0] }}); background-size: contain; background-position: 100% 0%; background-blend-mode: multiply; background-repeat: no-repeat;">
                            <div class="content">
                                <h2>
                                    @if($tren->id_oferta > 0)
                                        <span>{{ $tren->oferta }}% hasta: {{ date('d/m/Y', strtotime($tren->tiempo_limite)) }}</span>
                                    @endif
                                    <a href="{{ route('detalle', Crypt::encrypt($tren->id_producto)) }}">{{ $tren->nombre }}</a>
                                    
                                </h2>
                                <div class="badge text-wrap text-start">
                                    
                                    <p style="color: #424242">{{ substr($tren->descripcion, 0, 205).'...' }}</p>
                                </div>
                                
                                <h3>
                                    @if($tren->state == 1)
                                    <span style="color: #424242">Precio Oferta</span>
                                    @endif
                                     ${{ $tren->state == 1 ?  number_format($tren->precio_venta * (('100' - number_format($tren->oferta))) / '100', 2, '.', '') : $tren->precio_venta  }}
                                </h3>
                                <div class="button">
                                    <a href="{{ route('detalle', Crypt::encrypt($tren->id_producto)) }}" class="btn">Comprar Ahora</a>
                                </div>
                            </div>
                        </div>
                        @empty

                        @endforelse



                        {{-- <div class="single-slider" style="background-image: url(frontend/assets/images/hero/slider-bg2.jpg);">
                            <div class="content">
                                <h2><span>Big Sale Offer</span> Get the Best Deal on CCTV Camera
                                </h2>
                                <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.</p>
                                <h3><span>Combo Only:</span> $590.00</h3>
                                <div class="button">
                                    <a href="product-grids.html" class="btn">Shop Now</a>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                </div>
            </div>
            
        </div>
    </div>
</section>

@livewire('trending-products')

@push('scripts')
<script type="text/javascript">
    //========= Hero Slider
    tns({
        container: '.hero-slider',
        slideBy: 'page',
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 0,
        items: 1,
        nav: false,
        controls: true,
        controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
    });

    //======== Brand Slider
    tns({
        container: '.brands-logo-carousel',
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 15,
        nav: false,
        controls: false,
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 3,
            },
            768: {
                items: 5,
            },
            992: {
                items: 6,
            }
        }
    });
</script>
@endpush
@endsection