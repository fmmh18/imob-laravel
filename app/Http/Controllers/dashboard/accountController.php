<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Company;
use App\Models\site;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class accountController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();

            if ($this->user->is_manager == 1) {
                $allSites = site::all();
                $allCompanies = Company::where('status', 1)->get();
            } else {
                $companies = $this->user->companies()->get()->pluck('id');
                $allCompanies = $this->user->companies()->get();
                $allSites = site::whereIn('company_id', $companies)->get();
            }

            View::share('allSites', $allSites);
            View::share('allCompanies', $allCompanies);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $company_id = $request->session()->get('company_id');

        if (!$company_id) {
            abort(404);
        }

        $data = Account::where('company_id', $company_id);

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.account.index', ['data' => $data->paginate(25)]);
    }

    public function create()
    {
        $allBanks = Bank::all()->pluck('name', 'id');
        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.account.form', ['allBanks' => $allBanks]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->input(), [
            'bank_id' => 'required',
            'agency' => 'required',
            'account' => 'required',
            'type_account' => 'required',
            'balance_initial' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('dashboard.account-bank.create'))
                ->withErrors($validator)
                ->withInput();
        }

        try {


            $balance_initial = str_replace(array('.'), '', $request->input('balance_initial'));

            $balance_initial = str_replace(array(','), '.', $balance_initial);
            $request->merge(array(
                'company_id' => $request->session()->get('company_id'),
                'balance_initial' => $balance_initial

            ));

            Account::create($request->all());
            Alert::success('Conta bancária', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Conta bancária', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.account-bank.index"));
    }
}
