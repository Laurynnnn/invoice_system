<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define Permissions by Category
        $permissionsByCategory = [
            'User Management' => [
                'manage users',
                'assign roles',
                'assign permissions',
            ],
            'System Settings' => [
                'manage system settings',
            ],
            'Client Management' => [
                'view clients',
                'create clients',
                'update clients',
                'delete clients',
            ],
            'Invoice Management' => [
                'view invoices',
                'create invoices',
                'update invoices',
                'delete invoices',
            ],
            'Reporting' => [
                'view reports',
                'generate reports',
            ],
        ];

        DB::transaction(function() use ($permissionsByCategory) {
            // Create Permissions and associate them with Categories
            foreach ($permissionsByCategory as $categoryName => $permissions) {
                // Check if category exists and get the ID
                $categoryId = DB::table('permission_categories')->where('name', $categoryName)->value('id');

                // If category doesn't exist, skip creating permissions for it
                if ($categoryId) {
                    foreach ($permissions as $permission) {
                        Permission::firstOrCreate([
                            'name' => $permission,
                            'category_id' => $categoryId,
                        ]);
                    }
                }
            }
        });

        // Define Roles and their Permissions
        $roles = [
            'Admin' => [
                'manage users',
                'assign roles',
                'assign permissions',
                'manage system settings',
                'view clients',
                'create clients',
                'update clients',
                'delete clients',
                'view invoices',
                'create invoices',
                'update invoices',
                'delete invoices',
                'view reports',
                'generate reports',
            ],
            // Add other roles if needed
        ];

        // Create Roles and Assign Permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
