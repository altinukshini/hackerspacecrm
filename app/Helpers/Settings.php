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

if (!function_exists('crminfo')) {
    
    function crminfo( $show = '') 
    {
        switch( $show ) {
            case 'version':
                $output = Config::get('hackerspacecrm.version');
                break;
            case 'url':
                $output = CRMSettings('url');
                break;
            case 'admin_name':
                $output = Config::get('hackerspacecrm.admin_name');
                break;
            case 'admin_username':
                $output = Config::get('hackerspacecrm.admin_username');
                break;
            case 'admin_email':
                $output = Config::get('hackerspacecrm.admin_email');
                break;
            case 'locale':
                $output = CRMSettings('locale');
                break;
            case 'theme':
                $output = CRMSettings('theme');
                break;
            case 'enable_registration':
                $output = CRMSettings('enable_registration');
                break;
            case 'new_user_role':
                $output = CRMSettings('new_user_role');
                break;
            case 'supported_locales':
                $output = Config::get('hackerspacecrm.supported_locales');
                break;
            case 'description':
                $output = CRMSettings('crmdescription');
                break;
            case 'name':
            default:
                $output = CRMSettings('crmname');
                break;
        }
     
        return $output;
    }
}