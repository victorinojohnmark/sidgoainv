<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'checkin-list',
            'checkin-create',
            'checkin-edit',
            'checkin-complete',

            'stock-create',
            'stock-edit',

            'checkout-list',
            'checkout-create',
            'checkout-edit',
            'checkout-complete',

            'releaseitem-create',
            'releaseitem-edit',

            'user-list',
            'user-create',
            'user-edit',

            'role-list',
            'role-create',
            'role-edit'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
