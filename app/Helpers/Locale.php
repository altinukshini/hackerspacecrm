<?php

if (!function_exists('getAvailableAppLocaleArray')) {

    /**
     * Returns an array of all available locales.
     *
     * @return array
     */
    function getAvailableAppLocaleArray()
    {
        foreach (Config::get('app.locales') as $key => $value) {
            $locales[$key] = $value;
        }

        return $locales;
    }
}

if (!function_exists('getCurrentSessionAppLocale')) {
    /**
     * Returns session localean.
     *
     * @return string
     */
    function getCurrentSessionAppLocale()
    {
        return Session::has('locale') ? Session::get('locale') : Config::get('app.locale');
    }
}

if (!function_exists('getCurrentSessionAppLocale')) {
    /**
     * Returns default application locale.
     *
     * @return string
     */
    function getDefaultAppLocale()
    {
        return Config::get('app.locale');
    }
}