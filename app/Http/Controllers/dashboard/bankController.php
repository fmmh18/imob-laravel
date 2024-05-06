<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class bankController extends Controller

{

    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $filtro = false;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::guard('web')->user();

            return $next($request);
        });
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' : 'asc';
        $this->sortField = $field;
    }

    public function filtros(Request $request)
    {
        $this->filtro = true;

        $query = \App\Models\Bank::query();

        if ($request->input('ispb') !== null) {
            $query->where('ispb', $request->input('ispb'));
        }

        if ($request->input('code') !== null) {
            $query->where('code', $request->input('code'));
        }

        if ($request->input('name') !== null) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->input('fullName') !== null) {
            $query->where('fullName', 'LIKE', '%' . $request->input('fullName') . '%');
        }

        if ($request->input('activated') !== null) {
            $query->where('activated', $request->input('activated'));
        }

        return $query;
    }

    public function index(Request $request)
    {
        $filtros = $this->filtros($request);

        if ($this->filtro) {
            // Debug: exibe a SQL gerada
            // dd($filtros->toSql());

            $data = $filtros
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(5);
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.bank.index', compact('data'));
    }

    public function create()
    {
        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.bank.form');
    }

    public function store(BankRequest $request)
    {
        try {
            \App\Models\Bank::create($request->all());
            Alert::success('Banco', 'Cadastrado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Banco', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.bank.index"));
    }

    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = \App\Models\Bank::find($id);

        \Config::set('layout.titulo', 'Editar');
        return view('dashboard.bank.form', compact('data'));
    }

    public function update(BankRequest $request, $id)
    {
        try {
            $data = \App\Models\Bank::find($id)->update($request->all());
            Alert::success('Banco', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Banco', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.bank.index"));
    }

    public function destroy($id)
    {
        try {
            $data = \App\Models\Bank::find($id)->delete();
            Alert::success('Banco', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Banco', $e->getMessage());
        }

        return redirect(route("dashboard.bank.index"));
    }
}
