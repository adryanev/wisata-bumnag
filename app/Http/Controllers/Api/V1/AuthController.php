<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        $decoded = base64_decode($request->password);

        $token = JWTAuth::attempt(['email' => $request->email, 'password' => $decoded]);
        if (!$token) {
            return response()->json([
                'message' => 'Invalid Email or Password',
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

        $decoded = base64_decode($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($decoded),
        ]);

        $role = Role::findByName('super-admin');
        $user->assignRole($role);

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
        $newToken = auth('api')->refresh(true, true);


        return response()->json(
            [
                'data' => [
                    'authorization' => [
                        'token' => $newToken
                    ]
                ]
            ]
        );
    }
}
