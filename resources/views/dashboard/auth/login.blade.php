<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Acessar'])

    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            {{--  <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div> --}}
                            <div class="col-12">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand pt-4">
                                        <a href="#" class="logo-light">
                                            <img src="/assets/logo/logo_dark.png" alt="logo">
                                        </a>
                                        <a href="#" class="logo-dark text-center">
                                            <img src="/assets/logo/logo_dark.png" alt="logo" width="240"
                                                height="100">
                                        </a>
                                    </div>
                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Acesso</h4>
                                        <p class="text-muted mb-3">Entre com e-mail e sua senha
                                        </p>

                                        <!-- form -->
                                        {!! Form::open([
                                            'method' => 'post',
                                            'autocomplete' => 'off',
                                            'route' => ['auth', http_build_query(Request::input())],
                                            'class' => $errors->any() ? 'was-validated' : '',
                                            'novalidate form-horizontal mt-3',
                                        ]) !!}
                                        @if (sizeof($errors) > 0)
                                            @foreach ($errors->all() as $error)
                                                <p class="text-danger">{{ $error }}</p>
                                            @endforeach
                                        @endif

                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">Email</label>
                                            <input class="form-control" type="email" name="email" id="emailaddress"
                                                placeholder="Enter your email" value="test@test.com">
                                        </div>
                                        <div class="mb-3">
                                            <a href="auth-forgotpw.html" class="text-muted float-end"><small>Esqueci
                                                    minha senha?</small></a>
                                            <label for="password" class="form-label">Senha</label>
                                            <input class="form-control" type="password" name="password" id="password"
                                                placeholder="Enter your password" value="password">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                <label class="form-check-label" for="checkbox-signin">Lembrar</label>
                                            </div>
                                        </div>
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit"><i
                                                    class="ri-login-circle-fill me-1"></i> <span
                                                    class="fw-bold">Acessar</span> </button>
                                        </div>
                                        {!! Form::close() !!}
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> - © Gestor Imobiliário
        </span>
    </footer>

    @include('layouts.shared/footer-scripts')

    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
