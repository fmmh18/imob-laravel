@extends('layouts.vertical', ['title' => 'Conta bancária', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])
@section('css')
    @vite(['node_modules/select2/dist/css/select2.min.css', 'node_modules/daterangepicker/daterangepicker.css', 'node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css', 'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css', 'node_modules/flatpickr/dist/flatpickr.min.css'])
@endsection
@section('content')
@include('layouts.shared/page-title', ['sub_title' => 'Conta bancária', 'page_title' =>  \Config::get('layout.titulo')   ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                {!! Form::model($data, ['method' => 'put', 'autocomplete' => false, 'route' => ['dashboard.cost-center.update', $data->id, http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}
                @else
                {!! Form::open(['method' => 'post', 'autocomplete' => false, 'route' => ['dashboard.account-bank.create', http_build_query(Request::input())], 'class' => $errors->any() ? 'was-validated' : '', 'novalidate', "files" => true]) !!}
                @endif
                <div class="row">
                   <div class="col">
                        <div class="col-12">{!! Form::label('bank_id', 'Banco',['class' => 'col-form-label font-weight-bold']) !!}</div>
                        <div class="col-12">
                            {!! Form::select('bank_id', $allBanks, null, [  'class' => 'form-control select2', 'data-toggle' => 'select2' ,'placeholder' => 'Selecione uma opção']) !!}
                            @if (!empty($errors->first('bank_id')))
                            <label class="invalid-feedback d-block">{!!$errors->first('bank_id')!!}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="col-12">{!! Form::label('agency', 'Agencia da Conta',['class' => 'col-form-label font-weight-bold']) !!}</div>
                        <div class="col-12"> {!! Form::text('agency',null, ['class' => 'form-control','placeholder' => 'Agência da Conta'] ) !!}
                            @if (!empty($errors->first('agency')))
                            <label class="invalid-feedback d-block">{!!$errors->first('agency')!!}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="col-12">{!! Form::label('account', 'Número da Conta',['class' => 'col-form-label font-weight-bold']) !!}</div>
                        <div class="col-12"> {!! Form::text('account',null, ['class' => 'form-control','placeholder' => 'Número da Conta'] ) !!}
                            @if (!empty($errors->first('account')))
                            <label class="invalid-feedback d-block">{!!$errors->first('account')!!}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="col-12">{!! Form::label('type_account', 'Tipo de conta',['class' => 'col-form-label font-weight-bold']) !!}</div>
                        <div class="col-12">
                            {!! Form::select('type_account', ['1' => 'Pessoa Física','2' => 'Pessoa Jurídica'], null, [  'class' => 'form-control select2', 'data-toggle' => 'select2' ,'placeholder' => 'Selecione uma opção']) !!}
                            @if (!empty($errors->first('type_account')))
                            <label class="invalid-feedback d-block">{!!$errors->first('type_account')!!}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="col-12">{!! Form::label('balance_initial', 'Saldo inicial',['class' => 'col-form-label font-weight-bold']) !!}</div>
                        <div class="col-12"> {!! Form::text('balance_initial',null, ['class' => 'form-control', 'required','placeholder' => 'Saldo inicial', "data-toggle" => "input-mask", "data-mask-format" => "#.##0,00",'required' , "data-reverse" => "true"] ) !!}
                            @if (!empty($errors->first('balance_initial')))
                            <label class="invalid-feedback d-block">{!!$errors->first('balance_initial')!!}</label>
                            @endif
                        </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col-12 text-end pt-3">
                        <a href="{!! route('dashboard.account-bank.index') !!}" class="btn btn-secondary rounded-0">Voltar</a>
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
