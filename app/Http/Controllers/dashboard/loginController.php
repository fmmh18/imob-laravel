<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class loginController extends Controller
{

    public function index()
    {
        return view('dashboard.auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->only('email'))->first();


        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {


            Alert::toast('Acesso não autorizado!', 'error');
            return redirect(route("login"));
        }
        $request->session()->regenerate();

        return redirect(route("dashboard.home"));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::toast('Voce foi deslogado com sucesso!', 'success');
        return redirect(route("login"));
    }
    public function active(Request $request)
    {
        try {
            $data = User::where('cpf', $request->input('cpf'))->where('status', 0)->first();
            $data->update(['status' => 1]);
            Alert::success('Usuário', 'Ativado com sucesso');
        } catch (Exception $e) {
            Alert::error('Usuário', $e->getMessage());
        }
        return redirect(route("login"));
    }
}
