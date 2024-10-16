<!-- property-page-section -->
<style>
    .image-box figure {
        height: 100%;
        width: 100%;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Faz a imagem preencher o contêiner e cortar o excesso */
        object-position: center;
        /* Centraliza a imagem dentro do contêiner */
    }
</style>
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
                            <h5>Resultado: <span>Mostrando
                                    {{ $allProperties->firstItem() }}-{{ $allProperties->lastItem() }} de
                                    {{ $allProperties->total() }} Listagens</span></h5>
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
                                            <figure class="image" style="width: 300px;height: 350px !important;"><img
                                                    src="{!! $primeiraImagem !!}" alt="">
                                            </figure>
                                            @if ($data->type_rent)
                                                <div class="buy-btn"><a href="{!! route('detail', $data->id) !!}"> Aluguel</a>
                                                </div>
                                            @endif
                                            @if ($data->type_buy)
                                                <div class="buy-btn"><a href="{!! route('detail', $data->id) !!}">Venda</a></div>
                                            @endif
                                        </div>
                                        <div class="lower-content">
                                            <div class="title-text">
                                                <h4><a href="{!! route('detail', $data->id) !!}">{!! $data->title !!}</a></h4>
                                            </div>
                                            <div class="price-box clearfix">

                                                @if ($data->type_rent)
                                                    <div class="price-info pull-left">
                                                        <h6>Aluguel</h6>
                                                        <h4>R$ {!! number_format($data->value_rent, 2, ',', '.') !!}</h4>
                                                    </div>
                                                @endif

                                                @if ($data->type_buy)
                                                    <div class="price-info  pull-left">
                                                        <h6>Venda</h6>
                                                        <h4>R$ {!! number_format($data->value_buy, 2, ',', '.') !!}</h4>
                                                    </div>
                                                @endif
                                                <div class="author-box pull-right">
                                                    <figure class="author-thumb">
                                                        <img src="{!! asset($data->user->image) !!}" alt="">
                                                        <span>{!! $data->user->name !!}</span>
                                                    </figure>
                                                </div>
                                            </div>
                                            <p>
                                                {!! Str::limit($data->description, 60, '...') !!}
                                            </p>
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
                        <div class="deals-grid-content grid-item">
                            <div class="row clearfix">
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
                                                    $primeiraImagem = asset(
                                                        'storage/imovel/' . $data->id . '/' . $arquivo,
                                                    );
                                                    break; // Interrompe o loop após encontrar a primeira imagem
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="col-lg-6 col-md-6 col-sm-12 feature-block">
                                        <div class="feature-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image" style="width: 370px;height: 250px;"><img
                                                            src="{!! $primeiraImagem !!}" alt="">
                                                    </figure>
                                                </div>
                                                <div class="lower-content">

                                                    <div class="author-info clearfix">
                                                        <div class="author pull-left">
                                                            <figure class="author-thumb"><img
                                                                    src="{!! asset($data->user->image) !!}" alt="">
                                                            </figure>
                                                            <h6>{!! $data->user->name !!}</h6>
                                                        </div>
                                                        @if ($data->type_rent)
                                                            <div class="buy-btn pull-right"><a
                                                                    href="{!! route('detail', $data->id) !!}">Aluguel</a></div>
                                                        @endif
                                                        @if ($data->type_buy)
                                                            <div class="buy-btn pull-right"><a
                                                                    href="{!! route('detail', $data->id) !!}">Venda</a></div>
                                                        @endif
                                                    </div>
                                                    <div class="title-text">
                                                        <h4><a
                                                                href="{!! route('detail', $data->id) !!}">{!! $data->title !!}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        @if ($data->type_rent)
                                                            <div class="price-info pull-left">
                                                                <h4>R$ {!! number_format($data->value_rent, 2, ',', '.') !!}</h4>
                                                            </div>
                                                        @endif

                                                        @if ($data->type_buy)
                                                            <div class="price-info  pull-left">
                                                                <h4>R$ {!! number_format($data->value_buy, 2, ',', '.') !!}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p class="description">
                                                        {!! Str::limit($data->description, 100, '...') !!}
                                                    </p>
                                                    <ul class="more-details clearfix">
                                                        <li><i class="icon-14"></i>{!! $data->bedroom !!}
                                                            {!! $data->bedroom == 1 ? 'Qto' : 'Qtos' !!}</li>
                                                        <li><i class="icon-15"></i>{!! $data->bathroom !!}
                                                            {!! $data->bedroom == 1 ? 'Bh' : 'Bhs' !!}</li>
                                                        <li><i class="icon-16"></i>{!! $data->area !!} m²</li>
                                                    </ul>
                                                    <div class="other-info-box clearfix">
                                                        <div class="btn-box pull-left"><a
                                                                href="{!! route('detail', $data->id) !!}"
                                                                class="theme-btn btn-two">Mais detalhes</a></div>
                                                    </div>
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
                        </div>
                        @if ($allProperties->count() > 0)
                            <div class="pagination-wrapper">
                                <ul class="pagination clearfix">
                                    @if ($allProperties->onFirstPage())
                                        <li class="disabled d-none"><span>&laquo;</span></li>
                                    @else
                                        <li><a href="{{ $allProperties->previousPageUrl() }}"
                                                rel="prev">&laquo;</a>
                                        </li>
                                    @endif

                                    @foreach ($allProperties->getUrlRange(1, $allProperties->lastPage()) as $page => $url)
                                        @if ($page == $allProperties->currentPage())
                                            <li class="current"><a href="#">{{ $page }}</a></li>
                                        @else
                                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    @if ($allProperties->hasMorePages())
                                        <li><a href="{{ $allProperties->nextPageUrl() }}" rel="next">&raquo;</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- property-page-section end -->
