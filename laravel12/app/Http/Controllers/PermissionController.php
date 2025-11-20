<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public static function loadPermissions($turno) {
        $arr_permissions = Array();
        
        // Mapear turno para role_id
        $turnoToRoleId = [
            'gerente' => 1,
            'entrada' => 2,
            'saida' => 3
        ];
        
        $role_id = $turnoToRoleId[$turno] ?? 1;
        
        $perm = Permission::with(['resource'])
            ->where('role_id', $role_id)->get();

        foreach($perm as $item) {
            $arr_permissions[$item->resource->name] = (boolean) $item->permission;
        }
        
        session(['user_permissions' => $arr_permissions]);
    }

    public static function isAuthorized($resource) {
        $permissions = session('user_permissions');
        if(isset($permissions) && array_key_exists($resource, $permissions)) {
            return $permissions[$resource];
        }
        return false;
    }
}