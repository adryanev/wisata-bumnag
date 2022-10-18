<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'data' => [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                ]
            ]
        ]);
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json([
            'data' => 'USER_CREATED'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(
            [
                'data' => 'USER_LOGGED_OUT'
            ]
        );
    }

    public function refresh()
    {
        return response()->json(
            [
                'data' => [
                    'authorization' => [
                        'token' => Auth::refresh()
                    ]
                ]
            ]
        );
    }
}
