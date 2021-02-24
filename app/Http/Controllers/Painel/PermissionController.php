<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    private Permission $permission;

    public function __construct(Permission $permission){
        $this->permission = $permission;

        if(Gate::denies('manage_permissions_and_roles'))
            return abort(403, 'Permission denied');
    }

    public function index(){
        $permissions = $this->permission->all();

        return view('painel.permissions.index', compact('permissions'));
    }

    public function roles($id){
        $permission = $this->permission->find($id);
        $roles = $permission->roles;

        return view('painel.permissions.roles', compact('permission', 'roles'));
    }
}
