@forelse ($carousels as $carousel)
    <section class="banner-style-two centred">
        <div class="banner-carousel owl-theme owl-carousel owl-nav-none">
            <div class="slide-item">
                <div class="image-layer" style="background-image:url({!! asset($carousel->image) ?? 'assets/carousel/img-1.webp' !!})"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>{!! $carousel->title ?? 'Pesquisar Imóveis para Venda e/ou Aluguel' !!}</h2>
                        <p>{!! $carousel->subtitle ?? 'Pesquisar Imóveis para Venda e/ou Aluguel' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@empty
    <!-- banner-style-two -->
    <section class="banner-style-two centred">
        <div class="banner-carousel owl-theme owl-carousel owl-nav-none">
            <div class="slide-item">
                <div class="image-layer" style="background-image:url(assets/carousel/img-1.webp)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Pesquisar Imóveis para Venda e/ou Aluguel</h2>
                        <p>Amet consectetur adipisicing elit sed do eiusmod.</p>
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image-layer" style="background-image:url(assets/carousel/img-2.webp)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Pesquisar Imóveis para Venda e/ou Aluguel</h2>
                        <p>Amet consectetur adipisicing elit sed do eiusmod.</p>
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image-layer" style="background-image:url(assets/carousel/img-3.webp)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Pesquisar Imóveis para Venda e/ou Aluguel</h2>
                        <p>Amet consectetur adipisicing elit sed do eiusmod.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-style-two end -->
@endforelse
