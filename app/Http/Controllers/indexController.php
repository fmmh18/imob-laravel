<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Property;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class indexController extends Controller
{


    public function index(Request $request)
    {
        $allProperties = Property::limit(12)->get();
        $allCities = City::join('properties', 'cities.id', '=', 'properties.city_id')
            ->select('cities.id AS id', 'cities.name AS name')
            ->distinct()
            ->get();
        $allTypes = Type::all();
        return view('site.index', [
            'allProperties' => $allProperties,
            'allCities' => $allCities,
            'allTypes' => $allTypes
        ]);
    }

    public function list(Request $request)
    {
        $allProperties = Property::paginate(15);
        $allCities = City::join('properties', 'cities.id', '=', 'properties.city_id')
            ->select('cities.id AS id', 'cities.name AS name')
            ->distinct()
            ->get();
        $allTypes = Type::all();
        return view('site.list', [
            'allProperties' => $allProperties,
            'allCities' => $allCities,
            'allTypes' => $allTypes
        ]);
    }

    public function detail($id)
    {

        $data = Property::find($id);
        return view('site.detail', [
            'data' => $data
        ]);
    }

    public function primeiroArquivo($id)
    {
        $diretorio = public_path('storage/imovel/' . $id . '/'); // Diretório onde as fotos estão armazenadas

        // Verifica se o diretório existe
        if (!File::isDirectory($diretorio)) {
            return 'O diretório de fotos não existe';
        }

        // Obtém todos os arquivos do diretório
        $arquivos = File::files($diretorio);

        // Verifica se há arquivos disponíveis
        if (count($arquivos) > 0) {
            $primeiroArquivo = $arquivos[0];
            dd($primeiroArquivo);
            return asset('storage/imovel/' . $id . '/' . $primeiroArquivo->getFilename());
        } else {
            return 'Não há fotos disponíveis para esta propriedade';
        }
    }
}
