@extends('layouts.vertical', ['title' => 'Conteúdos00', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    @include('layouts.shared/page-title', [
        'sub_title' => 'Conteúdo',
        'page_title' => \Config::get('layout.titulo'),
    ])

    <div class="row">

        <div class="card">
            <div class="card-body">
                @if (isset($data))
                    {!! Form::model($data, [
                        'method' => 'put',
                        'autocomplete' => false,
                        'route' => ['dashboard.page.update', $data->id, http_build_query(Request::input())],
                        'class' => $errors->any() ? 'was-validated' : '',
                        'novalidate',
                        'files' => true,
                    ]) !!}
                @else
                    {!! Form::open([
                        'method' => 'post',
                        'autocomplete' => false,
                        'route' => ['dashboard.page.create', http_build_query(Request::input())],
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
                    <div class="col-12">{!! Form::label('description', 'Descrição', ['class' => 'col-form-label font-weight-bold']) !!}</div>
                    <div class="col-12"> {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição']) !!}
                        @if (!empty($errors->first('description')))
                            <label class="invalid-feedback d-block">{!! $errors->first('description') !!}</label>
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
                    var galeriaDiv = document.getElementById("galeria");
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
