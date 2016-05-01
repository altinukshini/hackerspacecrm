<?php

if (!function_exists('CRMSettings')) {

    /**
     * Returns application setting
     *
     * @return array
     * @return string
     */
    function CRMSettings($key)
    {
        static $settings;

        if(is_null($settings)) {
            $settings = Cache::remember('settings', 24*60, function() {
                return array_pluck(App\Models\Setting::all()->toArray(), 'value', 'key');
            });
        }

        return (is_array($key)) ? array_only($settings, $key) : $settings[$key];
    }
}