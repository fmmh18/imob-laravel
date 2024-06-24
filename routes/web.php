<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\indexController::class, 'index'])->name('index');
Route::get('/imovel/listar', [\App\Http\Controllers\indexController::class, 'list'])->name('list');
Route::get('/imovel/{id}', [\App\Http\Controllers\indexController::class, 'detail'])->name('detail');
Route::get('/foto/{id}', [\App\Http\Controllers\indexController::class, 'primeiroArquivo'])->name('fotos');

route::get('/login', function () {
    return redirect(route('login'));
});
Route::group(['namespace' => 'dashboard', 'prefix' => 'dashboard'], function () {

    Route::get('/login', [\App\Http\Controllers\dashboard\loginController::class, 'index'])->name('login');
    Route::post('/login', [\App\Http\Controllers\dashboard\loginController::class, 'login'])->name('auth');
    Route::get('/logout', [\App\Http\Controllers\dashboard\loginController::class, 'logout'])->name('logout');
    Route::get('/ativar', [\App\Http\Controllers\dashboard\loginController::class, 'active'])->name('active');

    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/home', [\App\Http\Controllers\dashboard\homeController::class, 'index'])->name('dashboard.home');

        //ME
        Route::get('/meus-dados', [\App\Http\Controllers\dashboard\userController::class, 'showMe'])->name('dashboard.show-me');
        Route::put('/meus-dados', [\App\Http\Controllers\dashboard\userController::class, 'updateMe'])->name('dashboard.update-me');

        Route::group(['namespace' => 'Usuario', 'prefix' => 'usuario', 'module' => 'administration', 'modulename' => 'Administração'], function () {
            //USUARIO
            Route::get('/listar', array('as' => 'dashboard.user.index', 'uses' => '\App\Http\Controllers\dashboard\userController@index', 'nickname' => "Listar Usuários", "groupname" => "Usuário"));
            Route::get('/adicionar', array('as' => 'dashboard.user.create', 'uses' => '\App\Http\Controllers\dashboard\userController@create', 'nickname' => "Criar Usuário", "groupname" => "Usuário"));
            Route::post('/adicionar', array('as' => 'dashboard.user.store', 'uses' => '\App\Http\Controllers\dashboard\userController@store', 'nickname' => "Salvar Usuário", "groupname" => "Usuário"));
            Route::get('/editar/{id}', array('as' => 'dashboard.user.show', 'uses' => '\App\Http\Controllers\dashboard\userController@show', 'nickname' => "Visualizar Usuário", "groupname" => "Usuário"));
            Route::put('/editar/{id}', array('as' => 'dashboard.user.update', 'uses' => '\App\Http\Controllers\dashboard\userController@update', 'nickname' => "Editar Usuário", "groupname" => "Usuário"));
            Route::get('/deletar/{id}', array('as' => 'dashboard.user.delete', 'uses' => '\App\Http\Controllers\dashboard\userController@destroy', 'nickname' => "Deletar Usuário", "groupname" => "Usuário"));
        });

        Route::group(['namespace' => 'Imagem', 'prefix' => 'imagem', 'module' => 'administration', 'modulename' => 'Administração'], function () {
            //USUARIO
            Route::get('/listar', array('as' => 'dashboard.carousel.index', 'uses' => '\App\Http\Controllers\dashboard\carouselController@index', 'nickname' => "Listar Imagens", "groupname" => "Imagem"));
            Route::get('/adicionar', array('as' => 'dashboard.carousel.create', 'uses' => '\App\Http\Controllers\dashboard\carouselController@create', 'nickname' => "Criar Imagem", "groupname" => "Imagem"));
            Route::post('/adicionar', array('as' => 'dashboard.carousel.store', 'uses' => '\App\Http\Controllers\dashboard\carouselController@store', 'nickname' => "Salvar Imagem", "groupname" => "Imagem"));
            Route::get('/editar/{id}', array('as' => 'dashboard.carousel.show', 'uses' => '\App\Http\Controllers\dashboard\carouselController@show', 'nickname' => "Visualizar Imagem", "groupname" => "Imagem"));
            Route::put('/editar/{id}', array('as' => 'dashboard.carousel.update', 'uses' => '\App\Http\Controllers\dashboard\carouselController@update', 'nickname' => "Editar Imagem", "groupname" => "Imagem"));
            Route::get('/deletar/{id}', array('as' => 'dashboard.carousel.delete', 'uses' => '\App\Http\Controllers\dashboard\carouselController@destroy', 'nickname' => "Deletar Imagem", "groupname" => "Imagem"));
        });

        Route::group(['namespace' => 'Estado', 'prefix' => 'estado', 'module' => 'administration', 'modulename' => 'Administração'], function () {
            //USUARIO
            Route::get('/listar', array('as' => 'dashboard.state.index', 'uses' => '\App\Http\Controllers\dashboard\stateController@index', 'nickname' => "Listar Estados", "groupname" => "Estado"));
            Route::get('/adicionar', array('as' => 'dashboard.state.create', 'uses' => '\App\Http\Controllers\dashboard\stateController@create', 'nickname' => "Criar Estado", "groupname" => "Estado"));
            Route::post('/adicionar', array('as' => 'dashboard.state.store', 'uses' => '\App\Http\Controllers\dashboard\stateController@store', 'nickname' => "Salvar Estado", "groupname" => "Estado"));
            Route::get('/editar/{id}', array('as' => 'dashboard.state.show', 'uses' => '\App\Http\Controllers\dashboard\stateController@show', 'nickname' => "Visualizar Estado", "groupname" => "Estado"));
            Route::put('/editar/{id}', array('as' => 'dashboard.state.update', 'uses' => '\App\Http\Controllers\dashboard\stateController@update', 'nickname' => "Editar Estado", "groupname" => "Estado"));
            Route::get('/deletar/{id}', array('as' => 'dashboard.state.delete', 'uses' => '\App\Http\Controllers\dashboard\stateController@destroy', 'nickname' => "Deletar Estado", "groupname" => "Estado"));
        });

        Route::group(['namespace' => 'configuracao', 'prefix' => 'configuracao', 'module' => 'administration', 'modulename' => 'Administração'], function () {
            //USUARIO
            Route::get('/listar', array('as' => 'dashboard.city.index', 'uses' => '\App\Http\Controllers\dashboard\cityController@index', 'nickname' => "Listar Configuração", "groupname" => "Configuração"));
            Route::get('/adicionar', array('as' => 'dashboard.city.create', 'uses' => '\App\Http\Controllers\dashboard\cityController@create', 'nickname' => "Criar Configuração", "groupname" => "Configuração"));
            Route::post('/adicionar', array('as' => 'dashboard.city.store', 'uses' => '\App\Http\Controllers\dashboard\cityController@store', 'nickname' => "Salvar Configuração", "groupname" => "Configuração"));
            Route::get('/editar/{id}', array('as' => 'dashboard.city.show', 'uses' => '\App\Http\Controllers\dashboard\cityController@show', 'nickname' => "Visualizar Configuração", "groupname" => "Configuração"));
            Route::put('/editar/{id}', array('as' => 'dashboard.city.update', 'uses' => '\App\Http\Controllers\dashboard\cityController@update', 'nickname' => "Editar Configuração", "groupname" => "Configuração"));
            Route::get('/deletar/{id}', array('as' => 'dashboard.city.delete', 'uses' => '\App\Http\Controllers\dashboard\cityController@destroy', 'nickname' => "Deletar Configuração", "groupname" => "Configuração"));
        });

        Route::group(['namespace' => 'configuracao', 'prefix' => 'configuracao', 'module' => 'administration', 'modulename' => 'Administração'], function () {
            //USUARIO
            Route::get('/configuracao', array('as' => 'dashboard.config.show', 'uses' => '\App\Http\Controllers\dashboard\configController@show', 'nickname' => "Criar Configuração", "groupname" => "Configuração"));
            Route::post('/configuracao', array('as' => 'dashboard.config.store', 'uses' => '\App\Http\Controllers\dashboard\configController@store', 'nickname' => "Salvar Configuração", "groupname" => "Configuração"));
        });



        Route::group(['namespace' => 'Tipo de Imóvel', 'prefix' => 'tipo-de-imovel', 'module' => 'administration', 'modulename' => 'Imovel'], function () {
            //USUARIO
            Route::get('/listar', array('as' => 'dashboard.type.index', 'uses' => '\App\Http\Controllers\dashboard\typeController@index', 'nickname' => "Listar Tipo de Imóveis", "groupname" => "Tipo de Imovel"));
            Route::get('/adicionar', array('as' => 'dashboard.type.create', 'uses' => '\App\Http\Controllers\dashboard\typeController@create', 'nickname' => "Criar Tipo de Imóvel", "groupname" => "Tipo de Imovel"));
            Route::post('/adicionar', array('as' => 'dashboard.type.store', 'uses' => '\App\Http\Controllers\dashboard\typeController@store', 'nickname' => "Salvar Tipo de Imóvel", "groupname" => "Tipo de Imovel"));
            Route::get('/editar/{id}', array('as' => 'dashboard.type.show', 'uses' => '\App\Http\Controllers\dashboard\typeController@show', 'nickname' => "Visualizar Tipo de Imóvel", "groupname" => "Tipo de Imovel"));
            Route::put('/editar/{id}', array('as' => 'dashboard.type.update', 'uses' => '\App\Http\Controllers\dashboard\typeController@update', 'nickname' => "Editar Tipo de Imóvel", "groupname" => "Tipo de Imovel"));
            Route::get('/deletar/{id}', array('as' => 'dashboard.type.delete', 'uses' => '\App\Http\Controllers\dashboard\typeController@destroy', 'nickname' => "Deletar Tipo de Imóvel", "groupname" => "Tipo de Imovel"));
        });

        Route::group(['namespace' => 'Característica do Imóvel', 'prefix' => 'caracteristica-do-imovel', 'module' => 'administration', 'modulename' => 'Imovel'], function () {
            //USUARIO
            Route::get('/listar', array('as' => 'dashboard.feature.index', 'uses' => '\App\Http\Controllers\dashboard\featureController@index', 'nickname' => "Listar Características do Imóveis", "groupname" => "Característica do Imóvel"));
            Route::get('/adicionar', array('as' => 'dashboard.feature.create', 'uses' => '\App\Http\Controllers\dashboard\featureController@create', 'nickname' => "Criar Característica do Imóvel", "groupname" => "Característica do Imóvel"));
            Route::post('/adicionar', array('as' => 'dashboard.feature.store', 'uses' => '\App\Http\Controllers\dashboard\featureController@store', 'nickname' => "Salvar Característica do Imóvel", "groupname" => "Característica do Imóvel"));
            Route::get('/editar/{id}', array('as' => 'dashboard.feature.show', 'uses' => '\App\Http\Controllers\dashboard\featureController@show', 'nickname' => "Visualizar Característica do Imóvel", "groupname" => "Característica do Imóvel"));
            Route::put('/editar/{id}', array('as' => 'dashboard.feature.update', 'uses' => '\App\Http\Controllers\dashboard\featureController@update', 'nickname' => "Editar Característica do Imóvel", "groupname" => "Característica do Imóvel"));
            Route::get('/deletar/{id}', array('as' => 'dashboard.feature.delete', 'uses' => '\App\Http\Controllers\dashboard\featureController@destroy', 'nickname' => "Deletar Característica do Imóvel", "groupname" => "Característica do Imóvel"));
        });

        Route::group(['namespace' => 'Imóvel', 'prefix' => 'imovel', 'module' => 'administration', 'modulename' => 'Imovel'], function () {
            //USUARIO
            Route::get('/listar', array('as' => 'dashboard.property.index', 'uses' => '\App\Http\Controllers\dashboard\propertyController@index', 'nickname' => "Imóveis", "groupname" => "Imóvel"));
            Route::get('/adicionar', array('as' => 'dashboard.property.create', 'uses' => '\App\Http\Controllers\dashboard\propertyController@create', 'nickname' => "Criar Imóvel", "groupname" => "Imóvel"));
            Route::post('/adicionar', array('as' => 'dashboard.property.store', 'uses' => '\App\Http\Controllers\dashboard\propertyController@store', 'nickname' => "Salvar Imóvel", "groupname" => "Imóvel"));
            Route::get('/editar/{id}', array('as' => 'dashboard.property.show', 'uses' => '\App\Http\Controllers\dashboard\propertyController@show', 'nickname' => "Visualizar Imóvel", "groupname" => "Imóvel"));
            Route::put('/editar/{id}', array('as' => 'dashboard.property.update', 'uses' => '\App\Http\Controllers\dashboard\propertyController@update', 'nickname' => "Editar Imóvel", "groupname" => "Imóvel"));
            Route::get('/deletar/{id}', array('as' => 'dashboard.property.delete', 'uses' => '\App\Http\Controllers\dashboard\propertyController@destroy', 'nickname' => "Deletar Imóvel", "groupname" => "Imóvel"));
        });
    });
});
