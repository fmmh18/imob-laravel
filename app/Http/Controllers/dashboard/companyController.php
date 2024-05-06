<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Cnae;
use App\Models\Company;
use App\Models\costCenter;
use App\Models\financialNature;
use App\Models\formOfPayment;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\ServiceItemLC;
use App\Models\site;
use App\Models\User;
use App\Notifications\userCreate;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class companyController extends Controller
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
        $data = Company::orderBy('name_fantasy');

        if ($request->input('name_fantasy')) {
            $data = $data->where('name_fantasy', 'LIKE', '%' . $request->input('name_fantasy') . '%');
        }
        if ($request->input('cgc')) {
            $data = $data->where('cgc', $request->input('cgc'));
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.company.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {
        $allBanks = Bank::all()->pluck('name', 'id');
        $allModules = Module::all();
        $allFormPay = formOfPayment::all()->pluck('title', 'id');
        $allCnaes = Cnae::all()->pluck('fullname', 'id');
        $allItems = ServiceItemLC::all()->pluck('fullname', 'id');
        $allCostCenter = costCenter::all()->pluck('title', 'id');
        $allFinancialNature = financialNature::all()->pluck('title', 'id');
        \Config::set('layout.titulo', 'Criar');
        return view(
            'dashboard.company.form',
            compact('allModules', 'allBanks', 'allFormPay', 'allCnaes', 'allItems', 'allCostCenter', 'allFinancialNature')
        );
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->input(), [
            'cgc' => 'required',
            'social_reason' => 'required',
            'address' => 'required',
            'number' => 'required',
            'neighborhood' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.company.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $request->merge(array(
            'status' => 1
        ));

        try {
            $company = Company::create($request->all());

            $request->merge(array(
                'cgc' => str_replace(array('.', '-'), '', $request->input('cgc'))
            ));
            if (!empty($request->input('module'))) {
                $company->modules()->sync(($request->input('module') == null) ? [] : $request->input('module'));
            }

            if ($request->input('cpf')) {
                $user = User::where('cpf', $request->input('cpf'))->first();
                if ($user) {
                    $user = $user;
                } else {
                    $user = User::create([
                        'name' => $request->input('name_responsable'),
                        'cpf' => str_replace(array('.', '-'), '', $request->input('cpf')),
                        'email' => $request->input('email_responsable'),
                        'password' => '123123',
                        'is_manager' => 0,
                        'status' => 0
                    ]);
                    Notification::send($user, new userCreate($user));
                }

                $company->users_roles()->attach($user, ['role_id' => 2]);
            }
            Alert::success('Empresa', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Empresa', $e->getMessage());
        }
        return redirect(route("dashboard.company.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $allBanks = Bank::all()->pluck('name', 'id');
        $data = Company::find($id);
        $allModules = Module::all();
        $allFormPay = formOfPayment::all()->pluck('title', 'id');
        $allCnaes = Cnae::all()->pluck('fullname', 'id');
        $allItems = ServiceItemLC::all()->pluck('fullname', 'id');
        $allCostCenter = costCenter::all()->pluck('title', 'id');
        $allFinancialNature = financialNature::all()->pluck('title', 'id');
        \Config::set('layout.titulo', 'Editar');
        return view('dashboard.company.form', ['data' => $data, 'allModules' => $allModules, 'allBanks' => $allBanks, 'allFormPay' => $allFormPay, 'allCnaes' => $allCnaes, 'allItems' => $allItems, 'allCostCenter' => $allCostCenter, 'allFinancialNature' => $allFinancialNature]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'cgc' => 'required',
            'social_reason' => 'required',
            'address' => 'required',
            'number' => 'required',
            'neighborhood' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.company.show', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $company = Company::find($id);

            if (!empty($request->input('module'))) {
                $company->modules()->sync(($request->input('module') == null) ? [] : $request->input('module'));
            }
            if ($request->input('cpf')) {
                $user = User::where('cpf', $request->input('cpf'))->first();
                $company->users_roles()->attach($user, ['role_id' => 2]);
            }
            $company = $company->update($request->all());
            Alert::success('Empresa', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Empresa', $e->getMessage());
        }
        return redirect(route("dashboard.company.index"));
    }

    public function destroy($id)
    {
        try {
            $data = Company::find($id);
            $data = $data->delete();
            Alert::success('Empresa', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Empresa', $e->getMessage());
        }

        return redirect(route("dashboard.company.index"));
    }

    public function listUser($id)
    {

        if (empty($id)) {
            abort(404);
        }
        $data = Company::find($id);
        $data = $data->users()->get();


        $allRoles = Role::whereNot('id', 1)->get();

        \Config::set('layout.titulo', 'Editar');
        return view('dashboard.company.list', ['data' => $data, 'allRoles' => $allRoles]);
    }

    public function storePermission(Request $request)
    {
        try {
            $company = Company::find($request->input('company_id'));
            $user = User::find($request->input('user_id'));
            $role = Role::find($request->input('role_id'));
            $company->users_roles()->detach();
            $company->users_roles()->attach($user, ['role_id' => $role->id]);
            Alert::success('Empresa', 'Permissão atribuída com sucesso!');
        } catch (Exception $e) {
            Alert::error('Empresa', $e->getMessage());
        }

        return redirect(route("dashboard.company.list", $request->input('company_id')));
    }
}
