<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UpdateAvatarRequest;
use App\Http\Requests\Api\V1\UpdatePasswordRequest;
use App\Http\Requests\Api\V1\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{


    public function index()
    {
        return new ProfileResource(Auth::user());
    }
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $form = $request->all();
        $user->update($form);
        return new ProfileResource($user);
    }
    public function avatar(UpdateAvatarRequest $request)
    {
        $user = Auth::user();
        $user->addMedia($request['avatar'])->toMediaCollection('Avatar');
        return new ProfileResource($user);
    }
    public function password(UpdatePasswordRequest $request)
    {

        $user = Auth::user();
        $form = $request->all();
        $decodedOld = base64_decode($form['old_password']);
        //
        if (!Hash::check($decodedOld, $user->password)) {
            return response()->json([
                'errors' => [
                    'password' => ['Invalid Password'],
                ],
            ], 422);
        }
        $decodedNew = base64_decode($form['password']);
        $newPassword = Hash::make($decodedNew);
        $user->password = $newPassword;
        $user->update();

        return response()->json(['data' => 'PASSWORD_UPDATED']);
    }
}
