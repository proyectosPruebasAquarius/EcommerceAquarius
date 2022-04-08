<div>
    


    {{-- <section class="featured-categories section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Featured Categories</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-category">
                        <h3 class="heading">TV & Audios</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="frontend/assets/images/featured-categories/fetured-item-1.png" alt="#">
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-category">
                        <h3 class="heading">Desktop & Laptop</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="frontend/assets/images/featured-categories/fetured-item-2.png" alt="#">
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-category">
                        <h3 class="heading">Cctv Camera</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="frontend/assets/images/featured-categories/fetured-item-3.png" alt="#">
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-category">
                        <h3 class="heading">Dslr Camera</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="frontend/assets/images/featured-categories/fetured-item-4.png" alt="#">
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-category">
                        <h3 class="heading">Smart Phones</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="frontend/assets/images/featured-categories/fetured-item-5.png" alt="#">
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-category">
                        <h3 class="heading">Game Console</h3>
                        <ul>
                            <li><a href="product-grids.html">Smart Television</a></li>
                            <li><a href="product-grids.html">QLED TV</a></li>
                            <li><a href="product-grids.html">Audios</a></li>
                            <li><a href="product-grids.html">Headphones</a></li>
                            <li><a href="product-grids.html">View All</a></li>
                        </ul>
                        <div class="images">
                            <img src="frontend/assets/images/featured-categories/fetured-item-6.png" alt="#">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}


    @if(count($offerts) > 0)
    <section class="special-offer section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Ofertas Especiales</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($offerts as $offert)
               
                @php
                    if (!\Cart::isEmpty()) {
                        $localCartU = \Cart::get($offert->id);
                        if ($localCartU) {
                            $localCart[$loop->index] = \Cart::get($offert->id)->toArray();
                        }
                    } 
                @endphp
                    
                    <div class="col-lg-3 col-md-6 col-12">

                        <div class="single-product" style="cursor: pointer;" onclick="javascript:window.location.href='{{ route('detalle', Crypt::encrypt($offert->id_producto)) }}'">
                            <div class="product-image">
                                <img src="{{ json_decode($offert->imagen)[0] }}" alt="#" width="100" height="250">
                                <span class="sale-tag">{{ $offert->oferta }}%</span>
                                {{-- <div class="button">
                                    @if($offert->stock > 0)
                                        @if (isset($localCart[$loop->index]))
                                            @if($localCart[$loop->index]['quantity'] < $offert->stock)
                                                <button wire:click="addToCart({{ $offert }})" class="btn"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                            @else
                                            <button class="btn" disabled><i class="fas fa-ban"></i> Agotado</button>
                                            @endif
                                        @else
                                        <button wire:click="addToCart({{ $offert }})" class="btn"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                        @endif
                                    @else
                                    <button class="btn" disabled><i class="fas fa-ban"></i> Agotado</button>
                                    @endif
                                </div> --}}
                            </div>
                            <div class="product-info">
                                <span class="category">
                                    <span class="badge rounded-pill bg-light text-dark">{{ $offert->categoria }}</span>
                                    <span class="badge rounded-pill text-dark" style="background: #fcde67">{{ $offert->marca }}</span>
                                </span>
                                <h4 class="title">
                                    <a href="{{ route('detalle', Crypt::encrypt($offert->id_producto)) }}">{{ $offert->nombre }}</a>
                                </h4>
                                {{-- <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><span>5.0 Review(s)</span></li>
                                </ul> --}}
                                <div class="price">
                                    <span>{{ $offert->state == 1 ? 'Oferta $'. number_format($offert->precio_venta * (('100' - number_format($offert->oferta)) / '100'), 2, '.', '')  : '$'. $offert->precio_venta }}</span>
                                    <span class="discount-price">${{ $offert->precio_venta }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                   
                   
                @empty
                    <p class="text-center">{{ __('No se encontraron productos en oferta') }}</p>
                @endforelse




            </div>
        </div>
    </section>
    @endif


    <section class="banner section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner" style="background-image:url('frontend/assets/images/banner/banner-car.png')">
                        <div class="content">
                            <h2>Productos Nuevos</h2>
                            <p class="text-black" style="color:black !important;">Productos<br>de las mejores marcas.</p>
                            <div class="button">
                                <a href="{{ route('productos') }}" class="btn">Ver los productos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner custom-responsive-margin" style="background-image:url('frontend/assets/images/banner/banner-car-2.png')">
                        <div class="content">
                            <h2>Descubre nuestro catalogo</h2>
                            <p class="text-black" style="color:black !important;">Variedad de Productos, <br>Variedad de Marcas.</p>
                            <div class="button">
                                <a href="{{ route('productos') }}" class="btn">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Últimos Productos</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($trending as $tr)

                @php                    
                    if (!\Cart::isEmpty()) {
                        $localCartUTr = \Cart::get($tr->id);
                        if ($localCartUTr) {
                            $localCartTr[$loop->index] = \Cart::get($tr->id)->toArray();
                        }
                    } 
                @endphp
                <div class="col-lg-3 col-md-6 col-12">

                    <div class="single-product" style="cursor: pointer;" onclick="javascript:window.location.href='{{ route('detalle', Crypt::encrypt($tr->id_producto)) }}'">
                        <div class="product-image">
                            {{-- {{ json_decode($tr->imagen)[0] }} --}}
                            <img src="{{ json_decode($tr->imagen)[0] }}" alt="#" width="300" height="300">
                            @if ($tr->state)
                            <span class="sale-tag">{{ $tr->oferta }}%</span>
                            @endif
                            {{--  <div class="button">
                                @if ($tr->stock > 0)
                                    @if (isset($localCartTr[$loop->index]))
                                        @if($localCartTr[$loop->index]['quantity'] < $tr->stock)
                                        <button wire:click="addToCart({{ $tr }})" class="btn"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                        @else
                                        <button class="btn" disabled><i class="fas fa-ban"></i> Agotado</button>
                                        @endif
                                    @else
                                        <button wire:click="addToCart({{ $tr }})" class="btn"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                    @endif
                                @else
                                <button class="btn" disabled><i class="fas fa-ban"></i> Agotado</button>
                                @endif
                            </div> --}}
                        </div>
                        <div class="product-info">
                            <span class="category">
                                <span class="badge rounded-pill bg-light text-dark">{{ $tr->categoria }}</span>
                                <span class="badge rounded-pill text-dark" style="background: #fcde67">{{ $tr->marca }}</span>
                            </span>
                            <h4 class="title">
                                <a href="{{ route('detalle', Crypt::encrypt($tr->id_producto)) }}">{{ $tr->nombre }}</a>
                            </h4>
                            {{-- <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star"></i></li>
                                <li><span>4.0 Review(s)</span></li>
                            </ul> --}}
                            <div class="price">
                                <span>{{ $tr->state == 1 ? 'Oferta $'. number_format($tr->precio_venta * (('100' - number_format($tr->oferta)) / '100'), 2, '.', '')  : '$'. $tr->precio_venta }}</span>
                                @if ($tr->state)
                                <span class="discount-price">${{ $tr->precio_venta }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                @empty
                    {{ __('No se encontraron productos.') }}
                @endforelse

            </div>
        </div>
    </section>


    {{-- <section class="home-product-list section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">Best Sellers</h4>

                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/01.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">GoPro Hero4 Silver</a>
                            </h3>
                            <span>$287.99</span>
                        </div>
                    </div>


                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/02.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Puro Sound Labs BT2200</a>
                            </h3>
                            <span>$95.00</span>
                        </div>
                    </div>


                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/03.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">HP OfficeJet Pro 8710</a>
                            </h3>
                            <span>$120.00</span>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-12 custom-responsive-margin">
                    <h4 class="list-title">New Arrivals</h4>

                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/04.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">iPhone X 256 GB Space Gray</a>
                            </h3>
                            <span>$1150.00</span>
                        </div>
                    </div>


                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/05.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Canon EOS M50 Mirrorless Camera</a>
                            </h3>
                            <span>$950.00</span>
                        </div>
                    </div>


                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/06.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Microsoft Xbox One S</a>
                            </h3>
                            <span>$298.00</span>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <h4 class="list-title">Top Rated</h4>

                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/07.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Samsung Gear 360 VR Camera</a>
                            </h3>
                            <span>$68.00</span>
                        </div>
                    </div>


                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/08.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Samsung Galaxy S9+ 64 GB</a>
                            </h3>
                            <span>$840.00</span>
                        </div>
                    </div>


                    <div class="single-list">
                        <div class="list-image">
                            <a href="product-grids.html"><img src="frontend/assets/images/home-product-list/09.jpg" alt="#"></a>
                        </div>
                        <div class="list-info">
                            <h3>
                                <a href="product-grids.html">Zeus Bluetooth Headphones</a>
                            </h3>
                            <span>$28.00</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}


    {{-- <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <h2 class="title">Marcas Populares</h2>
                </div>
            </div>
            <div class="brands-logo-wrapper">
                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">

                    @foreach($marcas as $marca)
                    <div class="brand-logo">
                        <img src="{{asset('storage/imagenes/marcas/')}}/{{$marca->imagen}}" alt="Imagenes de marcas">
                    </div>

                  @endforeach
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <section class="blog-section section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest News</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="blog-single-sidebar.html">
                                <img src="frontend/assets/images/blog/blog-1.jpg" alt="#">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="javascript:void(0)">eCommerce</a>
                            <h4>
                                <a href="blog-single-sidebar.html">What information is needed for shipping?</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="blog-single-sidebar.html">
                                <img src="frontend/assets/images/blog/blog-2.jpg" alt="#">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="javascript:void(0)">Gaming</a>
                            <h4>
                                <a href="blog-single-sidebar.html">Interesting fact about gaming consoles</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12">

                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="blog-single-sidebar.html">
                                <img src="frontend/assets/images/blog/blog-3.jpg" alt="#">
                            </a>
                        </div>
                        <div class="blog-content">
                            <a class="category" href="javascript:void(0)">Electronic</a>
                            <h4>
                                <a href="blog-single-sidebar.html">Electronics, instrumentation & control engineering
                                </a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                            </p>
                            <div class="button">
                                <a href="javascript:void(0)" class="btn">Read More</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}


    <section class="shipping-info">
        <div class="container">
            <ul>

                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Envio Gratis</h5>
                        <span>En Ordenes Mayores de $99</span>
                    </div>
                </li>

                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>Soporte.</h5>
                        <span>Llamadas\Chat.</span>
                    </div>
                </li>

                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Pagos Online.</h5>
                        <span>Servicio de Pagos Seguros.</span>
                    </div>
                </li>

                <li>
                    <div class="media-icon">
                        <i class="lni lni-certificate"></i>
                    </div>
                    <div class="media-body">
                        <h5>Garantia.</h5>
                        <span>Garantia del Fabricante.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
</div>
