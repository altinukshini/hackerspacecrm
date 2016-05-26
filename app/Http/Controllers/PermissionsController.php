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
        // dd($request->input('roles'));

        $roles = $request->input('roles');

        foreach ($roles as $role => $permissions) {
            $role = Role::whereName($role)->first();

            $role->syncPermissions(array_keys($permissions));
        }

        return back();
    }
}
