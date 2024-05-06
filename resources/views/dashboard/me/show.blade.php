@extends('layouts.vertical', ['title' => 'Meus dados', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
@include('layouts.shared/page-title', ['sub_title' => 'Meus dados', 'page_title' => Auth::user()->name])

    <div class="row">
        {!! Form::open(['method' => 'put', 'autocomplete' => false, 'route' => ['dashboard.update-me', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">{!! Form::label('name', 'Nome',['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('name',Auth::user()->name, ['class' => 'form-control','placeholder' => 'Nome'] ) !!}
                        @if (!empty($errors->first('name')))
                        <label class="invalid-feedback d-block">{!!$errors->first('name')!!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('email', 'E-mail',['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('email',Auth::user()->email, ['class' => 'form-control','placeholder' => 'E-mail','disabled'] ) !!}
                        @if (!empty($errors->first('email')))
                        <label class="invalid-feedback d-block">{!!$errors->first('email')!!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('password', 'Senha',['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::password('password', ['class' => 'form-control','placeholder' => 'Senha'] ) !!}
                        @if (!empty($errors->first('password')))
                        <label class="invalid-feedback d-block">{!!$errors->first('password')!!}</label>
                        @endif
                    </div>
                </div>

                <div class="col-12">{!! Form::label('images', 'Foto',['class' => 'col-form-label font-weight-bold']) !!}</div>
                <div class="col-12">
               <div class="input-group">
                    <input type="file" class="form-control" name="images" id="customFile">
                </div>
                    @if (!empty($errors->first('images')))
                    <label class="invalid-feedback d-block">{!!$errors->first('images')!!}</label>
                    @endif
                </div>
                <div class="col-12 text-end pt-3">
                    <button type="submit" class="btn btn-primary btn-color rounded-0"> Salvar</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>


@endsection

@section('script')
@vite(['resources/js/pages/form-advanced.init.js'])
@endsection
