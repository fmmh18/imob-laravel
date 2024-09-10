<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard.home') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="/assets/logo/logo_vision.webp" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard.home') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="/images/logo.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('dashboard.home') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarContentFinancial" aria-expanded="false"
                    aria-controls="sidebarContentFinancial" class="side-nav-link">
                    <i class="ri-bank-line"></i>
                    <span> Conteudo </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarContentFinancial">
                    <ul class="side-nav-second-level">
                        {{-- <li>
                            <a href="#">Dashboard</a>
                        </li> --}}
                        <li>
                            <a href="{!! route('dashboard.page.show', 'quem-somos') !!}">Quem Somos</a>
                        </li>
                        <li>
                            <a href="{!! route('dashboard.contact.index', 'lead') !!}">Leads</a>
                        </li>
                        <li>
                            <a href="{!! route('dashboard.contact.index', 'contato') !!}">Fale Conosco</a>
                        </li>
                        <li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPagesFinancial" aria-expanded="false"
                    aria-controls="sidebarPagesFinancial" class="side-nav-link">
                    <i class="ri-bank-line"></i>
                    <span> Gestão Imobiliária </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPagesFinancial">
                    <ul class="side-nav-second-level">
                        {{-- <li>
                            <a href="#">Dashboard</a>
                        </li> --}}
                        <li>
                            <a href="{!! route('dashboard.property.index') !!}">Imóveis</a>
                        </li>
                        <li>
                            <a href="{!! route('dashboard.type.index') !!}">Tipo de Imóvel</a>
                        </li>
                        <li>
                            <a href="{!! route('dashboard.feature.index') !!}">Características do Imóvel</a>
                        </li>
                    </ul>
                </div>
            </li>



            @if (Auth::user()->is_manager == 1 || Auth::user()->role_id == 2)
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                        class="side-nav-link">
                        <i class="ri-tools-line"></i>
                        <span> Configuração </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPages">
                        <ul class="side-nav-second-level">

                            <li>
                                <a href="{!! route('dashboard.carousel.index') !!}"
                                    @if (Auth::user()->is_manager != 1) class="d-none" @endif>Carousel</a>
                            </li>
                            <li>
                                <a href="{!! route('dashboard.config.show') !!}"
                                    @if (Auth::user()->is_manager != 1) class="d-none" @endif>Configurações do site</a>
                            </li>
                            <li>
                                <a href="{!! route('dashboard.user.index') !!}"
                                    @if (Auth::user()->is_manager != 1) class="d-none" @endif>Usuário</a>
                            </li>

                            <li>
                                <a href="{!! route('dashboard.state.index') !!}"
                                    @if (Auth::user()->is_manager != 1) class="d-none" @endif>Estado</a>
                            </li>

                            <li>
                                <a href="{!! route('dashboard.city.index') !!}"
                                    @if (Auth::user()->is_manager != 1) class="d-none" @endif>Cidade</a>
                            </li>

                            {{-- <li>
                                <a href="{!! route('dashboard.role.index') !!}"
                                    @if (Auth::user()->is_manager != 1 && Auth::user()->role_id != 1) class="d-none" @endif>Grupo de Usuário</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
            @endif


        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->
