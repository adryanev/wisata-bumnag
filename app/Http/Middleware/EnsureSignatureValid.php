<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EnsureSignatureValid
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
        $api_key = $request->header('X-API-KEY');
        $access_time = $request->header('X-ACCESS-TIME');
        $salt = env('REQUEST_SALT', '');
        $client_signature = $request->header('X-REQUEST-SIGNATURE');
        if (empty($client_signature)) {
            return response()->json(['errors' => 'X-REQUEST-SIGNATURE not found'], 400);
        }

        $server_signature = hash('sha256', $salt . $access_time . $api_key);
        if (strcmp($client_signature, $server_signature) !== 0) {
            return response()->json(['errors' => 'Invalid Signature'], 401);
        }

        return $next($request);
    }
}
