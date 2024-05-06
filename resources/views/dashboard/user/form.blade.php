@extends('layouts.vertical', ['title' => 'Usuários', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', [
        'sub_title' => 'Usuário',
        'page_title' => \Config::get('layout.titulo'),
    ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                    {!! Form::model($data, [
                        'method' => 'put',
                        'autocomplete' => false,
                        'route' => ['dashboard.user.update', $data->id, http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @else
                    {!! Form::open([
                        'method' => 'post',
                        'autocomplete' => false,
                        'route' => ['dashboard.user.create', http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @endif
                <div class="row">
                    <div class="col-12">{!! Form::label('name', 'Nome', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
                        @if (!empty($errors->first('name')))
                            <label class="invalid-feedback d-block">{!! $errors->first('name') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('cpf', 'CPF', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('cpf', null, [
                        'class' => 'form-control',
                        'placeholder' => 'CPF',
                        'data-reverse' => 'true',
                        'data-toggle' => 'input-mask',
                        'data-mask-format' => '000.000.000-00',
                    ]) !!}
                        @if (!empty($errors->first('cpf')))
                            <label class="invalid-feedback d-block">{!! $errors->first('cpf') !!}</label>
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
                    <div class="col-12">{!! Form::label('password', 'Senha', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Senha']) !!}
                        @if (!empty($errors->first('password')))
                            <label class="invalid-feedback d-block">{!! $errors->first('password') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('is_manager', 'Status', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">{!! Form::select('status', $allStatus, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Selecione uma opção',
                    ]) !!}
                        @if (!empty($errors->first('status')))
                            <label class="invalid-feedback d-block">{!! $errors->first('status') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('is_manager', 'Administrador', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">{!! Form::select('is_manager', $allStatus, null, [
                        'class' => 'form-control is_manager',
                        'placeholder' => 'Selecione uma opção',
                    ]) !!}
                        @if (!empty($errors->first('is_manager')))
                            <label class="invalid-feedback d-block">{!! $errors->first('is_manager') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end pt-3">
                        <a href="{!! route('dashboard.user.index') !!}" class="btn btn-secondary rounded-0">Voltar</a>
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

    @if (isset($data) && $data->is_manager != 1)
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var hiddenDivCompany = document.querySelector(".company");
                hiddenDivCompany.classList.remove('d-none')
            });
        </script>
    @endif
@endsection
