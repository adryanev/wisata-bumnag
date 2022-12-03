<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required',
            'nik' => 'required|numeric|min:16',
            'email' => 'required',
            'phone_number' => 'required',
            'avatar' => 'image|mimes:png,jpg,jpeg',
        ]);
        $user->update($data);

        if ($request->hasFile('avatar')) {
            $user->addMedia($request['avatar'])->toMediaCollection('Avatar');
        }
        return back()->withSuccess('Success Update Profile');
    }
    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
        $oldPassword = $data['old_password'];
        // dd()
        if (!Hash::check($oldPassword, $user->password)) {
            return back()->withErrors(['messages' => 'Old Password is Invalid']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);

        return back()->withSuccess('Update Password Success');
    }
}
