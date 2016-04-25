<?php

if (!function_exists('hasPermission')) {

    /**
     * Return true or false if Auth user has given permission
     *
     * @return boolean
     */
    function hasPermission($permission)
    {
        if (!Auth::check() || !Auth::user()->hasPermission($permission)) {
            flashMessage('You do not have permission to perform this action', 'danger', true);
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
    function hasRole($role)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            flashMessage('You do not have permission to perform this action', 'danger', true);
            return false;
        }

        return true;
    }
}