<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class pageController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();

            return $next($request);
        });
    }


    public function show($slug)
    {
        if (empty($slug)) {
            abort(404);
        }
        $data = Pages::where('slug', $slug)->first();

        \Config::set('layout.titulo', 'Editar');
        return view('dashboard.page.form', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'title' => 'required',
        ]);

        $data = Pages::find($id);
        $data2 = Pages::find($id);
        if ($validator->fails()) {
            return redirect(route('dashboard.page.show', $data2->slug))
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $data = $data->update($request->all());
            Alert::success('Conteúdo', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Conteúdo', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.page.show", $data2->slug));
    }
}
