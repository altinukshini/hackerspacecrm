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

if (!function_exists('getParentMenuSlugOptions')) {

    /**
     * Return slugs of Parent menus (not their children)
     *
     * @return array
     */
    function getParentMenus()
    {
        $slugs = App::make('HackerspaceCRM\Menu\Repository\MenuRepositoryInterface');
        return $slugs->getParents();
    }
}
