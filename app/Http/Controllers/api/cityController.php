<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class cityController extends Controller
{

    public function cityByState(Request $request)
    {
        $data = City::where('state_id', $request->input('state_id'))->orderBy('name')->get();
        return response()->json($data);
    }
}
