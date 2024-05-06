<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class cityController extends Controller
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
        $data = City::orderBy('name');

        if ($request->input('name')) {
            $data = $data->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.city.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {

        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.city.form');
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'password' => 'required',
            'is_manager' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.city.create'))
                ->withErrors($validator)
                ->withInput();
        }



        try {
            $data = City::create($request->all());


            Alert::success('Cidade', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Cidade', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.city.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = City::find($id);

        \Config::set('layout.titulo', 'Editar');

        return view('dashboard.city.form', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'is_manager' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.City.show', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = City::find($id);

            Alert::success('Cidade', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Cidade', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.city.index"));
    }

    public function destroy($id)
    {
        try {
            $data = City::find($id);
            $data = $data->delete();
            Alert::success('Cidade', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Cidade', $e->getMessage());
        }

        return redirect(route("dashboard.city.index"));
    }
}
