<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Permission;
use App\Models\Role;
use App\Models\site;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class roleController extends Controller
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
        $data = Role::orderBy('title');

        if ($request->input('title')) {
            $data = $data->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }
        if ($request->input('description')) {
            $data = $data->where('description', 'LIKE', '%' . $request->input('description') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.role.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {
        $groups = Permission::select('group')->distinct()->get();
        $allPermissions = Permission::all();
        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.role.form', ['allPermissions' => $allPermissions, 'groups' => $groups]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->input(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.role.create'))
                ->withErrors($validator)
                ->withInput();
        }



        $data = Role::create($request->all());

        if (!empty($request->input('permission'))) {
            $data->permissions()->sync(($request->input('permission') == null) ? [] : $request->input('permission'));
        }
        try {
            Alert::success('Grupo de Permissão', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Grupo de Permissão', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.role.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = Role::find($id);

        $groups = Permission::select('group')->distinct()->get();
        \Config::set('layout.titulo', 'Editar');
        $allPermissions = Permission::all();
        return view('dashboard.role.form', ['data' => $data,   'allPermissions' => $allPermissions, 'groups' => $groups]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('dashboard.role.show', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = Role::find($id);

            if (!empty($request->input('permission'))) {
                $data->permissions()->sync(($request->input('permission') == null) ? [] : $request->input('permission'));
            }

            $data = $data->update($request->all());
            Alert::success('Grupo de Permissão', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Grupo de Permissão', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.role.index"));
    }

    public function destroy($id)
    {
        try {
            $data = Role::find($id);
            $data = $data->delete();
            Alert::success('Grupo de Permissão', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Grupo de Permissão', $e->getMessage());
        }

        return redirect(route("dashboard.role.index"));
    }
}
