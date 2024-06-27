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

        $allProperties = Property::orderBy('created_at', 'desc');
        if (Auth::user()->is_manager == 0) {
            $allProperties = $allProperties->where('user_id', Auth::user()->id);
        }
        $allProperties = $allProperties->get();
        return view('dashboard.home', [
            'allProperties' => $allProperties
        ]);
    }
}
