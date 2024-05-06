<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;
use RealRashid\SweetAlert\Facades\Alert;

class fotoController extends Controller
{
    public function listarFotos($id): JsonResponse
    {
        $diretorio = public_path('storage/imovel/' . $id . '/'); // Diretório onde as fotos estão armazenadas

        // Verifica se o diretório existe
        if (!File::isDirectory($diretorio)) {
            return response()->json(['error' => 'O diretório de fotos não existe'], 404);
        }

        // Obtém todos os arquivos do diretório
        $arquivos = File::files($diretorio);

        $fotos = [];
        foreach ($arquivos as $arquivo) {

            // Adiciona o caminho completo da imagem ao array de fotos
            $fotos[] = [
                'url_image' => asset('storage/imovel/' . $id . '/' . $arquivo->getFilename()),

                'image' => $arquivo->getFilename()
            ];
        }

        return response()->json($fotos);
    }

    public function excluirFoto(Request $request)
    {
        $caminhoFoto = public_path('storage/imovel/' . $request->id . '/' . $request->nomeArquivo); // Caminho completo da foto

        // Verifica se o arquivo existe
        if (File::exists($caminhoFoto)) {
            // Tenta excluir o arquivo
            if (File::delete($caminhoFoto)) {
                Alert::success('Propriedade', 'Registro excluído com sucesso!');
            } else {
                Alert::error('Propriedade', 'Registro não excluído!');
            }
        } else {
            Alert::error('Propriedade', 'Foto não encontrada.');
        }
        return redirect()->back();
    }
}
