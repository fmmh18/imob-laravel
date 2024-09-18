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
                            <form action="{!! route('list') !!}" method="GET">
                                <div class="select-box">
                                    <select class="wide" name="type">
                                        <option data-display="Todos os tipos">Todos os tipos</option>
                                        @foreach ($allTypes as $type)
                                            <option value="{!! $type->id !!}">{!! $type->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="select-box">
                                    <select class="wide" name="city">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="property-content-side">
                    <div class="item-shorting clearfix">
                        <div class="left-column pull-left ">
                            <h5>Resultado: <span>Showing 1-5 of 20 Listings</span></h5>
                        </div>
                        <div class="right-column pull-right clearfix">
                            <div class="short-box clearfix d-none">
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
                                    // $diretorio = asset('storage/imovel/' . $data->id . '/');
                                    $diretorio = base_path('public_html/storage/imovel/' . $data->id);

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

                                <div class="col-12 text-center">
                                    <h3>Não existe imóveis cadastrados!</h3>
                                </div>
                            @endforelse
                        </div>
                        @if ($allProperties->count() > 0)
                            {!! $allProperties->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->
