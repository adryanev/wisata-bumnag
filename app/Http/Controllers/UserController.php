<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

        ]);

        $data = $request->all();
        $data['password'] = bcrypt(request('password'));

        $user = User::create($data);
        $role = Role::find($data['role']);
        $user->roles()->detach();
        $user->assignRole($role);
        return back()->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $role = Role::all();
        $userRole = $user->roles()->first();
        $roles = $role->mapWithKeys(function ($item, $key) {
            return [$item->id => $item->name];
        });
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
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
        ]);

        $user = User::findOrFail($id);

        $data = $request->except('password');

        if (request('password')) {
            $data['password'] = bcrypt(request('password'));
        }

        $user->update($data);

        $role = Role::find($data['role']);
        $user->roles()->detach();
        $user->assignRole($role);

        return redirect()->route(ADMIN . '.users.index')->withSuccess(trans('app.success_update'));
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
        $user->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
