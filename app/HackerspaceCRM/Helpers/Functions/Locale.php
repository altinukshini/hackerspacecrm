<?php

if (!function_exists('getAvailableAppLocaleArrayKeys')) {

    /**
     * Returns an array of all available locales.
     *
     * @return array
     */
    function getAvailableAppLocaleArrayKeys()
    {
        foreach (crminfo('supported_locales') as $key => $value) {
            $locales[] = $key;
        }

        return $locales;
    }
}

if (!function_exists('getAvailableAppLocaleArray')) {

    /**
     * Returns an array of all available locales.
     *
     * @return array
     */
    function getAvailableAppLocaleArray()
    {
        foreach (crminfo('supported_locales') as $key => $value) {
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
        return Session::has('locale') ? Session::get('locale') : crminfo('locale');
    }
}

if (!function_exists('getDefaultAppLocale')) {
    /**
     * Returns default application locale.
     *
     * @return string
     */
    function getDefaultAppLocale()
    {
        return crminfo('locale');
    }
}