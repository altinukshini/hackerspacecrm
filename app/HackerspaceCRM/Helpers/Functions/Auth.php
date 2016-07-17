<?php

if (!function_exists('hasPermission')) {

    /**
     * Return true or false if Auth user has given permission
     *
     * @return boolean
     */
    function hasPermission($permission = '', $flash = false)
    {
        if ($permission == '' || $permission == 'public' || $permission == 1) {
            return true;
        }

        if (!Auth::check() || !Auth::user()->hasPermission($permission)) {
            if ($flash)
                Flash::error(trans('hackerspacecrm.messages.nopermission'));
            return false;
        }
        
        return true;
    }
}

if (!function_exists('hasRole')) {

    /**
     * Return true or false if Auth user has given role
     *
     * @return boolean
     */
    function hasRole($role, $flash = false)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            if ($flash)
                Flash::error(trans('hackerspacecrm.messages.nopermission'));
            
            return false;
        }

        return true;
    }
}

if (!function_exists('crmPermissions')) {

    /**
     * Return array of all permissions
     *
     * @return array
     */
    function crmPermissions()
    {
        return App\Models\Permission::all();
    }
}

if (!function_exists('crmRoles')) {

    /**
     * Return array of all Roles
     *
     * @return array
     */
    function crmRoles()
    {
        return App\Models\Role::all();
    }
}