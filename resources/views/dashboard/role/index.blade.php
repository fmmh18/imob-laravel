@extends('layouts.vertical', ['title' => 'Usuários', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
@include('layouts.shared/page-title', ['sub_title' => 'Grupo de Usuários', 'page_title' =>  \Config::get('layout.titulo') ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                {!! Form::open(['method' => 'get', 'autocomplete' => false, 'route' => ['dashboard.role.index', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}
                <div class="row">
                    <div class="col-6">{!! Form::label('title', 'Título',['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-6">{!! Form::label('description', 'Descrição',['class' => 'col-form-label font-weight-bold']) !!}</div>
                </div>
                <div class="row">
                    <div class="col-6"> {!! Form::text('title',null, ['class' => 'form-control','placeholder' => 'Título'] ) !!}
                        @if (!empty($errors->first('title')))
                        <label class="invalid-feedback d-block">{!!$errors->first('title')!!}</label>
                        @endif
                    </div>
                    <div class="col-6"> {!! Form::text('description',null, ['class' => 'form-control','placeholder' => 'Descrição'] ) !!}
                        @if (!empty($errors->first('description')))
                        <label class="invalid-feedback d-block">{!!$errors->first('description')!!}</label>
                        @endif
                    </div>
                </div>
                <div class="col-12 text-end pt-3">
                    <a href="{!! route('dashboard.role.create') !!}" class="btn btn-success rounded-0">Adicionar</a>
                    <button type="submit" class="btn btn-primary rounded-0"> Pesquisar</button>
                    <a href="{!! route('dashboard.role.index') !!}" class="btn btn-secondary rounded-0">Limpar</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th><strong>#</strong></th>
                                    <th><strong>Título</strong></th>
                                    <th><strong>Descrição</strong></th>
                                    <th colspan="2" width="2%" class="text-center"><strong>Ações</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <td>{!! $item->id !!}</td>
                            <td>{!! $item->title !!}</td>
                            <td>{!! $item->description !!}</td>
                            <td><a href="{!! route('dashboard.role.show',$item->id) !!}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a href="{!! route('dashboard.role.delete',$item->id) !!}" class="btn btn-danger btn-delete" data-id="{!! $item->id !!}"><i class="bi bi-x-square"></i></a></td>
                        </tr>
                         @empty
                        <tr>
                            <td colspan="5" class="text-center"><strong>Não possui registro</strong></td>
                        </tr>
                        @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>


@endsection

@section('script')
@vite(['resources/js/pages/form-advanced.init.js'])
@vite(['resources/js/components/all/delete.js'])
@endsection
