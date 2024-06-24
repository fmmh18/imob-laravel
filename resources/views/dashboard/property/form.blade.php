@extends('layouts.vertical', ['title' => 'Usuários', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', [
        'sub_title' => 'Imóvel',
        'page_title' => \Config::get('layout.titulo'),
    ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                    {!! Form::model($data, [
                        'method' => 'put',
                        'autocomplete' => false,
                        'route' => ['dashboard.property.update', $data->id, http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @else
                    {!! Form::open([
                        'method' => 'post',
                        'autocomplete' => false,
                        'route' => ['dashboard.property.create', http_build_query(Request::input())],
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
                    <div class="col-12">{!! Form::label('user_id', 'Corretor', ['class' => 'col-form-label font-weight-bold', 'id' => 'Corretor']) !!}</div>
                    <div class="col-12">{!! Form::select('user_id', $allUsers, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Selecione uma opção',
                    ]) !!}
                        @if (!empty($errors->first('user_id')))
                            <label class="invalid-feedback d-block">{!! $errors->first('user_id') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('type_rent', 'Aluguel', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">
                        <input type="checkbox" class="form-check" @if (isset($data->type_rent) ? $data->type_rent == 1 : false) checked="true" @endif
                            name="type_rent" id="type_rent">
                        @if (!empty($errors->first('type_rent')))
                            <label class="invalid-feedback d-block">{!! $errors->first('type_rent') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row {!! isset($data->type_rent) ? $data->type_rent == '' : 'd-none' !!}" id="rent">
                    <div class="col-12">{!! Form::label('value_rent', 'Valor do Aluguel', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('value_rent', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Valor do Aluguel',
                        'data-toggle' => 'input-mask',
                        'data-mask-format' => '#.##0,00',
                        'data-reverse' => 'true',
                    ]) !!}
                        @if (!empty($errors->first('value_rent')))
                            <label class="invalid-feedback d-block">{!! $errors->first('value_rent') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('type_buy', 'Venda', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">
                        <input type="checkbox" class="form-check" @if (isset($data->type_buy) ? $data->type_buy == 1 : false) checked="true" @endif
                            name="type_buy" id="type_buy">
                        @if (!empty($errors->first('type_buy')))
                            <label class="invalid-feedback d-block">{!! $errors->first('type_buy') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row {!! isset($data->type_buy) ? $data->type_buy == '' : 'd-none' !!}" id="buy">
                    <div class="col-12">{!! Form::label('value_buy', 'Valor de Venda', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('value_buy', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Valor de Venda',
                        'data-toggle' => 'input-mask',
                        'data-mask-format' => '#.##0,00',
                        'data-reverse' => 'true',
                    ]) !!}
                        @if (!empty($errors->first('value_rent')))
                            <label class="invalid-feedback d-block">{!! $errors->first('value_rent') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('type_id', 'Tipo de Imóvel', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">{!! Form::select('type_id', $allTypes, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Selecione uma opção',
                    ]) !!}
                        @if (!empty($errors->first('type_id')))
                            <label class="invalid-feedback d-block">{!! $errors->first('type_id') !!}</label>
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
                    <div class="col-12">{!! Form::label('neighborhood', 'Bairro', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('neighborhood', null, ['class' => 'form-control', 'placeholder' => 'Bairro']) !!}
                        @if (!empty($errors->first('neighborhood')))
                            <label class="invalid-feedback d-block">{!! $errors->first('neighborhood') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('state_id', 'Estado', ['class' => 'col-form-label font-weight-bold', 'id' => 'estado']) !!}</div>
                    <div class="col-12">{!! Form::select('state_id', $allStates, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Selecione uma opção',
                    ]) !!}
                        @if (!empty($errors->first('state_id')))
                            <label class="invalid-feedback d-block">{!! $errors->first('state_id') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('city_id', 'Cidade', ['class' => 'col-form-label font-weight-bold', 'id' => 'cidade']) !!}</div>
                    <div class="col-12">{!! Form::select('city_id', $allCities, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Selecione uma opção',
                        'disabled' => true,
                    ]) !!}
                        @if (!empty($errors->first('city_id')))
                            <label class="invalid-feedback d-block">{!! $errors->first('city_id') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('description', 'Descrição', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição']) !!}
                        @if (!empty($errors->first('description')))
                            <label class="invalid-feedback d-block">{!! $errors->first('description') !!}</label>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 py-4"><label><strong>Características do Imóvel</strong></label></div>
                    @foreach ($allFeatures as $key => $value)
                        <div class="col-6 col-sm-4 pb-3">
                            <div class="custom-control custom-checkbox custom-checkbox-primary">
                                {!! Form::checkbox(
                                    'feature[]',
                                    $key,
                                    isset($data) ? in_array($key, $data->features->pluck('id')->toArray()) : false,
                                    ['class' => 'custom-control-input', 'id' => 'feature-' . $key],
                                ) !!}
                                {!! Form::label('feature-' . $key, $value, ['class' => 'custom-control-label']) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('bedroom', 'Quarto(s)', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('bedroom', null, ['class' => 'form-control', 'placeholder' => 'Quarto(s)']) !!}
                        @if (!empty($errors->first('bedroom')))
                            <label class="invalid-feedback d-block">{!! $errors->first('bedroom') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('bathroom', 'Banheiro(s)', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('bathroom', null, ['class' => 'form-control', 'placeholder' => 'Banheiro(s)']) !!}
                        @if (!empty($errors->first('bathroom')))
                            <label class="invalid-feedback d-block">{!! $errors->first('bathroom') !!}</label>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">{!! Form::label('area', 'Área Construída', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::text('area', null, ['class' => 'form-control', 'placeholder' => 'Área Construída']) !!}
                        @if (!empty($errors->first('area')))
                            <label class="invalid-feedback d-block">{!! $errors->first('area') !!}</label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">{!! Form::label('fotos', 'Fotos', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12">
                        <input type="file" name="fotos[]" id="fotos" multiple>
                    </div>
                </div>
                <div id="galeria"></div>
                <div class="row">
                    <div class="col-12 text-end pt-3">
                        <a href="{!! route('dashboard.property.index') !!}" class="btn btn-secondary rounded-0">Voltar</a>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var estadoSelect = document.getElementById("state_id");
            var cidadeSelect = document.getElementById("city_id");
            var galeriaDiv = document.getElementById("galeria");

            estadoSelect.addEventListener("change", function() {
                buscarCidades();
            });

            function buscarCidades() {
                var estadoSelecionado = estadoSelect.value;
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var cidades = JSON.parse(xhr.responseText);
                            atualizarCidades(cidades);
                        } else {
                            console.error('Ocorreu um erro ao buscar cidades.');
                        }
                    }
                };

                var base_url = "{{ route('api.cityByState') }}"; // Substitua pela URL correta da sua rota
                xhr.open("GET", base_url + '?state_id=' + estadoSelecionado, true);
                xhr.send();
            }

            function atualizarCidades(cidades) {
                cidadeSelect.disabled = false;
                cidadeSelect.innerHTML = ""; // Limpa o select de cidades

                cidades.forEach(function(cidade) {
                    var option = document.createElement("option");
                    option.text = cidade.name;
                    option.value = cidade.id;
                    cidadeSelect.appendChild(option);
                });
            }


            var typeRentCheckbox = document.getElementById("type_rent");
            var rentDiv = document.getElementById("rent");

            typeRentCheckbox.addEventListener("change", function() {
                if (typeRentCheckbox.checked) {
                    rentDiv.classList.remove(
                        "d-none"); // Remove a classe "d-none" para mostrar a div "rent"
                } else {
                    rentDiv.classList.add("d-none"); // Adiciona a classe "d-none" para ocultar a div "rent"
                }
            });


            var typeBuyCheckbox = document.getElementById("type_buy");
            var buyDiv = document.getElementById("buy");

            typeBuyCheckbox.addEventListener("change", function() {
                if (typeBuyCheckbox.checked) {
                    buyDiv.classList.remove(
                        "d-none"); // Remove a classe "d-none" para mostrar a div "rent"
                } else {
                    buyDiv.classList.add("d-none"); // Adiciona a classe "d-none" para ocultar a div "rent"
                }
            });
        });
    </script>

    @if (isset($data))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var xhr = new XMLHttpRequest();
                var divFoto = '';
                xhr.open('GET', '{{ route('api.listar.fotos', $data->id) }}', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var fotos = JSON.parse(xhr.responseText);
                            // Manipule os dados retornados aqui
                            divFoto += '<div class="row py-4">'
                            fotos.forEach(function(foto) {
                                divFoto += '<div class="col-11 py-2">'
                                divFoto += '<img src="' + foto['url_image'] +
                                    '" class="img-responsive" width="240" height="240" />'
                                divFoto += '</div>'
                                divFoto += '<div class="col-1 py-2">'
                                divFoto +=
                                    '<a href="{!! route('api.excluir.foto') !!}?id={!! $data->id !!}&nomeArquivo=' +
                                    foto['image'] + '" class="btn btn-outline-danger btn-delete">';
                                divFoto += '<i class="bi bi-x-square"></i></a>';
                                divFoto += '</div>'
                                console.log('foto' + foto)
                                document.getElementById("galeria").innerHTML = divFoto
                            })
                            divFoto += '</div>'
                        } else {
                            console.error('Erro na requisição: ' + xhr.status);
                        }
                    }
                };
                xhr.send();
            });


            function excluirFoto(nomeArquivo) {
                if (confirm("Tem certeza de que deseja excluir esta foto?")) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route('api.excluir.foto') }}', true);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Atualize a interface ou faça qualquer outra ação necessária
                                alert('Foto excluída com sucesso.');
                                // Por exemplo, você pode recarregar a página para atualizar a lista de fotos
                                window.location.reload();
                            } else {
                                alert('Erro ao excluir a foto.');
                            }
                        }
                    };
                    xhr.send(JSON.stringify({
                        nome_arquivo: nomeArquivo
                    }));
                }
            }
        </script>
    @endif
@endsection
