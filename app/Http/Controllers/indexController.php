<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Contact;
use App\Models\Pages;
use App\Models\Property;
use App\Models\Type;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Rules\ReCaptcha;

class indexController extends Controller
{


    public function index(Request $request)
    {
        $allProperties = Property::limit(24)->get();
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

    public function about()
    {

        $data = Pages::where('slug', 'quem-somos')->first();
        return view('site.page', [
            'data' => $data
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

        $data->counts = ($data->counts + 1);
        $data->save();
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

    public function storeLead(Request $request)
    {

        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('openModal', true); // Passa a variável para indicar que o modal deve ser aberto

        }

        $request->merge(['type' => 2]);
        try {
            Contact::create($request->all());
            Alert::success('Contato', 'Contato realizado com sucesso!');
        } catch (Exception $e) {

            Alert::error('Contato', 'Contato  não cadastrado!');
        }
        return redirect(route('index'));
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function storeContact(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $request->merge(['type' => 1]);
        try {
            Contact::create($request->all());
            Alert::success('Contato', 'Contato realizado com sucesso!');
        } catch (Exception $e) {

            Alert::error('Contato', 'Contato  não cadastrado!');
        }
        return redirect(route('contact'));
    }
}
