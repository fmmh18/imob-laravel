<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Config;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $config = Config::find(1);
        $carousels = Carousel::where('active', 1)->get();

        \View::share('config', $config);
        \View::share('carousels', $carousels);
    }
}
