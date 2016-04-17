<?php

namespace App\Http\Controllers;

use App;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LocaleController extends Controller
{
    public function switchLocale($locale)
    {
        if (array_key_exists($locale, Config::get('app.locales'))) {
            if (Auth::check()) {
                $user = User::find(Auth::user()->id);
                $user->locale = $locale;
                $user->save();
            }
            App::setLocale($locale);
            Session::set('locale', $locale);
        }
        return back();
    }
}
