<?php

if (!function_exists('CRMSettings')) {

    /**
     * Returns application setting.
     *
     * @return array
     * @return string
     */
    function CRMSettings($key = null)
    {
        static $settings;

        if (is_null($settings)) {
            $settingsAll = App::make('HackerspaceCRM\Setting\Repository\SettingRepositoryInterface');
            $settings = $settingsAll->getAll()->lists('value', 'key')->toArray();
        }

        return is_null($key) ? $settings : ((is_array($key)) ? array_only($settings, $key) : $settings[$key]);
    }
}

if (!function_exists('crminfo')) {

    /**
     * Returns application config and settings.
     *
     * @return string
     * @return array
     */
    function crminfo($show = 'crmname')
    {
        switch ($show) {
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
            case 'menu_groups':
                $output = Config::get('hackerspacecrm.menu_groups');
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
            case 'footer':
                $output = CRMSettings('crmfooter');
                break;
            case 'name':
                $output = CRMSettings('crmname');
                break;
            default:
                $output = CRMSettings($show);
                break;
        }

        return $output;
    }
}
