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
        $allPropertiesRent = Property::where('type_rent', 1)->limit(12)->get();
        $allPropertiesBuy = Property::where('type_buy', 1)->limit(12)->get();
        $allCities = City::join('properties', 'cities.id', '=', 'properties.city_id')
            ->select('cities.id AS id', 'cities.name AS name')
            ->distinct()
            ->get();
        $allTypes = Type::all();
        return view('site.index', [
            'allPropertiesBuy' => $allPropertiesBuy,
            'allPropertiesRent' => $allPropertiesRent,
            'allCities' => $allCities,
            'allTypes' => $allTypes
        ]);
    }

    public function list(Request $request)
    {
        $allProperties = Property::paginate(15);

        if ($request->input('type')) {
            $allProperties = $allProperties->where('type_id', $request->input('type'));
        }
        if ($request->input('city')) {
            $allProperties = $allProperties->where('city_id', $request->input('city'));
        }
        if ($request->input('title')) {
            $allProperties = $allProperties->where('title', 'like', '%' . $request->input('title') . '%');
        }


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
