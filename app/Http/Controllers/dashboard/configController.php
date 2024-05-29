<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\dashboardController;
use App\Models\Config;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class configController extends dashboardController
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();


            parent::__construct($this->user, $request);

            return $next($request);
        });
    }

    public function show(Request $request)
    {

        $data = Config::find(1);



        return view('dashboard.config.form', ['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->file('lg_white_sm'))) {

                $name = time() . '.' . $request->file('lg_white_sm')->getClientOriginalExtension();


                $request->file('lg_white_sm')->storeAs("logo/", $name);

                $request->merge(array(
                    'logo_small'     =>  "/storage/logo/" . $name
                ));
            }
            if (!empty($request->file('lg_white'))) {

                $name = time() . '.' . $request->file('lg_white')->getClientOriginalExtension();


                $request->file('lg_white')->storeAs("logo/", $name);

                $request->merge(array(
                    'logo_small'     =>  "/storage/logo/" . $name
                ));
            }

            if (!empty($request->file('lg_dark'))) {

                $name = time() . '.' . $request->file('lg_dark')->getClientOriginalExtension();


                $request->file('lg_dark')->storeAs("logo/", $name);

                $request->merge(array(
                    'logo_dark'     =>  "/storage/logo/" . $name
                ));
            }

            if (!empty($request->file('lg_dark_sm'))) {

                $name = time() . '.' . $request->file('lg_dark_sm')->getClientOriginalExtension();


                $request->file('lg_dark_sm')->storeAs("logo/", $name);

                $request->merge(array(
                    'logo_small_dark'     =>  "/storage/logo/" . $name
                ));
            }
            $data = Config::find(1);
            if ($data != null) {
                $data->update($request->all());
            } else {
                Config::create($request->all());
            }

            Alert::success('Configuração da Empresa', 'Atualizada com sucesso!');
        } catch (Exception $e) {
            Alert::error('Configuração da Empresa', $e->getMessage());
        }
        return redirect(route("dashboard.config.show"));
    }
}
