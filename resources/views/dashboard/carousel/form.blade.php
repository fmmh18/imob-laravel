@extends('layouts.vertical', ['title' => 'Imagem', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', [
        'sub_title' => 'Imagem',
        'page_title' => \Config::get('layout.titulo'),
    ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                    {!! Form::model($data, [
                        'method' => 'put',
                        'autocomplete' => false,
                        'route' => ['dashboard.carousel.update', $data->id, http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @else
                    {!! Form::open([
                        'method' => 'post',
                        'autocomplete' => false,
                        'route' => ['dashboard.carousel.create', http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @endif
                <div class="row">
                    <div class="col-12">{!! Form::label('title', 'Título', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Título']) !!}
                        @if (!empty($errors->first('title')))
                            <label class="invalid-feedback d-block">{!! $errors->first('title') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('subtitle', 'Sub Título', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => 'Sub Título']) !!}
                        @if (!empty($errors->first('subtitle')))
                            <label class="invalid-feedback d-block">{!! $errors->first('subtitle') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('active', 'Status', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">{!! Form::select('active', $allStatus, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Selecione uma opção',
                    ]) !!}
                        @if (!empty($errors->first('active')))
                            <label class="invalid-feedback d-block">{!! $errors->first('active') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="col-12">{!! Form::label('images', 'Imagem', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                <div class="col-12">
                    <div class="input-group">
                        <input type="file" class="form-control" name="images" id="customFile">
                    </div>
                    @if (!empty($errors->first('images')))
                        <label class="invalid-feedback d-block">{!! $errors->first('images') !!}</label>
                    @endif
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
