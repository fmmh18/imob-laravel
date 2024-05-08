<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Module;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where('cpf', '00795531176')->first();

        if (empty($user->id)) {
            User::create([
                'name' => 'Flavio Hayashida',
                'email' => 'fhayashida@afdsolution.tec.br',
                'password' => 'jhmcma130902',
                'phone' => '65993071243',
                'cpf' => '00795531176',
                'date_birth' => '1986-07-19',
                'is_manager' => 1,
                'status' => 1,
                'role_id' => 1
            ]);
        }



        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            if (
                $route->getName() != 'sanctum.csrf-cookie' &&
                $route->getName() != 'ignition.healthCheck' &&
                $route->getName() != 'ignition.executeSolution' &&
                $route->getName() != 'ignition.updateConfig' &&
                $route->getName() != 'login' &&
                $route->getName() != 'auth' &&
                $route->getName() != 'logout' &&
                $route->getName() != 'active' &&
                $route->getName() != 'dashboard.home' &&
                $route->getName() != 'dashboard.show-me' &&
                $route->getName() != 'dashboard.update-me' &&
                $route->getName() != 'dashboard.home.setSite' &&
                $route->getName() != 'dashboard.home.setCompany' &&
                $route->getName() != 'api.cityByState' &&
                $route->getName() != 'api.listar.fotos' &&
                $route->getName() != 'api.excluir.foto' &&
                $route->getName() != 'index' &&
                $route->getName() != 'fotos' &&
                $route->getName() != 'detail' &&
                $route->getName() != 'list' &&
                $route->getName() != ''
            ) {
                $module = Module::where('title', $route->getAction('module'))->get();
                if (count($module) == 0) {
                    $moduleId = Module::create(array(
                        'title' => $route->getAction('module'),
                        'description' => $route->getAction('modulename')
                    ))->id;
                    $permission = Permission::where('route', $route->getName())->get();
                    if (count($permission) == 0) {
                        $permissionId = Permission::create(array(
                            'description' =>  $route->getAction('nickname'),
                            'route'       => $route->getAction('as'),
                            'group'       => $route->getAction('groupname')
                        ))->id;
                        DB::table('permission_roles')->insert(array(
                            'permission_id' => $permissionId,
                            'role_id'       => 1,
                        ));
                        DB::table('module_roles')->insert(array(
                            'module_id' => $moduleId,
                            'role_id'       => 1,
                        ));
                    }
                } else {

                    $permission = Permission::where('route', $route->getName())->get();
                    if (count($permission) == 0) {
                        $permissionId = Permission::create(array(
                            'description' =>  $route->getAction('nickname'),
                            'route'       => $route->getAction('as'),
                            'group'       => $route->getAction('groupname')
                        ))->id;

                        DB::table('permission_roles')->insert(array(

                            'permission_id' => $permissionId,
                            'role_id'       => 1,
                        ));

                        DB::table('module_roles')->insert(array(
                            'module_id' => $module[0]->id,
                            'role_id'       => 1,
                        ));
                    }
                }
            }
        }

        $states = DB::table('states')->first();

        if (empty($states)) {
            $states    = file_get_contents("database/seeders/files/states.json");

            DB::table('states')->insert(json_decode($states, true));
        }

        $cities = DB::table('cities')->first();

        if (empty($cities)) {
            $cities    = file_get_contents("database/seeders/files/cities.json");

            DB::table('cities')->insert(json_decode($cities, true));
        }
    }
}
