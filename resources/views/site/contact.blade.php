@extends('layouts.site')

@section('content')
    <!--Page Title-->
    <section class="page-title centred" style="background-image: url(assets/images/background/page-title-3.jpg);">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Fale Conosco</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Fale Conosco</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- about-section -->
    <section class="about-section about-page pb-0">
        <div class="auto-container">
            <div class="inner-container">
                <div class="row align-items-center clearfix">

                    <div class="col-12 content-column">
                        <div class="content_block_3">
                            <div class="content-box">
                                {!! Form::open(['url' => route('contact-store'), 'method' => 'post']) !!}
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
                                    {!! Form::label('subject', 'Telefone') !!}
                                    {!! Form::select(
                                        'subject',
                                        [
                                            'Dúvida' => 'Dúvida',
                                            'Elogio' => 'Elogio',
                                            'Sugestão' => 'Sugestão',
                                            'Reclamação' => 'Reclamação',
                                            'Outros' => 'Outros',
                                        ],
                                        ['class' => 'form-control', 'placeholder' => 'Assunto', 'required'],
                                    ) !!}
                                    @if ($errors->has('subject'))
                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {!! Form::label('message', 'Mensagem') !!}
                                    {!! Form::textarea('message', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Digite seu Mensagem',
                                        'required',
                                    ]) !!}
                                    @if ($errors->has('message'))
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    @endif
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
            </div>
        </div>
    </section>
    <!-- about-section end -->
@endsection
