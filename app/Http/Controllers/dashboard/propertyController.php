<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\dashboardController;
use App\Models\City;
use App\Models\Feature;
use App\Models\Property;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class propertyController extends dashboardController
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();

            parent::__construct($this->user, $request);

            return $next($request);
        });
    }


    public function index(Request $request)
    {
        $data = Property::orderBy('title');

        if ($request->input('title')) {
            $data = $data->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.property.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {

        $allStates = State::all()->pluck('name', 'id');
        $allCities = City::all()->pluck('name', 'id');
        $allTypes = Type::all()->pluck('name', 'id');
        $allFeatures = Feature::all()->pluck('name', 'id');
        $allUsers = User::where('is_manager', 1)->get()->pluck('name', 'id');

        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.property.form', ['allStates' => $allStates, 'allCities' => $allCities, 'allTypes' => $allTypes, 'allFeatures' => $allFeatures, 'allUsers' => $allUsers]);
    }

    public function store(Request $request)
    {

        if ($request->input('type_rent') == 'on') {
            $value_rent = str_replace(array('.'), '', $request->input('value_rent'));
            $request->merge(array(
                'type_rent' => ($request->input('type_rent') == 'on' ? 1 : 2),
                'value_rent' => str_replace(array(','), '.', $value_rent)
            ));
        }
        if ($request->input('type_buy') == 'on') {
            $value_buy = str_replace(array('.'), '', $request->input('value_buy'));
            $request->merge(array(
                'type_buy' => ($request->input('type_buy') == 'on' ? 1 : 2),
                'value_buy' => str_replace(array(','), '.', $value_buy)
            ));
        }

        try {

            $data = Property::create($request->all());
            $data->features()->sync(($request->input('feature') == null) ? [] : $request->input('feature'));

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    // Salvar a foto em algum lugar (por exemplo, no armazenamento público)
                    $foto->store('/public/imovel/' . $data->id . '/');
                }
            }

            Alert::success('Propriedade', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Propriedade', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.property.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = Property::find($id);


        $allStates = State::all()->pluck('name', 'id');
        $allCities = City::all()->pluck('name', 'id');
        $allTypes = Type::all()->pluck('name', 'id');
        $allFeatures = Feature::all()->pluck('name', 'id');
        $allUsers = User::where('is_manager', 1)->get()->pluck('name', 'id');

        \Config::set('layout.titulo', 'Editar');

        return view('dashboard.property.form', ['data' => $data, 'allStates' => $allStates, 'allCities' => $allCities, 'allTypes' => $allTypes, 'allFeatures' => $allFeatures, 'allUsers' => $allUsers]);
    }

    public function update(Request $request, $id)
    {

        if ($request->input('type_rent') == 'on') {
            $value_rent = str_replace(array('.'), '', $request->input('value_rent'));
            $request->merge(array(
                'type_rent' => ($request->input('type_rent') == 'on' ? 1 : 2),
                'value_rent' => str_replace(array(','), '.', $value_rent)
            ));
        }
        if ($request->input('type_buy') == 'on') {
            $value_buy = str_replace(array('.'), '', $request->input('value_buy'));
            $request->merge(array(
                'type_buy' => ($request->input('type_buy') == 'on' ? 1 : 2),
                'value_buy' => str_replace(array(','), '.', $value_buy)
            ));
        }

        try {
            $data = Property::find($id);

            $data->update($request->all());

            $data->features()->sync(($request->input('feature') == null) ? [] : $request->input('feature'));


            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    // Salvar a foto em algum lugar (por exemplo, no armazenamento público)
                    $foto->store('public/imovel/' . $data->id . '/');
                }
            }

            Alert::success('Propriedade', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Propriedade', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.property.index"));
    }

    public function destroy($id)
    {
        try {
            $data = Property::find($id);
            $data = $data->delete();
            Alert::success('Propriedade', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Propriedade', $e->getMessage());
        }

        return redirect(route("dashboard.property.index"));
    }
}
