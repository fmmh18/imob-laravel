@extends('layouts.vertical', ['title' => 'Grupo de Usuários', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
@include('layouts.shared/page-title', ['sub_title' => 'Grupo de Usuário', 'page_title' =>  \Config::get('layout.titulo')   ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                {!! Form::model($data, ['method' => 'put', 'autocomplete' => false, 'route' => ['dashboard.role.update', $data->id, http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}
                @else
                {!! Form::open(['method' => 'post', 'autocomplete' => false, 'route' => ['dashboard.role.create', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}
                @endif
                <div class="row">
                    <div class="col-12">{!! Form::label('title', 'Título',['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('title',null, ['class' => 'form-control','placeholder' => 'Título'] ) !!}
                        @if (!empty($errors->first('title')))
                        <label class="invalid-feedback d-block">{!!$errors->first('title')!!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('description', 'Descrição',['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('description',null, ['class' => 'form-control', 'placeholder' => 'Descrição'] ) !!}
                        @if (!empty($errors->first('description')))
                        <label class="invalid-feedback d-block">{!!$errors->first('description')!!}</label>
                        @endif
                    </div>
                </div>
                <div class="row form-group py-4">
                    @foreach ($groups as $item)
                        <div class="col-12 py-2"><strong><h3>{!! $item->group !!}</h3></strong></div>

                    @foreach ($allPermissions as $key => $value)
                        @if($item->group == $value->group)
                            <div class="col-6 col-sm-4 pb-3">
                                <div class="custom-control custom-checkbox custom-checkbox-primary">
                                {!!Form::checkbox('permission[]', $key, isset($data) ? in_array($value->id, $data->permissions->pluck("id")->toArray()) : false, [ "class" => "custom-control-input", "id" => "permission-".$value->id])!!}
                                {!!Form::label("permission-".$value->id, $value->description,["class"=> 'custom-control-label'])!!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @endforeach
                </div>
               <div class="row">
                <div class="col-12 text-end pt-3">
                <a href="{!! route('dashboard.company.index') !!}" class="btn btn-secondary rounded-0">Voltar</a>
                <button type="submit" class="btn btn-primary rounded-0"> Salvar</button>
            </div></div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>


@endsection

@section('script')

@vite(['resources/js/pages/form-advanced.init.js'])
@endsection
