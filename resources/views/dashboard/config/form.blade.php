@extends('layouts.vertical', ['title' => 'Usuários', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', [
        'sub_title' => 'Configuração do site',
        'page_title' => \Config::get('layout.titulo'),
    ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                    {!! Form::model($data, [
                        'method' => 'post',
                        'autocomplete' => false,
                        'route' => ['dashboard.config.store', http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @else
                    {!! Form::open([
                        'method' => 'post',
                        'autocomplete' => false,
                        'route' => ['dashboard.config.store', http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @endif
                <div class="row">
                    <div class="col-12">{!! Form::label('title', 'Nome do Site', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Nome do Site']) !!}
                        @if (!empty($errors->first('title')))
                            <label class="invalid-feedback d-block">{!! $errors->first('title') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('address', 'Endereço', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Endereço']) !!}
                        @if (!empty($errors->first('address')))
                            <label class="invalid-feedback d-block">{!! $errors->first('address') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('phone', 'Telefone', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Telefone']) !!}
                        @if (!empty($errors->first('phone')))
                            <label class="invalid-feedback d-block">{!! $errors->first('phone') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('email', 'E-mail', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                        @if (!empty($errors->first('email')))
                            <label class="invalid-feedback d-block">{!! $errors->first('email') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('whatsapp', 'Whatsapp', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('whatsapp', null, ['class' => 'form-control', 'placeholder' => 'Whatsapp']) !!}
                        @if (!empty($errors->first('whatsapp')))
                            <label class="invalid-feedback d-block">{!! $errors->first('whatsapp') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('facebook', 'Facebook', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => 'Facebook']) !!}
                        @if (!empty($errors->first('facebook')))
                            <label class="invalid-feedback d-block">{!! $errors->first('facebook') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('instagram', 'Instagram', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('instagram', null, ['class' => 'form-control', 'placeholder' => 'Instagram']) !!}
                        @if (!empty($errors->first('instagram')))
                            <label class="invalid-feedback d-block">{!! $errors->first('instagram') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('lg_white', 'Logo', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">
                        <div class="input-group">
                            <input type="file" class="form-control" name="lg_white" id="customFile">
                        </div>
                        @if (!empty($errors->first('lg_white')))
                            <label class="invalid-feedback d-block">{!! $errors->first('lg_white') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('lg_white_sm', 'Logo Pequena', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">
                        <div class="input-group">
                            <input type="file" class="form-control" name="lg_white_sm" id="customFile">
                        </div>
                        @if (!empty($errors->first('lg_white_sm')))
                            <label class="invalid-feedback d-block">{!! $errors->first('lg_white_sm') !!}</label>
                        @endif
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">{!! Form::label('lg_dark', 'Logo Escura', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">
                        <div class="input-group">
                            <input type="file" class="form-control" name="lg_dark" id="customFile">
                        </div>
                        @if (!empty($errors->first('lg_dark')))
                            <label class="invalid-feedback d-block">{!! $errors->first('lg_dark') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('lg_dark_sm', 'Logo Pequena Escura', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">
                        <div class="input-group">
                            <input type="file" class="form-control" name="lg_dark_sm" id="customFile">
                        </div>
                        @if (!empty($errors->first('lg_dark_sm')))
                            <label class="invalid-feedback d-block">{!! $errors->first('lg_dark_sm') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('about', 'Sobre', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::textarea('about', null, ['class' => 'form-control', 'placeholder' => 'Sobre']) !!}
                        @if (!empty($errors->first('about')))
                            <label class="invalid-feedback d-block">{!! $errors->first('about') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end pt-3">
                        <a href="{!! route('dashboard.feature.index') !!}" class="btn btn-secondary rounded-0">Voltar</a>
                        <button type="submit" class="btn btn-primary rounded-0"> Salvar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/form-advanced.init.js'])
@endsection
