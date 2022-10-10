<?php

namespace App\Http\Middleware;

use App\Models\Application;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnsureApplicationTokenValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-KEY');
        if (empty($token)) {
            return response('Unauthorized', 401);
        }
        $check = Application::where(['token' => $token])->first();
        if (empty($check)) {
            return response('Unauthorized', 401);
        }
        return $next($request);
    }
}
