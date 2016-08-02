<?php

namespace App\Http\Controllers;

use Flash;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSinglePermissionRequest;

class PermissionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission_update');
    }

    /**
     * Get data for one permission as json
     *
     * @param string
     *
     * @return App\Models\Role;
     **/
    public function getPermission($permissionId)
    {
        // see if user has permission to view another user
        if (!hasPermission('permission_view', true)) return redirect('/');

        return Permission::find($permissionId);
    }

    /**
     * Update a single permission
     *
     * @param App\Http\Requests\UpdateSinglePermissionRequest
     * @param integer
     *
     * @return Void;
     **/
    public function updateSinglePermission(UpdateSinglePermissionRequest $request, $permissionId)
    {
        $permission = Permission::find($permissionId);

        if (is_null($permission)) {
            Flash::info(trans('hackerspacecrm.messages.models.notfound', ['modelname' => trans('hackerspacecrm.models.permission')]));
            
            return redirect('/');
        }

        $permission->setTranslation('label', getCurrentSessionAppLocale(), $request->input('label'));
        $permission->save();

        Flash::success(trans('hackerspacecrm.messages.models.update.success', ['modelname' => trans('hackerspacecrm.models.permission')]));

        return back();
    }

    /**
     * Show permissions form to update permissions
     *
     * @return View
     */
    public function showPermissionsForm()
    {
        $roles = crmRoles();
        $permissions = crmPermissions();

        return view('settings.users.permissions')
               ->with('roles', $roles)
               ->with('permissions', $permissions);
    }

    /**
     * TODO:
     * 2) Validate request
     *
     * Update Permissions
     *
     * @param App\Http\Requests\Request
     * @return void
     */
    public function update(Request $request)
    {
        $requestRoles = $request->input('roles');

        $roles = Role::all()->lists('name', 'id')->toArray();

        // If no permissions selected at all for any role
        // revoke all permissions to all roles
        if (is_null($requestRoles)) {
            foreach (array_keys($roles) as $key => $role) {
                $role = Role::find($role);
                if($role->name != 'administrator')
                    $role->revokeAllPermissions();
            }

            Flash::success(trans('hackerspacecrm.messages.models.update.success', ['modelname' => trans('hackerspacecrm.models.permissions')]));

            return back();
        }

        // If all permissions requested to be revoked from a role then the role
        // will not be present in the request, therefore we find out which roles
        // are not present with the $rolesDiff array and then revoke all permissions
        // for thoese roles.

        // find difference between existing roles in crm with the ones submitted
        $rolesDiff = array_diff(array_keys($roles), array_keys($requestRoles));

        foreach ($rolesDiff as $key => $role) {
            $role = Role::find($role);

            if (!is_null($role) && $role->name != 'administrator') {
                $role->revokeAllPermissions();
            }
        }

        // Sync permissions as requested
        foreach ($requestRoles as $role => $permissions) {
            $role = Role::find($role);

            if (!is_null($role) && $role->name != 'administrator') {
                $role->syncPermissions(array_keys($permissions));
            }
        }

        Flash::success(trans('hackerspacecrm.messages.models.update.success', ['modelname' => trans('hackerspacecrm.models.permissions')]));

        return back();
    }
}
