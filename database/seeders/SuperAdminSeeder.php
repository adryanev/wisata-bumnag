<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = User::factory()->state([
            'name' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('12345678'),
        ])->create();

        $role = Role::findByName('super-admin');
        $admin->roles()->detach();
        $admin->assignRole($role);
        $admin->addMedia(storage_path('User/Avatar.png'))->preservingOriginal()->toMediaCollection('Avatar');

        $admin = User::factory()->state([
            'name' => 'MFRozi',
            'email' => 'mfrozi@mail.com',
            'password' => Hash::make('12345678'),
        ])->create();
        $role = Role::findByName('admin');
        $admin->roles()->detach();
        $admin->assignRole($role);
        $admin->addMedia(storage_path('User/Avatar.png'))->preservingOriginal()->toMediaCollection('Avatar');

        $admin = User::factory()->state([
            'name' => 'Adryanev',
            'email' => 'adryanev@mail.com',
            'password' => Hash::make('12345678'),
        ])->create();
        $role = Role::findByName('admin');
        $admin->roles()->detach();
        $admin->assignRole($role);
        $admin->addMedia(storage_path('User/Avatar.png'))->preservingOriginal()->toMediaCollection('Avatar');
    }
}
