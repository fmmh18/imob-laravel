<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\site;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Uuid;

class siteController extends Controller
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
        $data = site::orderBy('title');

        if ($request->input('title')) {
            $data = $data->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.site.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {
        $allCompanies = Company::all()->pluck('name_fantasy', 'id');
        $allStatus = site::allStatus();
        $allType = site::allType();
        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.site.form', ['allCompanies' => $allCompanies, 'allStatus' => $allStatus, 'allType' => $allType]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'company_id' => 'required',
            'type' => 'required',
            'url_base' => 'required',
            'password' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.role.create'))
                ->withErrors($validator)
                ->withInput();
        }


        $request->merge(array(
            'key' => Uuid::uuid4()->toString()
        ));

        if (!empty($request->file('images'))) {

            $user_name = \Str::slug($request->input('url_base'), '-');

            $name = time() . '.' . $request->file('images')->getClientOriginalExtension();

            $request->file('images')->storeAs("site/" . $user_name . "/", $name, 'public');

            $request->merge(array(
                'logo'     =>  "/storage/site/" . $user_name . "/" . $name
            ));
        }


        if (!empty($request->file('icons'))) {

            $user_name = \Str::slug($request->input('url_base'), '-');

            $name = time() . '.' . $request->file('icons')->getClientOriginalExtension();

            $request->file('icons')->storeAs("site/" . $user_name . "/", $name, 'public');

            $request->merge(array(
                'favicon'     =>  "/storage/site/" . $user_name . "/" . $name
            ));
        }
        try {
            site::create($request->all());
            Alert::success('Sites', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Sites', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.site.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = site::find($id);

        \Config::set('layout.titulo', 'Editar');
        $allCompanies = Company::all()->pluck('name_fantasy', 'id');
        $allStatus = site::allStatus();
        $allType = site::allType();
        return view('dashboard.site.form', ['data' => $data,   'allCompanies' => $allCompanies, 'allStatus' => $allStatus, 'allType' => $allType]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'company_id' => 'required',
            'type' => 'required',
            'url_base' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.site.show', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = site::find($id);


            $data = $data->update($request->all());
            Alert::success('Sites', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Sites', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.site.index"));
    }


    public function destroy($id)
    {
        try {
            $data = site::find($id);
            $data = $data->delete();
            Alert::success('Site', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Site', $e->getMessage());
        }

        return redirect(route("dashboard.site.index"));
    }
}
