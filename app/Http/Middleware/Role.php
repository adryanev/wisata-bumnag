<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Not Logged
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Allowed
        $role = explode('|', $role);
        // dd($role, $request, $next);
        foreach ($role as $roles) {
            // dd(Auth::user()->hasRole($roles));
            if (Auth::user()->hasRole($roles)) {
                return $next($request);
            }
        }
        // Not Allowed
        return abort(404);
    }
}
