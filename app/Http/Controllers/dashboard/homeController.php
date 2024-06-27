<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\dashboardController;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends dashboardController
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

        $allProperties = Property::all();
        return view('dashboard.home', [
            'allProperties' => $allProperties
        ]);
    }
}
