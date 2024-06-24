@extends('layouts.site')

@section('content')
    <!--Page Title-->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('site/assets/images/shape/shape-9.png') }});"></div>
            <div class="pattern-2" style="background-image: url({{ asset('site/assets/images/shape/shape-10.png') }});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>{!! $data->title !!}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>{!! $data->title !!}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- property-details -->
    <section class="property-details property-details-one">
        <div class="auto-container">
            <div class="top-details clearfix">
                <div class="left-column pull-left clearfix">
                    <h3>{!! $data->title !!}</h3>
                    <div class="author-info clearfix">
                        <div class="author-box pull-left">
                            <figure class="author-thumb"><img src="{!! asset($data->user->image) !!}" alt="">
                            </figure>
                            <h6>{!! $data->user->name !!}</h6>
                        </div>

                    </div>
                </div>
                <div class="right-column pull-right clearfix">
                    <div class="price-inner clearfix">
                        <ul class="category clearfix pull-left">
                            @if ($data->type_rent)
                            <li><a href="javascript:void();">aluguel</a></li>
                            @endif
                            @if ($data->type_buy)
                            <li><a href="javascript:void();">à venda</a></li>
                            @endif
                        </ul>
                        <div class="price-box pull-right">
                            @if ($data->type_rent)
                            <h3>R$ {!! number_format($data->value_rent, 2) !!}</h3>
                            @endif
                            @if ($data->type_buy)
                            <h3>R$ {!! number_format($data->value_buy, 2) !!}</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-details-content">
                        <div class="carousel-inner">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">

                                @php
                                    $diretorio = public_path('storage/imovel/' . $data->id . '/');

                                    if (is_dir($diretorio)) {
                                        // Obtém todos os arquivos do diretório
                                        $arquivos = scandir($diretorio);

                                        // Itera sobre os arquivos
                                        foreach ($arquivos as $arquivo) {
                                            // Ignora arquivos especiais (., ..)
                                            if ($arquivo != '.' && $arquivo != '..') {
                                @endphp
                                <figure class="image-box"><img
                                        src="{{ asset(
                                                    'storage/imovel/' . $data->id . '/' . $arquivo,
                                                ) }}"
                                        alt="">
                                </figure>
                                @php
                                            }
                                        }
                                    }

                                @endphp
                            </div>
                        </div>
                        <div class="discription-box content-widget">
                            <div class="title-box">
                                <h4>Descrição do Imóvel</h4>
                            </div>
                            <div class="text">
                                <p>{!! $data->description !!}</p>
                            </div>
                        </div>
                        <div class="details-box content-widget">
                            <div class="title-box">
                                <h4>Detalhe do Imóvel</h4>
                            </div>
                            <ul class="list clearfix">
                                <li>Id do Imóvel: <span>{!! str_pad($data->id, 5, '0', STR_PAD_LEFT) !!}</span></li>
                                <li>Quartos: <span>{!! $data->bedroom !!}</span></li>
                                <li>Tipo: <span>{!! $data->type->name !!}</span></li>
                                <li>Banheiros: <span>{!! $data->bathroom !!}</span></li>
                            </ul>
                        </div>
                        <div class="amenities-box content-widget">
                            <div class="title-box">
                                <h4>Bem Feitoria</h4>
                            </div>
                            <ul class="list clearfix">
                                @foreach ($data->features()->get() as $item)
                                    <li>{!! $item->name !!}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="location-box content-widget">
                            <div class="title-box">
                                <h4>Localização</h4>
                            </div>
                            <ul class="info clearfix">
                                <li><span>Endereço:</span> {!! $data->address !!}</li>
                                <li><span>Estado:</span> {!! $data->state->name !!}</li>
                                <li><span>Bairro:</span> {!! $data->neighborhood !!}</li>
                                <li><span>Cidade:</span> {!! $data->city->name !!}</li>
                            </ul>
                            <div class="google-map-area" style="display: none">
                                <div class="google-map" id="contact-google-map" data-map-lat="40.712776"
                                    data-map-lng="-74.005974" data-icon-path="assets/images/icons/map-marker.png"
                                    data-map-title="Brooklyn, New York, United Kingdom" data-map-zoom="12"
                                    data-markers='{
                                            "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","assets/images/icons/map-marker.png"]
                                        }'>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="property-sidebar default-sidebar">
                        <div class="author-widget sidebar-widget">
                            <div class="author-box">
                                <figure class="author-thumb"><img src="{!! asset($data->user->image) !!}" alt="">
                                </figure>
                                <div class="inner">
                                    <h4>{!! $data->user->name !!}</h4>
                                    <ul class="info clearfix">
                                        <li class="d-none"><i class="fas fa-map-marker-alt"></i>84 St. John Wood High Street,
                                            St Johns Wood</li>
                                        <li><i class="fas fa-phone"></i><a href="tel:{!! $data->user->phone !!}">{!! $data->user->phone !!}</a></li>
                                    </ul>
                                    <div class="btn-box d-none"><a href="agents-details.html">View Listing</a></div>
                                </div>
                            </div>
                            <div class="form-inner d-none">
                                <form action="property-details.html" method="post" class="default-form">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Your name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="Phone" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property-details end -->
@endsection
