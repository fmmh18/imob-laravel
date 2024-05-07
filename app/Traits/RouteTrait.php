<?php

namespace App\Traits;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as FacadesRoute;

trait RouteTrait
{

    public function addRoute()
    {


        $routes = FacadesRoute::getRoutes();

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
                $route->getName() != 'detail' &&
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
    }
}
