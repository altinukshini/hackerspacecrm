<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Flash;
use Illuminate\Http\Request;
use Validator;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    	$roles = Role::all();

    	return view('settings.users.roles', compact('roles'));
    }

    public function getUserRoles($username)
    {
    	if (!hasPermission('role_view', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
        	Flash::info('There was no user with username: '.$username);
        	return back();
        }

        return $user->getRoles();
    }

    public function update(Request $request, $username)
    {
        if (!hasPermission('role_update', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
        	Flash::info('There was no user with username: '.$username);
        	return back();
        }

        $validator = Validator::make($request->all(), [
			'roles' => 'exists:roles,name',
		]);

		if ($validator->fails()) {
			Flash::error('Roles could not be assigned to user: '.$username.'. Wrong input data sent.');
        	return back();
    	}

        $roles = $request->input('roles');

        $user->syncRoles(array_keys($roles));

        Flash::success('User roles updated successfully!');

        return back();
        
    }
}
