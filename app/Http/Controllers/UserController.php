<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::latest('updated_at')->get();

        return view('admin.users.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where('name', '<>', 'super-admin')->get();
        $roles = $role->mapWithKeys(function ($item, $key) {
            return [$item->id => $item->name];
        });
        $user = null;
        $userRole = null;
        return view('admin.users.create', compact('roles', 'user', 'userRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nik' => 'required|numeric|min:16',
            'password' => 'required|confirmed|min:8',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required',
            'avatar' => 'image' ,
        ]);

        $data = $request->except('avatar');
        $data['password'] = Hash::make(request('password'));

        $user = User::create($data);
        if ($request['avatar'] != null) {
            $user->addMedia($request['avatar'])->toMediaCollection('Avatar');
        } else {
            $user->addMedia(storage_path('User/Avatar.png'))->preservingOriginal()->toMediaCollection('Avatar');
        }
        $role = Role::find($data['role']);
        $user->roles()->detach();
        $user->assignRole($role);
        return back()->withSuccess('Success Create User');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $media = $user->getMedia('Avatar');
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.users.show', compact('user', 'latestMedia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = Role::where('name', '<>', 'super-admin')->get();
        $userRole = $user->roles()->first();
        $roles = $role->mapWithKeys(function ($item, $key) {
            return [$item->id => $item->name];
        });
        $media = $user->getMedia('Avatar');
        if (count($media) == 0) {
            $latestMedia = " ";
        } else {
            $latestMedia = str($media[count($media) - 1]->original_url);
        }
        return view('admin.users.edit', compact('user', 'roles', 'userRole', 'latestMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'nik' => 'required|numeric|min:16',
            'password' => 'confirmed|min:8|nullable',
            'email' => 'required',
            'phone_number' => 'required',
            'avatar' => 'image',
        ]);

        $user = User::findOrFail($id);

        $data = $request->except('password', 'avatar');

        if (request('password')) {
            $data['password'] = Hash::make(request('password'));
        }

        $user->update($data);
        if ($request['avatar'] != null) {
            $user->addMedia($request['avatar'])->toMediaCollection('Avatar');
        }
        $role = Role::find($data['role']);
        $user->roles()->detach();
        $user->assignRole($role);

        return redirect()->route(ADMIN . '.users.index')->withSuccess('Success Update '.$user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $userName = $user->name;
        $user->delete();

        return back()->withSuccess('Success Delete '.$userName);
    }
}
