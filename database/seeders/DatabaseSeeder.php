<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Website;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Website::create([
            'website_name'      => 'Starter Template',
            'website_logo'      => '/website-logo/logo.jpg',
            'meta_description'  => 'Ini adalah starter template untuk pengembangan aplikasi berbasis website dengan cepat. Didukung teknologi Laravel dan MySql sebagai database'
        ]);

        $administratorRole  = Role::create(['name'   => 'administrator']);
        $userRole           = Role::create(['name'   => 'user']);

        // Permission for user page
        $listUser = Permission::create([
            'category'  => 'User',
            'name'      => 'list user'
        ]);
        $createUser = Permission::create([
            'category'  => 'User',
            'name'      => 'create user'
        ]);
        $editUser = Permission::create([
            'category'  => 'User',
            'name'      => 'edit user'
        ]);
        $deleteUser  = Permission::create([
            'category'  => 'User',
            'name'      => 'delete user'
        ]);

        // Peermission for role page
        $listRole = Permission::create([
            'category'  => 'Role',
            'name'      => 'list role'
        ]);
        $createRole = Permission::create([
            'category'  => 'Role',
            'name'      => 'create role'
        ]);
        $editRole = Permission::create([
            'category'  => 'Role',
            'name'      => 'edit role'
        ]);
        $deleteRole  = Permission::create([
            'category'  => 'Role',
            'name'      => 'delete role'
        ]);

        // Peermission for permissions page
        $listPermission = Permission::create([
            'category'  => 'Permission',
            'name'      => 'list permission'
        ]);
        $createPermission = Permission::create([
            'category'  => 'Permission',
            'name'      => 'create permission'
        ]);
        $editPermission = Permission::create([
            'category'  => 'Permission',
            'name'      => 'edit permission'
        ]);
        $deletePermission  = Permission::create([
            'category'  => 'Permission',
            'name'      => 'delete permission'
        ]);

        // Peermission for setting application/website page
        $editInfoApp = Permission::create([
            'category'  => 'Setting App',
            'name'      => 'edit info app'
        ]);

        $administratorRole->givePermissionTo([
            $listUser,
            $createUser,
            $editUser,
            $deleteUser
        ]);
        $administratorRole->givePermissionTo([
            $listRole,
            $createRole,
            $editRole,
            $deleteRole
        ]);
        $administratorRole->givePermissionTo([
            $listPermission,
            $createPermission,
            $editPermission,
            $deletePermission
        ]);
        $administratorRole->givePermissionTo([
            $editInfoApp,
        ]);


        $administrator = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
        ]);
        $user = User::create([
            'name'      => 'User',
            'email'     => 'user@example.com',
            'password'  => bcrypt('password'),
        ]);

        $administrator->assignRole($administratorRole);
        $user->assignRole($userRole);
    }
}
