<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class MustHaveRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        Flash::error(trans('hackerspacecrm.messages.nopermission'));
        return redirect('/');

    }
}
