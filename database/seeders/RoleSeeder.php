<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super-admin',
            'owner',
            'admin',
            'cashier',
            'User',
        ];

        foreach ($roles as $roleName) {
            $role = Role::updateOrCreate(['name' => $roleName]);

            if ($roleName === 'User') {
                $role->givePermissionTo('dashboard');
            }
        }


    }
}
