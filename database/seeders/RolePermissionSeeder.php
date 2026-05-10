<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage all',
            'manage home',
            'manage profile',
            'manage gallery',
            'manage articles',
            'manage contacts',
            'manage users',
            'manage settings',
            'manage studio',
            'manage apparel',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminQofmedia = Role::create(['name' => 'admin_qofmedia']);
        $adminStudio = Role::create(['name' => 'admin_studio']);
        $adminApparel = Role::create(['name' => 'admin_apparel']);
        $user = Role::create(['name' => 'user']);

        // Assign permissions
        $adminQofmedia->givePermissionTo([
            'manage all',
            'manage home',
            'manage profile',
            'manage gallery',
            'manage articles',
            'manage contacts',
            'manage users',
            'manage settings',
        ]);

        $adminStudio->givePermissionTo(['manage studio']);
        $adminApparel->givePermissionTo(['manage apparel']);
    }
}