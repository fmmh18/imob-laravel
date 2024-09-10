@extends('layouts.vertical', ['title' => 'Usuários', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', [
        'sub_title' => 'Grupo de Usuários',
        'page_title' => \Config::get('layout.titulo'),
    ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                {!! Form::open([
                    'method' => 'get',
                    'autocomplete' => false,
                    'route' => ['dashboard.contact.index', [$type, http_build_query(Request::input())]],
                    'class' => $errors->any() ? 'was-validated' : '',
                    'novalidate',
                    'files' => true,
                ]) !!}
                <div class="row">
                    <div class="col-12">{!! Form::label('name', 'Nome', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                </div>
                <div class="row">
                    <div class="col-12"> {!! Form::text('Nome', null, ['class' => 'form-control', 'placeholder' => 'Título']) !!}
                        @if (!empty($errors->first('Nome')))
                            <label class="invalid-feedback d-block">{!! $errors->first('Nome') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="col-12 text-end pt-3">
                    <button type="submit" class="btn btn-primary rounded-0"> Pesquisar</button>
                    <a href="{!! route('dashboard.contact.index', $type) !!}" class="btn btn-secondary rounded-0">Limpar</a>
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
                                <th><strong>Nome</strong></th>
                                <th><strong>E-mail</strong></th>
                                <th><strong>Telefone</strong></th>
                                @if ($type == 'lead')
                                    <th><strong>Deseja receber contato pelo whatsapp</strong></th>
                                    <th><strong>Feito Contato</strong></th>
                                @endif
                                <th colspan="2" width="2%" class="text-center"><strong>Ações</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>{!! $item->id !!}</td>
                                    <td>{!! $item->name !!}</td>
                                    <td>{!! $item->email !!}</td>
                                    <td>{!! $item->phone !!}</td>
                                    @if ($type == 'lead')
                                        <td>{!! $item->whatsapp == 1 ? 'Sim' : 'Não' !!}</td>
                                        <td>{!! $item->return == 1 ? 'Sim' : 'Não' !!}</td>
                                    @endif
                                    <td><a href="{!! route('dashboard.contact.show', [$type, $item->id]) !!}" class="btn btn-warning"><i
                                                class="bi bi-pencil-square"></i></a></td>
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
