<?php

namespace App\Http\Controllers;

use App;
use Config;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class LocaleController extends Controller
{

    /*
     * Change application locale and set session locale and change user
     * default locale to the given locale in parameter
     *
     * @param locale (string)
     * @return void
     */
    public function switchLocale($locale)
    {
        $this->guardLocale($locale);
        
        if (array_key_exists($locale, crminfo('supported_locales'))) {
            $this->changeAuthedUserLocale($locale);
            App::setLocale($locale);
            Session::set('locale', $locale);
        }

        return back();
    }
    
    /*
     * Change user default locale to the given locale in parameter
     *
     * @param locale (string)
     * @return void
     */
    private function changeAuthedUserLocale($locale){
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            $user->setDefaultLocale($locale);
        }
    }

    /**
     * @param mixed $locale
     */
    public function guardLocale($locale)
    {
        if(empty($locale))
            throw new InvalidArgumentException('Locale should not be empty');
    }
}
