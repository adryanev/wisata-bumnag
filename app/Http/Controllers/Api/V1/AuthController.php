<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{


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
        $data = $request->all();
        $user->device_token = $data['fcm_token'];
        $user->save();


        $media =
            $user->getMedia('Avatar')->map(function ($value) {
                return $value->getUrl();
            });
        $avatar = $media->first();
        return new LoginResource($user, $token, $avatar);
    }

    public function register(RegisterRequest $request)
    {

        $decoded = base64_decode($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($decoded),
        ]);

        $role = Role::findByName('user');
        $user->assignRole($role);

        $user->addMedia(storage_path('User/Avatar.png'))->preservingOriginal()->toMediaCollection('Avatar');

        return response()->json([
            'data' => 'USER_CREATED',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(
            [
                'data' => 'USER_LOGGED_OUT',
            ]
        );
    }

    public function fcm(Request $request)
    {
        $user =
            Auth::user();
        $token = $request->all();
        $user->device_token = $token['fcm_token'];
        $user->save();
        return response()->json([
            'data' => 'FCM_UPDATED',
        ]);
    }

    public function refresh()
    {
        $newToken = auth('api')->refresh(true, true);


        return response()->json(
            [
                'data' => [
                    'authorization' => [
                        'token' => $newToken,
                    ],
                ],
            ]
        );
    }
}
