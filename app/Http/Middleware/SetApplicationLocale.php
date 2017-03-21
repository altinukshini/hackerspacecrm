<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

// use Illuminate\Routing\Redirector;
// use Illuminate\Foundation\Application;

class SetApplicationLocale
{
    /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   *
   * @return mixed
   */
    public function handle($request, Closure $next)
    {
        App::setLocale(Session::has('locale') ? Session::get('locale') : crminfo('locale'));

        return $next($request);
    }
}
