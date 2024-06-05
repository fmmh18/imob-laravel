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

</head>

<body>

    <!-- switcher menu -->
    <div class="switcher">
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
                        <figure class="logo"><a href="index.html"><img src="{!! asset('assets/logo/logo_white.png') !!}"
                                    alt=""></a></figure>
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
                                    <li><a href="{!! route('index') !!}"><span>Cadastro</span></a></li>
                                    <li class="d-none"><a href="contact.html"><span>Contato</span></a></li>
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
                        <figure class="logo"><a href="index.html"><img src="{!! asset('assets/logo/logo_white.png') !!}"
                                    alt=""></a></figure>
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
            <div class="nav-logo"><a href="index.html"><img src="{!! asset('assets/logo/logo_dark.png') !!}" alt=""
                        title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>Chicago 12, Melborne City, USA</li>
                    <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                    <li><a href="mailto:info@example.com">info@example.com</a></li>
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
                                <p>Lorem ipsum dolor amet consetetur adi pisicing elit sed eiusm tempor in cididunt ut
                                    labore dolore magna aliqua enim ad minim venitam</p>
                                <p>Quis nostrud exercita laboris nisi ut aliquip commodo.</p>
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
                                    <li><a href="index.html">Sobre</a></li>
                                    <li><a href="index.html">Imóveis</a></li>
                                    <li><a href="index.html">Contato</a></li>
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
                                    <li><i class="fas fa-map-marker-alt"></i>Flat 20, Reynolds Neck, North Helenaville,
                                        FV77 8WS</li>
                                    <li><i class="fas fa-microphone"></i><a href="tel:23055873407">+2(305)
                                            587-3407</a></li>
                                    <li><i class="fas fa-envelope"></i><a
                                            href="mailto:info@example.com">info@example.com</a></li>
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
                    <figure class="footer-logo"><a href="{!! route('index') !!}"><img
                                src="{{ asset('assets/logo/logo_white.png') }}" alt=""></a></figure>
                    <div class="copyright pull-left">
                        <p><a href="index.html">Realshed</a> &copy; 2021 All Right Reserved</p>
                    </div>
                    <ul class="footer-nav pull-right clearfix">
                        <li><a href="index.html">Termo de Serviço</a></li>
                        <li><a href="index.html">Política de Privacidade</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->



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
    </script>
</body>

</html>
