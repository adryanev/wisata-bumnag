<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EnsureAccessTimeValid
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
        $access_time = $request->header('X-ACCESS-TIME');
        if (empty($access_time)) {
            return response()->json(['errors' => 'X-ACCESS-TIME not found'], 400);
        }
        $carbon_access_time = Carbon::createFromTimestamp($access_time);
        $now = now();

        if ($carbon_access_time->diffInMinutes($now) > 3) {
            return response()->json(['errors' => 'X-ACCESS-TIME expired'], 401);
        }
        return $next($request);
    }
}
