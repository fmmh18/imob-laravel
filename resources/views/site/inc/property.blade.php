<!-- feature-style-two -->
<section class="feature-style-two sec-pad">
    <div class="auto-container">
        <div class="sec-title">
            <h5>Imóveis</h5>
            <h2>Venda e Aluguel</h2>
        </div>
        <div class="row">
            @forelse ($allProperties as $property)
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
                                $primeiraImagem = asset('storage/imovel/' . $property->id . '/' . $arquivo);
                                break; // Interrompe o loop após encontrar a primeira imagem
                            }
                        }
                    }
                @endphp

                <div class="col-4">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{!! $primeiraImagem !!}" alt="">
                                </figure>
                                <div class="batch d-none"><i class="icon-11"></i></div>
                                <span class="category d-none">Featured</span>
                            </div>
                            <div class="lower-content">
                                <div class="title-text pt-2">
                                    <h4><a href="property-details.html">{!! $property->title !!}</a></h4>
                                </div>
                                <div class="price-box clearfix">
                                    @if ($property->type_rent)
                                        <div class="price-info pull-left">
                                            <h6>Aluguel</h6>
                                            <h4>R$ {!! number_format($property->value_rent, 2) !!}</h4>
                                        </div>
                                    @endif

                                    @if ($property->type_buy)
                                        <div class="price-info  pull-left ml-5">
                                            <h6>Venda</h6>
                                            <h4>R$ {!! number_format($property->value_buy, 2) !!}</h4>
                                        </div>
                                    @endif
                                </div>
                                <p>{!! $property->description !!}</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>{!! $property->bedroom !!} {!! $property->bedroom == 1 ? 'Qto' : 'Qtos' !!}</li>
                                    <li><i class="icon-15"></i>{!! $property->bathroom !!} {!! $property->bedroom == 1 ? 'Bh' : 'Bhs' !!}</li>
                                    <li><i class="icon-16"></i>{!! $property->area !!} m²</li>
                                </ul>
                                <div class="btn-box"><a href="{!! route('detail', $property->id) !!}" class="theme-btn btn-two">Mais
                                        detalhes</a></div>
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
        <div class="more-btn centred"><a href="{!! route('list') !!}" class="theme-btn btn-one">Ver todos</a>
        </div>
    </div>
</section>
<!-- feature-style-two end -->
