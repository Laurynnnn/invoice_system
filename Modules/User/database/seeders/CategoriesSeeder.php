<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\PermissionCategory;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'User Management',
            'System Settings',
            'Client Management',
            'Invoice Management',
            'Reporting',
        ];

        foreach ($categories as $categoryName) {
            // DB::table('permission_categories')->insert([
            //     'name' => $categoryName,
            // ]);
            $category = PermissionCategory::firstOrCreate(['name' => $categoryName]);
        }
    }
}
