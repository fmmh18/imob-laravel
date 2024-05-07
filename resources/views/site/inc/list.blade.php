<!-- property-page-section -->
<section class="property-page-section property-list">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                <div class="default-sidebar property-sidebar">
                    <div class="filter-widget sidebar-widget">
                        <div class="widget-title">
                            <h5>Imóveis</h5>
                        </div>
                        <div class="widget-content">
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="Todos os tipos">Todos os tipos</option>
                                    @foreach ($allTypes as $type)
                                        <option value="{!! $type->id !!}">{!! $type->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select-box">
                                <select class="wide">
                                    <option data-display="Selecione a cidade">Selecione a cidade</option>
                                    @foreach ($allCities as $city)
                                        <option value="{!! $city->id !!}">{!! $city->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-btn">
                                <button type="submit" class="theme-btn btn-one"><i
                                        class="fas fa-filter"></i>&nbsp;Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left d-none">
                            <h5>Search Reasults: <span>Showing 1-5 of 20 Listings</span></h5>
                        </div>
                        <div class="right-column pull-right clearfix">
                            <div class="short-box clearfix">
                                <div class="select-box">
                                    <select class="wide">
                                        <option data-display="Sort by: Newest">Sort by: Newest</option>
                                        <option value="1">New Arrival</option>
                                        <option value="2">Top Rated</option>
                                        <option value="3">Offer Place</option>
                                        <option value="4">Most Place</option>
                                    </select>
                                </div>
                            </div>
                            <div class="short-menu clearfix">
                                <button class="list-view on"><i class="icon-35"></i></button>
                                <button class="grid-view"><i class="icon-36"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper list">
                        <div class="deals-list-content list-item">
                            @forelse ($allProperties as $data)
                                @php
                                    $diretorio = public_path('storage/imovel/' . $data->id . '/');
                                    $primeiraImagem = null;

                                    // Verifica se o diretório existe
                                    if (is_dir($diretorio)) {
                                        // Obtém todos os arquivos do diretório
                                        $arquivos = scandir($diretorio);

                                        // Itera sobre os arquivos
                                        foreach ($arquivos as $arquivo) {
                                            // Ignora arquivos especiais (., ..)
                                            if ($arquivo != '.' && $arquivo != '..') {
                                                // Verifica se o arquivo é uma imagem
                                                $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
                                                $primeiraImagem = asset('storage/imovel/' . $data->id . '/' . $arquivo);
                                                break; // Interrompe o loop após encontrar a primeira imagem
                                            }
                                        }
                                    }
                                @endphp
                                <div class="deals-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><img src="{!! $primeiraImagem !!}" alt="">
                                            </figure>
                                            @if ($data->type_rent)
                                                <span class="category">Aluguel</span>
                                            @endif
                                            @if ($data->type_buy)
                                                <div class="buy-btn"><a href="javascript:void()">Venda</a></div>
                                            @endif
                                        </div>
                                        <div class="lower-content">
                                            <div class="title-text">
                                                <h4><a href="property-details.html">{!! $data->title !!}</a></h4>
                                            </div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-left d-none">
                                                    <h6>Start From</h6>
                                                    <h4>$40,000.00</h4>
                                                </div>
                                                <div class="author-box pull-right">
                                                    <figure class="author-thumb">
                                                        <img src="{!! asset($data->user->image) !!}" alt="">
                                                        <span>{!! $data->user->name !!}</span>
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="price-box clearfix pt-3">
                                                @if ($data->type_rent)
                                                    <div class="price-info pull-left">
                                                        <h6>Aluguel</h6>
                                                        <h4>R$ {!! number_format($data->value_rent, 2) !!}</h4>
                                                    </div>
                                                @endif

                                                @if ($data->type_buy)
                                                    <div class="price-info  pull-right">
                                                        <h6>Venda</h6>
                                                        <h4>R$ {!! number_format($data->value_buy, 2) !!}</h4>
                                                    </div>
                                                @endif
                                            </div>
                                            <p>{!! $data->description !!}</p>
                                            <ul class="more-details clearfix">
                                                <li><i class="icon-14"></i>{!! $data->bedroom !!}
                                                    {!! $data->bedroom == 1 ? 'Qto' : 'Qtos' !!}</li>
                                                <li><i class="icon-15"></i>{!! $data->bathroom !!}
                                                    {!! $data->bedroom == 1 ? 'Bh' : 'Bhs' !!}</li>
                                                <li><i class="icon-16"></i>{!! $data->area !!} m²</li>
                                            </ul>
                                            <div class="other-info-box clearfix">
                                                <div class="btn-box pull-left"><a href="{!! route('detail', $data->id) !!}"
                                                        class="theme-btn btn-two">Mais detalhes</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @empty
                            @endforelse
                        </div>
                        <div class="deals-grid-content grid-item">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="assets/images/feature/feature-1.jpg"
                                                        alt=""></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-info clearfix">
                                                    <div class="author pull-left">
                                                        <figure class="author-thumb"><img
                                                                src="assets/images/feature/author-1.jpg" alt="">
                                                        </figure>
                                                        <h6>Michael Bean</h6>
                                                    </div>
                                                    <div class="buy-btn pull-right"><a href="property-details.html">For
                                                            Buy</a></div>
                                                </div>
                                                <div class="title-text">
                                                    <h4><a href="property-details.html">Villa on Grand Avenue</a></h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>$30,000.00</h4>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a href="property-details.html"><i class="icon-12"></i></a>
                                                        </li>
                                                        <li><a href="property-details.html"><i class="icon-13"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>3 Beds</li>
                                                    <li><i class="icon-15"></i>2 Baths</li>
                                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                                </ul>
                                                <div class="btn-box"><a href="property-details.html"
                                                        class="theme-btn btn-two">See Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="assets/images/feature/feature-2.jpg"
                                                        alt=""></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-info clearfix">
                                                    <div class="author pull-left">
                                                        <figure class="author-thumb"><img
                                                                src="assets/images/feature/author-2.jpg"
                                                                alt=""></figure>
                                                        <h6>Robert Niro</h6>
                                                    </div>
                                                    <div class="buy-btn pull-right"><a
                                                            href="property-details.html">For Rent</a></div>
                                                </div>
                                                <div class="title-text">
                                                    <h4><a href="property-details.html">Contemporary Apartment</a></h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>$45,000.00</h4>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-12"></i></a></li>
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-13"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>3 Beds</li>
                                                    <li><i class="icon-15"></i>2 Baths</li>
                                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                                </ul>
                                                <div class="btn-box"><a href="property-details.html"
                                                        class="theme-btn btn-two">See Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="assets/images/feature/feature-3.jpg"
                                                        alt=""></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-info clearfix">
                                                    <div class="author pull-left">
                                                        <figure class="author-thumb"><img
                                                                src="assets/images/feature/author-3.jpg"
                                                                alt=""></figure>
                                                        <h6>Keira Mel</h6>
                                                    </div>
                                                    <div class="buy-btn pull-right"><a
                                                            href="property-details.html">Sold Out</a></div>
                                                </div>
                                                <div class="title-text">
                                                    <h4><a href="property-details.html">Luxury Villa With Pool</a></h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>$63,000.00</h4>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-12"></i></a></li>
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-13"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>3 Beds</li>
                                                    <li><i class="icon-15"></i>2 Baths</li>
                                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                                </ul>
                                                <div class="btn-box"><a href="property-details.html"
                                                        class="theme-btn btn-two">See Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="assets/images/feature/feature-4.jpg"
                                                        alt=""></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-info clearfix">
                                                    <div class="author pull-left">
                                                        <figure class="author-thumb"><img
                                                                src="assets/images/feature/author-1.jpg"
                                                                alt=""></figure>
                                                        <h6>Michael Bean</h6>
                                                    </div>
                                                    <div class="buy-btn pull-right"><a
                                                            href="property-details.html">For Buy</a></div>
                                                </div>
                                                <div class="title-text">
                                                    <h4><a href="property-details.html">Home in Merrick Way</a></h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>$30,000.00</h4>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-12"></i></a></li>
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-13"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>3 Beds</li>
                                                    <li><i class="icon-15"></i>2 Baths</li>
                                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                                </ul>
                                                <div class="btn-box"><a href="property-details.html"
                                                        class="theme-btn btn-two">See Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="assets/images/feature/feature-5.jpg"
                                                        alt=""></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-info clearfix">
                                                    <div class="author pull-left">
                                                        <figure class="author-thumb"><img
                                                                src="assets/images/feature/author-2.jpg"
                                                                alt=""></figure>
                                                        <h6>Robert Niro</h6>
                                                    </div>
                                                    <div class="buy-btn pull-right"><a
                                                            href="property-details.html">For Rent</a></div>
                                                </div>
                                                <div class="title-text">
                                                    <h4><a href="property-details.html">Apartment in Glasgow</a></h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>$45,000.00</h4>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-12"></i></a></li>
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-13"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>3 Beds</li>
                                                    <li><i class="icon-15"></i>2 Baths</li>
                                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                                </ul>
                                                <div class="btn-box"><a href="property-details.html"
                                                        class="theme-btn btn-two">See Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="assets/images/feature/feature-6.jpg"
                                                        alt=""></figure>
                                                <div class="batch"><i class="icon-11"></i></div>
                                                <span class="category">Featured</span>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-info clearfix">
                                                    <div class="author pull-left">
                                                        <figure class="author-thumb"><img
                                                                src="assets/images/feature/author-3.jpg"
                                                                alt=""></figure>
                                                        <h6>Keira Mel</h6>
                                                    </div>
                                                    <div class="buy-btn pull-right"><a
                                                            href="property-details.html">Sold Out</a></div>
                                                </div>
                                                <div class="title-text">
                                                    <h4><a href="property-details.html">Family Home For Sale</a></h4>
                                                </div>
                                                <div class="price-box clearfix">
                                                    <div class="price-info pull-left">
                                                        <h6>Start From</h6>
                                                        <h4>$63,000.00</h4>
                                                    </div>
                                                    <ul class="other-option pull-right clearfix">
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-12"></i></a></li>
                                                        <li><a href="property-details.html"><i
                                                                    class="icon-13"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                                <ul class="more-details clearfix">
                                                    <li><i class="icon-14"></i>3 Beds</li>
                                                    <li><i class="icon-15"></i>2 Baths</li>
                                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                                </ul>
                                                <div class="btn-box"><a href="property-details.html"
                                                        class="theme-btn btn-two">See Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-wrapper">
                        <ul class="pagination clearfix">
                            <li><a href="property-list.html" class="current">1</a></li>
                            <li><a href="property-list.html">2</a></li>
                            <li><a href="property-list.html">3</a></li>
                            <li><a href="property-list.html"><i class="fas fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->
