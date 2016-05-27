<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission_update');
    }

    public function showPermissionsForm()
    {
        $roles = crmRoles();
        $permissions = crmPermissions();

        return view('settings.users.permissions')
               ->with('roles', $roles)
               ->with('permissions', $permissions);
    }

    public function update(Request $request)
    {
        $requestRoles = $request->input('roles');

        $roles = Role::all()->lists('name', 'id')->toArray();

        $rolesDiff = array_diff(array_keys($roles), array_keys($requestRoles));

        foreach ($rolesDiff as $key => $role) {
            $role = Role::find($role);

            if (!is_null($role)) {
                $role->revokeAllPermissions();
            }
        }

        foreach ($requestRoles as $role => $permissions) {
            $role = Role::find($role);

            if (!is_null($role)) {
                $role->syncPermissions(array_keys($permissions));
            }
        }

        return back();
    }
}
