<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Flash;
use Illuminate\Http\Request;
use Validator;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role_view');
    }

    /**
     * Show all roles in /roles
     *
     * @return View;
     **/
    public function show()
    {
    	$roles = Role::all();

    	return view('settings.users.roles', compact('roles'));
    }

    /**
     * Get user roles as json
     *
     * @param string
     * @return array;
     **/
    public function getUserRoles($username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
        	Flash::info('There is no user with username: '.$username);
        	return back();
        }

        return $user->getRoles();
    }

    /**
     * Update Roles for a given user
     *
     * @param App\Http\Requests\Request
     * @param string
     *
     * @return Void;
     **/
    public function update(Request $request, $username)
    {
        if (!hasPermission('role_update', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
        	Flash::info('There is no user with username: '.$username);
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

        // If no roles sent in request, revoke all roles
        if (is_null($roles)) {
            $user->revokeAllRoles();

            Flash::success('User roles updated successfully!');
            return back();
        }

        // else, sync roles with the new ones
        $user->syncRoles(array_keys($roles));

        Flash::success('User roles updated successfully!');

        return back();
        
    }
}
