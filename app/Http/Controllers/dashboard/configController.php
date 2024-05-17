<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\dashboardController;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        dd($request->all());
    }
}
