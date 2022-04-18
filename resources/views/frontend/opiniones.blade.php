@extends('app')

@section('title', 'Opiniones')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Opiniones</li>
@endsection

@section('content')
<section>
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h3>
                    Opiniones de Nuestros Clientes
                </h3>
            </div>
        </div>
    </div>
</section>
<section class="testimonial-section d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 testi-img">
                <div class="img-box">
                    <div class="circle"></div>
                    <div class="img-box-inner">
                        <img src="{{ asset('frontend/assets/images/testimonial/1.png') }}" alt="testi img">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="myCarousel" class="carousel slide" data-bs-interval="5000" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item testi-item active" data-color="#fb9c9a"
                            data-img="{{ asset('frontend/assets/images/testimonial/1.png') }}">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nobis ratione, harum
                                doloremque aspernatur aliquid quaerat dolores voluptates recusandae qui repellat illum,
                                amet ipsa debitis fugiat commodi nemo suscipit ad!</p>
                            <h3>john doe 1 - <span>web developer</span></h3>
                        </div>
                        <div class="carousel-item testi-item" data-color="#fbd39a" data-img="{{ asset('frontend/assets/images/testimonial/2.png') }}">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nobis ratione, harum
                                doloremque aspernatur aliquid quaerat dolores voluptates recusandae qui repellat illum,
                                amet ipsa debitis fugiat commodi nemo suscipit ad!</p>
                            <h3>john doe 2 - <span>web developer</span></h3>
                        </div>
                        <div class="carousel-item testi-item" data-color="#9ab0fb" data-img="{{ asset('frontend/assets/images/testimonial/3.png') }}">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non nobis ratione, harum
                                doloremque aspernatur aliquid quaerat dolores voluptates recusandae qui repellat illum,
                                amet ipsa debitis fugiat commodi nemo suscipit ad!</p>
                            <h3>john doe 3 - <span>web developer</span></h3>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="prev">
                        <img src="{{ asset('frontend/assets/images/icons/left-arrow.png') }}" alt="prev">
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel"
                        data-bs-slide="next">
                        <img src="{{ asset('frontend/assets/images/icons/right-arrow.png') }}" alt="prev">
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .testimonial-section {
        background-color: #ffffff;
        padding: 80px 0;
        min-height: 100vh;
    }

    .testi-img .img-box {
        max-width: 360px;
        margin: auto;
        text-align: center;
        position: relative;
    }

    .testi-img .circle {
        height: 360px;
        width: 360px;
        background-color: #fb9c9a;
        position: absolute;
        border-radius: 50%;
        left: 0;
        bottom: 0;
        transition: all 0.5s ease;
    }

    .testi-img .img-box-inner {
        position: relative;
        border-radius: 0 0 180px 180px;
        overflow: hidden;
    }

    .testi-img .img-box-inner img {
        max-width: 310px;
    }

    .testimonial-section .carousel-inner {
        margin-bottom: 20px;
    }

    .testimonial-section .carousel-control-prev {
        margin-right: 10px;
    }

    .testimonial-section .carousel-control-next,
    .testimonial-section .carousel-control-prev {
        position: relative;
        height: 35px;
        width: 35px;
        background-color: #fb9c9a;
        display: inline-flex;
        border-radius: 50%;
    }

    .testimonial-section .carousel-control-prev img,
    .testimonial-section .carousel-control-next img {
        width: 15px;
    }

    .testi-item h3,
    .testi-item p {
        font-size: 18px;
    }

    .testi-item h3 {
        text-transform: capitalize;
    }

    /* Responsive */
    @media(max-width:991px) {
        .testi-img .img-box {
            max-width: 300px;
        }

        .testi-img .circle {
            height: 300px;
            width: 300px;
        }

        .testi-img .img-box-inner {
            border-radius: 0 0 150px 150px;
        }

        .testi-img .img-box-inner img {
            max-width: 230px;
        }
    }

    @media(max-width:767px) {
        .testi-img {
            margin-bottom: 25px;
        }
    }
</style>
@endpush
@push('scripts')
<script>
    const myCarousel = document.getElementById('myCarousel')
    myCarousel.addEventListener('slid.bs.carousel', function () {
      const activeItem = this.querySelector(".active");
      document.querySelector(".testi-img img").src = activeItem.getAttribute("data-img");
      document.querySelector(".testi-img .circle").style.backgroundColor = activeItem.getAttribute("data-color");
    })
</script>
@endpush