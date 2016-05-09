<?php

if (!function_exists('setMenuActive')) {

    /**
     * Returns active class or other
     *
     * @return string
     */
    function setMenuActive($path, $active = 'active')
    {

        if (Request::is($path . '/*') || Request::is($path)) {
            return $active;
        }

        return '';
    }
}