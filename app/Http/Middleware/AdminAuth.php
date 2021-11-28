<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admins')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorizeds.', 401);
            } else {
                return redirect()->guest('/administrator/login');
            }
        }

   /*     if (!Auth::guard($guard)->check()) {
            return redirect('/login');
        }*/
        return $next($request);
    }
}
?>