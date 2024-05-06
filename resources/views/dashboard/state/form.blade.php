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
                        'route' => ['dashboard.state.update', $data->id, http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @else
                    {!! Form::open([
                        'method' => 'post',
                        'autocomplete' => false,
                        'route' => ['dashboard.state.create', http_build_query(Request::input())],
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
                    <div class="col-12">{!! Form::label('initials', 'Sigla', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('initials', null, ['class' => 'form-control', 'placeholder' => 'Sigla']) !!}
                        @if (!empty($errors->first('initials')))
                            <label class="invalid-feedback d-block">{!! $errors->first('initials') !!}</label>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-end pt-3">
                        <a href="{!! route('dashboard.state.index') !!}" class="btn btn-secondary rounded-0">Voltar</a>
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
