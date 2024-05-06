<?php

namespace App\Http\Controllers;

use App\Traits\RouteTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class dashboardController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, RouteTrait;
    public function __construct($user, $request)
    {
        //Criando a rota sempre apartir da rota WEB
        $this->addRoute();
        $menus =  [];
        if ($request->session()->get('company_id') && $user->is_manager != 1) {
            $permissions = $user->roles()->where('company_id', $request->session()->get('company_id'))->where('user_id', $user->id)->get();

            //dd($permissions);
            foreach ($permissions as $key => $value) {
                $menus = [
                    $key => $value
                ];
            }
        }
        View::share('menus', $menus);
    }
}
