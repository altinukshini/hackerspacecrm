<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
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
     * Get data for one role as json
     *
     * @param string
     * @return App\Models\Role;
     **/
    public function getRole($roleId)
    {
        // see if user has permission to view another user
        if (!hasPermission('role_view', true)) return redirect('/');

        return Role::find($roleId);
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
    public function updateUserRoles(Request $request, $username)
    {
        if (!hasPermission('role_update', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        // Check if user exists
        if (is_null($user)) {
        	Flash::info('There is no user with username: '.$username);
        	return back();
        }

        // Check if trying to change CRM Administrator's roles
        if ($user->username != crminfo('admin_username')){
            Flash::info('You can not edit CRM Administrator roles');
            return back();
        }

        // Validate request
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

        // else, sync roles with the new ones
        } else {
            $user->syncRoles(array_keys($roles));
        }

        Flash::success('User roles updated successfully!');

        return back();
        
    }

    public function update(UpdateRoleRequest $request, $roleId)
    {
        $role = Role::find($roleId);

        if (is_null($role)) {
            Flash::info('No role with id: '.$roleId);
            return redirect('/');
        }

        $role->label = $request->input('label');
        $role->save();

        Flash::success('Role updated successfully!');
        return back();
    }


    public function delete($roleId)
    {
        if (!hasPermission('role_delete')) return redirect('/');

        $role = Role::find($roleId);

        if (is_null($role)) {
            Flash::warning('No role with id '.$roleId.' exists.');
            return back();
        }

        if ($role->name == 'administrator') {
            Flash::warning('You can not delete the administrator role');
            return back();
        }

        $role->delete();

        Flash::success('Role was deleted successfully');

        return back();

    }

    public function create(CreateRoleRequest $request)
    {
        Role::create($request->all());

        Flash::success('Role created succesfully');

        return back();
    }
}
