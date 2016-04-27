<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class MustHavePermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {

        if (Auth::check() && Auth::user()->hasPermission($permission)) {
            return $next($request);
        }

        Flash::error('You do not have permission to perform this action!');
        return redirect('/');

    }
}
