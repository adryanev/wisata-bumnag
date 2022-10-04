<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utils\PermissionConstants;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ===== ALL PERMISSION =====
        // PERMISSION Penilaian Kegiatan
        // Permission::create(['name' => PermissionConstants::EDIT_PENILAIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::DELETE_PENILAIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::CREATE_PENILAIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::READ_PENILAIAN_KEGIATAN]);

        // PERMISSION Pengisian Kegiatan
        // Permission::create(['name' => PermissionConstants::EDIT_ALL_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::EDIT_OWN_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::CREATE_ALL_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::CREATE_OWN_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::DELETE_ALL_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::DELETE_OWN_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::READ_ALL_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::READ_OWN_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::VALIDATE_PENGISIAN_KEGIATAN]);
        // Permission::create(['name' => PermissionConstants::COMMENT_PENGISIAN_KEGIATAN]);


        $role = Role::create(['name'=> 'admin']);
        $role->givePermissionTo([
            // PermissionConstants::EDIT_PENILAIAN_KEGIATAN,
            // PermissionConstants::DELETE_PENILAIAN_KEGIATAN,
            // PermissionConstants::CREATE_PENILAIAN_KEGIATAN,
            // PermissionConstants::READ_PENILAIAN_KEGIATAN,
            // PermissionConstants::EDIT_ALL_PENGISIAN_KEGIATAN,
            // PermissionConstants::CREATE_ALL_PENGISIAN_KEGIATAN,
            // PermissionConstants::DELETE_ALL_PENGISIAN_KEGIATAN,
            // PermissionConstants::READ_ALL_PENGISIAN_KEGIATAN,
            // PermissionConstants::VALIDATE_PENGISIAN_KEGIATAN,
            // PermissionConstants::COMMENT_PENGISIAN_KEGIATAN,
        ]);

        $role = Role::create(['name'=>'dosen']);
        $role->givePermissionTo([
            // PermissionConstants::EDIT_OWN_PENGISIAN_KEGIATAN,
            // PermissionConstants::CREATE_OWN_PENGISIAN_KEGIATAN,
            // PermissionConstants::DELETE_OWN_PENGISIAN_KEGIATAN,
            // PermissionConstants::READ_OWN_PENGISIAN_KEGIATAN,
        ]);

        // Give all Permission to superadmin;
        $role = Role::create(['name'=> 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $this->assignRoles();


    }

    public function assignRoles(){
        $superadmin = User::find(1);
        $superadmin->assignRole('super-admin');

    }
}
