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
                        'method' => 'put',
                        'autocomplete' => false,
                        'route' => ['dashboard.config.store', $data->id, http_build_query(Request::input())],
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
                    <div class="col-12">{!! Form::label('name', 'Nome do Site', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome do Site']) !!}
                        @if (!empty($errors->first('name')))
                            <label class="invalid-feedback d-block">{!! $errors->first('name') !!}</label>
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
