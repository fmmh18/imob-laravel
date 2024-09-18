<!-- feature-style-two -->
<style>
    /* Centralizar o Tab Nav */
    .nav-tabs {
        display: flex;
        justify-content: center;
        /* Centraliza os itens */
        border-bottom: none;
        /* Remove a borda inferior, se necessário */
    }

    /* Remover bordas ao redor dos itens do tab */
    .nav-tabs .nav-item .nav-link {
        border: none;
        /* Remove as bordas dos botões */
        outline: none;
        /* Remove qualquer outline */
    }

    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-body {
        flex-grow: 1;
        /* Garante que o corpo do card preencha o espaço disponível */
    }

    .card-title {
        min-height: 50px;
        /* Definir uma altura mínima para o título se necessário */
    }
</style>
<section class="feature-style-two sec-pad">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Imóveis</h2>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="propertyTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="allPropertiesTab" data-toggle="tab" href="#allProperties"
                            role="tab" aria-controls="allProperties" aria-selected="true">
                            <h5>Todos</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rentPropertiesTab" data-toggle="tab" href="#rentProperties"
                            role="tab" aria-controls="rentProperties" aria-selected="false">
                            <h5>Aluguel</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="buyPropertiesTab" data-toggle="tab" href="#buyProperties" role="tab"
                            aria-controls="buyProperties" aria-selected="false">
                            <h5>Venda</h5>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="propertyTabsContent">
                    <div class="tab-pane fade show active" id="allProperties" role="tabpanel"
                        aria-labelledby="allPropertiesTab">
                        <div class="container my-2">
                            <div class="row">
                                @forelse ($allProperties as $property)
                                    @php
                                        $diretorio = base_path('public_html/storage/imovel/' . $property->id);

                                        //    $diretorio = asset('storage/imovel/' . $property->id . '/');
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
                                                        'storage/imovel/' . $property->id . '/' . $arquivo,
                                                    );
                                                    break; // Interrompe o loop após encontrar a primeira imagem
                                                }
                                            }
                                        }
                                    @endphp

                                    <div class="col-12 col-md-4 col-lg-4 my-4">
                                        <div class="feature-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><img src="{!! $primeiraImagem !!}"
                                                            style="max-height:200px">
                                                    </figure>
                                                    <div class="batch d-none"><i class="icon-11"></i></div>
                                                    <span class="category d-none">Featured</span>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="title-text pt-2">
                                                        <h4><a href="property-details.html">{!! $property->title !!}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        @if ($property->type_rent)
                                                            <div class="price-info pull-left">
                                                                <h6>Aluguel</h6>
                                                                <h4>R$ {!! number_format($property->value_rent, 2) !!}</h4>
                                                            </div>
                                                        @endif

                                                        @if ($property->type_buy)
                                                            <div
                                                                class="price-info  pull-left @if ($property->type_rent) ml-5 @endif">
                                                                <h6>Venda</h6>
                                                                <h4>R$ {!! number_format($property->value_buy, 2) !!}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p>{!! limitHtmlString($property->description, 120) !!}</p>
                                                    <ul class="more-details clearfix">
                                                        <li><i class="icon-14"></i>{!! $property->bedroom !!}
                                                            {!! $property->bedroom == 1 ? 'Qto' : 'Qtos' !!}</li>
                                                        <li><i class="icon-15"></i>{!! $property->bathroom !!}
                                                            {!! $property->bedroom == 1 ? 'Bh' : 'Bhs' !!}</li>
                                                        <li><i class="icon-16"></i>{!! $property->area !!}²</li>
                                                    </ul>
                                                    <div class="btn-box"><a href="{!! route('detail', $property->id) !!}"
                                                            class="theme-btn btn-two">Mais detalhes</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <h3>Não existem imóveis cadastrados!</h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="rentProperties" role="tabpanel" aria-labelledby="rentPropertiesTab">
                        <div class="container my-2">
                            <div class="row">
                                @forelse ($allProperties->where('type_rent',1) as $property)
                                    @php
                                        $diretorio = public_path('storage/imovel/' . $property->id . '/');
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
                                                        'storage/imovel/' . $property->id . '/' . $arquivo,
                                                    );
                                                    break; // Interrompe o loop após encontrar a primeira imagem
                                                }
                                            }
                                        }
                                    @endphp

                                    <div class="col-4 my-4">
                                        <div class="feature-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><img src="{!! $primeiraImagem !!}"
                                                            style="max-height:200px">
                                                    </figure>
                                                    <div class="batch d-none"><i class="icon-11"></i></div>
                                                    <span class="category d-none">Featured</span>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="title-text pt-2">
                                                        <h4><a href="property-details.html">{!! $property->title !!}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        @if ($property->type_rent)
                                                            <div class="price-info pull-left">
                                                                <h6>Aluguel</h6>
                                                                <h4>R$ {!! number_format($property->value_rent, 2) !!}</h4>
                                                            </div>
                                                        @endif

                                                        @if ($property->type_buy)
                                                            <div
                                                                class="price-info  pull-left @if ($property->type_rent) ml-5 @endif">
                                                                <h6>Venda</h6>
                                                                <h4>R$ {!! number_format($property->value_buy, 2) !!}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p>{!! limitHtmlString($property->description, 120) !!}</p>
                                                    <ul class="more-details clearfix">
                                                        <li><i class="icon-14"></i>{!! $property->bedroom !!}
                                                            {!! $property->bedroom == 1 ? 'Qto' : 'Qtos' !!}</li>
                                                        <li><i class="icon-15"></i>{!! $property->bathroom !!}
                                                            {!! $property->bedroom == 1 ? 'Bh' : 'Bhs' !!}</li>
                                                        <li><i class="icon-16"></i>{!! $property->area !!}²</li>
                                                    </ul>
                                                    <div class="btn-box"><a href="{!! route('detail', $property->id) !!}"
                                                            class="theme-btn btn-two">Mais detalhes</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <h3>Não existem imóveis cadastrados!</h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="buyProperties" role="tabpanel" aria-labelledby="buyPropertiesTab">
                        <div class="container my-2">
                            <div class="row">
                                @forelse ($allProperties->where('type_buy',1) as $property)
                                    @php
                                        $diretorio = public_path('storage/imovel/' . $property->id . '/');
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
                                                        'storage/imovel/' . $property->id . '/' . $arquivo,
                                                    );
                                                    break; // Interrompe o loop após encontrar a primeira imagem
                                                }
                                            }
                                        }
                                    @endphp

                                    <div class="col-4 my-4">
                                        <div class="feature-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><img src="{!! $primeiraImagem !!}"
                                                            style="max-height:200px">
                                                    </figure>
                                                    <div class="batch d-none"><i class="icon-11"></i></div>
                                                    <span class="category d-none">Featured</span>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="title-text pt-2">
                                                        <h4><a
                                                                href="property-details.html">{!! $property->title !!}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        @if ($property->type_rent)
                                                            <div class="price-info pull-left">
                                                                <h6>Aluguel</h6>
                                                                <h4>R$ {!! number_format($property->value_rent, 2) !!}</h4>
                                                            </div>
                                                        @endif

                                                        @if ($property->type_buy)
                                                            <div
                                                                class="price-info  pull-left @if ($property->type_rent) ml-5 @endif">
                                                                <h6>Venda</h6>
                                                                <h4>R$ {!! number_format($property->value_buy, 2) !!}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <p>{!! limitHtmlString($property->description, 120) !!}</p>
                                                    <ul class="more-details clearfix">
                                                        <li><i class="icon-14"></i>{!! $property->bedroom !!}
                                                            {!! $property->bedroom == 1 ? 'Qto' : 'Qtos' !!}</li>
                                                        <li><i class="icon-15"></i>{!! $property->bathroom !!}
                                                            {!! $property->bedroom == 1 ? 'Bh' : 'Bhs' !!}</li>
                                                        <li><i class="icon-16"></i>{!! $property->area !!}²</li>
                                                    </ul>
                                                    <div class="btn-box"><a href="{!! route('detail', $property->id) !!}"
                                                            class="theme-btn btn-two">Mais detalhes</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <h3>Não existem imóveis cadastrados!</h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-btn centred"><a href="{!! route('list') !!}" class="theme-btn btn-one">Ver todos</a>
        </div>
    </div>
</section>
<!-- feature-style-two end -->
