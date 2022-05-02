@extends('app')

@section('title',  'Contactanos')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page">Contáctanos</li>

@endsection

@section('content')
{{-- <div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Contáctanos</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Inicio</a></li>
                    <li>Contáctanos</li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}


<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Contáctanos</h2>
                        {{-- <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p> --}}
                    </div>
                </div>
            </div>
            <div class="contact-info">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="single-info-head">

                            <div class="single-info">
                                <i class="lni lni-map"></i>
                                <h3>Dirección</h3>
                                <ul>
                                    <li>4a Calle Oriente, s/n, Barrio San Antonio,<br> Chalatenango, Chalatenango.</li>
                                </ul>
                            </div>


                            <div class="single-info">
                                <i class="lni lni-phone"></i>
                                <h3>Llámanos</h3>
                                <ul>
                                    <li><a href="tel:23059181">+503 2305-9181</a></li>
                                    {{-- <li><a href="tel:+321556667890">+503 55 666 7890</a></li> --}}
                                </ul>
                            </div>


                            <div class="single-info">
                                <i class="lni lni-envelope"></i>
                                <h3>Correo Electrónico</h3>
                                <ul>
                                    {{-- <li><a href="/cdn-cgi/l/email-protection#c8bbbdb8b8a7babc88bba0a7b8afbaa1acbbe6aba7a5"><span class="__cf_email__" data-cfemail="ee9d9b9e9e819c9aae9d86819e899c878a9dc08d8183">[email&#160;protected]</span></a>
                                    </li>
                                    <li><a href="/cdn-cgi/l/email-protection#9dfefceff8f8efddeef5f2edfaeff4f9eeb3fef2f0"><span class="__cf_email__" data-cfemail="3754564552524577445f584750455e53441954585a">[email&#160;protected]</span></a></li> --}}
                                    <li>
                                        <a href="mailto:contacto@aquariusit-sv.com">contacto@aquariusit-sv.com</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-12">
                        <div class="contact-form-head">
                            <div class="form-main">
                                <form class="form" method="post" action="{{ route('send.mail.contact') }}">
                                    @csrf
                                    @method('post')
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="name" type="text" placeholder="Nombre" required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="subject" type="text" placeholder="Título" required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="email" type="email" placeholder="Correo Electrónico" required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <input name="phone" type="text" placeholder="Teléfono" required="required">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group message">
                                                <textarea name="message" placeholder="Mensaje"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group button">
                                                <button type="submit" class="btn ">Enviar Mensaje</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection