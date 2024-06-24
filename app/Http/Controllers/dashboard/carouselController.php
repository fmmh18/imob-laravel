<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\dashboardController;
use App\Models\Carousel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class carouselController extends dashboardController
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();


            parent::__construct($this->user, $request);

            return $next($request);
        });
    }


    public function index(Request $request)
    {
        $data = Carousel::orderBy('title');

        if ($request->input('title')) {
            $data = $data->where('title', 'LIKE', '%' . $request->input('title') . '%');
        }
        \Config::set('layout.titulo', 'Listar');
        return view('dashboard.carousel.index', [
            'data' => $data->paginate(25)
        ]);
    }

    public function create()
    {
        $allStatus = User::allStatus();

        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.carousel.form', ['allStatus' => $allStatus]);
    }

    public function store(Request $request)
    {


        if (!empty($request->file('images'))) {


            $name = time() . '.' . $request->file('images')->getClientOriginalExtension();

            $request->file('images')->storeAs("carousel/", $name, 'public');

            $request->merge(array(
                'image'     =>  "/storage/carousel/" . $name
            ));
        }


        try {
            Carousel::create($request->all());

            Alert::success('Imagem', 'Cadastrada realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Imagem', 'Erro ao cadastrar');
        }
        return redirect(route("dashboard.carousel.index"));
    }


    public function show($id)
    {
        if (empty($id)) {
            abort(404);
        }
        $allStatus = User::allStatus();
        $data = Carousel::find($id);

        \Config::set('layout.titulo', 'Criar');
        return view('dashboard.carousel.form', ['allStatus' => $allStatus, 'data' => $data]);
    }


    public function update(Request $request, $id)
    {


        if (!empty($request->file('images'))) {


            $name = time() . '.' . $request->file('images')->getClientOriginalExtension();

            $request->file('images')->storeAs("carousel/", $name, 'public');

            $request->merge(array(
                'image'     =>  "/storage/carousel/" . $name
            ));
        }


        try {
            $data = Carousel::find($id);
            $data->update($request->all());

            Alert::success('Imagem', 'Alterado realizado com sucesso!');
        } catch (Exception $e) {
            Alert::error('Imagem', 'Erro ao alterar');
        }
        return redirect(route("dashboard.carousel.index"));
    }
    public function destroy($id)
    {
        try {
            $data = Carousel::find($id);
            $data = $data->delete();
            Alert::success('Imagem', 'Registro excluído com sucesso!');
        } catch (Exception $e) {
            Alert::error('Imagem', $e->getMessage());
        }

        return redirect(route("dashboard.carousel.index"));
    }
}
