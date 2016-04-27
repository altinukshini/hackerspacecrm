<?php

if (!function_exists('hasPermission')) {

    /**
     * Return true or false if Auth user has given permission
     *
     * @return boolean
     */
    function hasPermission($permission, $flash = false)
    {
        if (!Auth::check() || !Auth::user()->hasPermission($permission)) {
            if ($flash)
                Flash::error('You do not have permission to perform this action');
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
                Flash::error('You do not have permission to perform this action');
            
            return false;
        }

        return true;
    }
}