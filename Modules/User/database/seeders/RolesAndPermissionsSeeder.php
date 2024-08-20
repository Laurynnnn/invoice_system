<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define Permissions
        $permissions = [
            'view users',
            'manage users',
            'assign roles',
            'assign permissions',
            'manage system settings',
        
        ];

        // Create Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define Roles and their Permissions
        $roles = [
            'admin' => [
                'view users',
                'manage users',
                'assign roles',
                'assign permissions',
                'manage system settings',
            ],
        ];

        // Create Roles and Assign Permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
