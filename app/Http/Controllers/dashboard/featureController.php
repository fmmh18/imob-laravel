<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\dashboardController;
use App\Models\Feature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class featureController extends dashboardController
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
        $data = Feature::orderBy('name');

        if ($request->input('name')) {
            $data = $data->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->input('email')) {
            $data = $data->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.feature.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {

        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.feature.form');
    }

    public function store(Request $request)
    {

        try {

            $request->merge(array(
                'slug' => \Str::of($request->input('name'))->slug('-')
            ));

            Feature::create($request->all());


            Alert::success('Característica do Imóvel', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Característica do Imóvel', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.feature.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = Feature::find($id);

        \Config::set('layout.titulo', 'Editar');

        return view('dashboard.feature.form', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->merge(array(
                'slug' => \Str::of($request->input('name'))->slug('-')
            ));

            $data = Feature::find($id);

            $data = $data->update($request->all());

            Alert::success('Característica do Imóvel', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Característica do Imóvel', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.feature.index"));
    }

    public function destroy($id)
    {
        try {
            $data = Feature::find($id);
            $data = $data->delete();
            Alert::success('Característica do Imóvel', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Característica do Imóvel', $e->getMessage());
        }

        return redirect(route("dashboard.feature.index"));
    }
}
