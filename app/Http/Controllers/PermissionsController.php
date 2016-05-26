<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Role;
use HackerspaceCRM\Flasher\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('permission:permission_update');
    }

    public function show()
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
