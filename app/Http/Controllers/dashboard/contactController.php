<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class contactController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();

            return $next($request);
        });
    }

    public function index(Request $request, $type)
    {
        $data = Contact::orderBy('name');
        if ($type == 'lead') {
            $tipo = 2;
        } else {
            $tipo = 1;
        }
        $data = $data->where('type', $tipo);
        if ($request->input('name')) {
            $data = $data->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.contact.index', [
            'data' => $data->paginate(25),
            'type' => $type
        ]);
    }
    public function show($type, $id)
    {
        if (empty($id)) {
            abort(404);
        }
        $data = Contact::find($id);
        \Config::set('layout.titulo', 'Editar');
        return view('dashboard.contact.form', ['data' => $data,   'type' => $type]);
    }

    public function update(Request $request, $type, $id)
    {



        try {
            $data = Contact::find($id);
            if ($type == 'lead') {
                if (strlen($request->input('response')) > 50) {
                    $request->merge(['return' => 1]);
                }
            }


            $data = $data->update($request->all());
            Alert::success('Contato', 'Atualizado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Contato', 'Erro ao atualizar');
        }
        return redirect(route("dashboard.contact.index", [$type, $id]));
    }
}
