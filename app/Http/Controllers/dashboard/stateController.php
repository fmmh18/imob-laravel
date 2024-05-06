<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\State;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class stateController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();


            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $data = State::orderBy('name');

        if ($request->input('name')) {
            $data = $data->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.state.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {

        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.state.form');
    }

    public function store(Request $request)
    {



        try {
            $data = State::create($request->all());


            Alert::success('Estado', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Estado', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.state.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = State::find($id);

        \Config::set('layout.titulo', 'Editar');

        return view('dashboard.state.form', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = State::find($id);

            Alert::success('Estado', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Estado', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.state.index"));
    }

    public function destroy($id)
    {
        try {
            $data = State::find($id);
            $data = $data->delete();
            Alert::success('Estado', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Estado', $e->getMessage());
        }

        return redirect(route("dashboard.state.index"));
    }
}
