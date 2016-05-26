<?php

namespace App\Http\Controllers;

use App\Models\User;
use Flash;
use Validator;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
			dd('fails');
        	return back()
            	->withInput()
            	->withErrors($validator);
    	}

        $roles = $request->input('roles');

        $user->revokeAllRoles();

        foreach ($roles as $key => $value) {
        	$user->assignRoleByName($value);
        }

        Flash::success('User roles updated successfully!');

        return back();
        
    }
}
