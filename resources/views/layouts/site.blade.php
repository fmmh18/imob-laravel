<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fav Icon -->
    <link rel="icon" href="{!! asset('site/assets/images/favicon.ico') !!}" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{!! asset('site/assets/css/font-awesome-all.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/flaticon.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/owl.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/bootstrap.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/jquery.fancybox.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/jquery-ui.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/nice-select.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/color/theme-color.css') !!}" id="jssDefault" rel="stylesheet">
    <link href="{!! asset('site/assets/css/switcher-style.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/style.css') !!}" rel="stylesheet">
    <link href="{!! asset('site/assets/css/responsive.css') !!}" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>

    <!-- switcher menu -->
    <div class="switcher d-none">
        <div class="switch_btn">
            <button><i class="fas fa-palette"></i></button>
        </div>
        <div class="switch_menu">
            <!-- color changer -->
            <div class="switcher_container">
                <ul id="styleOptions" title="switch styling">
                    <li>
                        <a href="javascript: void(0)" data-theme="green" class="green-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="pink" class="pink-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="violet" class="violet-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="crimson" class="crimson-color"></a>
                    </li>
                    <li>
                        <a href="javascript: void(0)" data-theme="orange" class="orange-color"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end switcher menu -->
    <!-- main header -->
    <header class="main-header header-style-two">
        <!-- header-lower -->
        <div class="header-lower">
            <div class="outer-box">
                <div class="main-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="/"><img src="{!! asset('assets/logo/logo_white.png') !!}" alt=""
                                    style="width: 65%"></a></figure>
                    </div>
                    <div class="menu-area clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li><a href="{!! route('index') !!}"><span>Home</span></a></li>
                                    <li><a href="{!! route('about') !!}"><span>Quem Somos</span></a></li>
                                    <li><a href="{!! route('list') !!}"><span>Imóveis</span></a></li>
                                    <li><a href="{!! route('contact') !!}">Contato</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="outer-box">
                <div class="main-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="/"><img src="{!! asset('assets/logo/logo_dark.png') !!}" alt=""
                                    style="width: 65%"></a></figure>
                    </div>
                    <div class="menu-area clearfix">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="{!! route('index') !!}"><img
                        src="{{ asset('assets/logo/logo_white.png') }}" alt=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <div class="contact-info">
                <h4>Contato</h4>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i>{!! $config->address ??
                        'Flat 20, Reynolds Neck, North Helenaville,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        FV77 8WS' !!}</li>
                    <li><i class="fas fa-microphone"></i><a
                            href="tel:{!! sanitizeString($config->phone) ?? '6598765-4321' !!}">{!! $config->phone ?? '(65) 98765-4321' !!}</a></li>
                    <li><i class="fas fa-envelope"></i><a
                            href="mailto:{!! $config->email ?? 'contato@villagenegociosimobiliario.com.br' !!}">{!! $config->email ?? 'contato@villagenegociosimobiliario.com.br' !!}</a>
                    </li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->
    <main>
        @yield('content')
    </main>

    <!-- main-footer -->
    <footer class="main-footer">
        <div class="footer-top bg-color-2">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget about-widget">
                            <div class="widget-title">
                                <h3>Sobre</h3>
                            </div>
                            <div class="text">
                                {!! $config->about ?? 'Conte sobre a empresa' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget ml-70">
                            <div class="widget-title">
                                <h3>Serviços</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list class">
                                    <li><a href="{!! route('index') !!}"><span>Home</span></a></li>
                                    <li><a href="{!! route('about') !!}">Quem Somos</a></li>
                                    <li><a href="{!! route('list') !!}">Imóveis</a></li>
                                    <li><a href="{!! route('contact') !!}">Contato</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget contact-widget">
                            <div class="widget-title">
                                <h3>Contatos</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i>{!! $config->address ??
                                        'Flat 20, Reynolds Neck, North Helenaville,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            FV77 8WS' !!}</li>
                                    <li><i class="fas fa-microphone"></i><a
                                            href="tel:{!! sanitizeString($config->phone) ?? '6598765-4321' !!}">{!! $config->phone ?? '(65) 98765-4321' !!}</a></li>
                                    <li><i class="fas fa-envelope"></i><a
                                            href="mailto:{!! $config->email ?? 'contato@villagenegociosimobiliario.com.br' !!}">{!! $config->email ?? 'contato@villagenegociosimobiliario.com.br' !!}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="inner-box clearfix">
                    <figure class="footer-logo d-none"><a href="{!! route('index') !!}"><img
                                src="{{ asset('assets/logo/logo_white.png') }}" alt=""></a></figure>
                    <div class="copyright pull-left">
                        <p><a href="/">{!! $config->title ?? 'Village Negócios Imobiliário' !!}</a> &copy; {!! date('Y') !!} All Right
                            Reserved</p>
                    </div>
                    <ul class="footer-nav pull-right clearfix">
                        <li><a href="/">Termo de Serviço</a></li>
                        <li><a href="/">Política de Privacidade</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->

    <div class="floating-buttons">
        <a href="https://api.whatsapp.com/send?phone=+55{!! sanitizeString($config->phone) ?? '65987654321' !!}" target="_blank"
            class="whatsapp-btn">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="#" class="contact-btn" data-toggle="modal" data-toggle="tooltip" title="Ligamos para você"
            data-target="#contactModal">
            <i class="fas fa-phone"></i>
        </a>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Ligamos para você</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => route('lead-store'), 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Nome') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Digite seu nome', 'required']) !!}
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Digite seu email', 'required']) !!}
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone', 'Telefone') !!}
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Digite seu Telefone', 'required']) !!}
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            {!! Form::checkbox('whatsapp', '1', false, ['class' => 'form-check-input', 'id' => 'whatsapp']) !!}
                            {!! Form::label('whatsapp', 'Esse número é WhatsApp?', ['class' => 'form-check-label']) !!}
                        </div>
                    </div>
                    <div class="g-recaptcha py-2" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                    {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!--Scroll to top-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fal fa-angle-up"></span>
    </button>
    <!-- jequery plugins -->
    <script src="{!! asset('site/assets/js/jquery.js') !!}"></script>
    <script src="{!! asset('site/assets/js/popper.min.js') !!}"></script>
    <script src="{!! asset('site/assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('site/assets/js/owl.js') !!}"></script>
    <script src="{!! asset('site/assets/js/wow.js') !!}"></script>
    <script src="{!! asset('site/assets/js/validation.js') !!}"></script>
    <script src="{!! asset('site/assets/js/jquery.fancybox.js') !!}"></script>
    <script src="{!! asset('site/assets/js/appear.js') !!}"></script>
    <script src="{!! asset('site/assets/js/scrollbar.js') !!}"></script>
    <script src="{!! asset('site/assets/js/isotope.js') !!}"></script>
    <script src="{!! asset('site/assets/js/jquery.nice-select.min.js') !!}"></script>
    <script src="{!! asset('site/assets/js/jQuery.style.switcher.min.js') !!}"></script>
    <script src="{!! asset('site/assets/js/jquery-ui.js') !!}"></script>
    <script src="{!! asset('site/assets/js/jquery.paroller.min.js') !!}"></script>
    <script src="{!! asset('site/assets/js/product-filter.js') !!}"></script>
    <script src="{!! asset('site/assets/js/nav-tool.js') !!}"></script>

    <!-- main-js -->
    <script src="{!! asset('site/assets/js/script.js') !!}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('openModal') === true)
        <script>
            $(document).ready(function() {
                $('#contactModal').modal('show');
            });
        </script>
    @endif
</body>

</html>
