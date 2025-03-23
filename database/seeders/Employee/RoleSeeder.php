<?php

namespace Database\Seeders\Employee;

use App\Models\Employee\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'user_id' => 1,
            'name' => 'superadmin',
            'permissions' => ['home attendance', 'home cashier', 'home sales', 'home report',
                              'change branches', 'dashboard main', 'dashboard employee', 'dashboard inventory', 'dashboard accounting',
                              'view users', 'create users', 'edit users', 'delete users',
                              'view branches', 'create branches', 'edit branches', 'delete branches',
                              'view categories', 'create categories', 'edit categories', 'delete categories',
                              'view products', 'create products', 'edit products', 'delete products',
                              'view cashier',
                              'view transactions', 'create transactions', 'edit transactions', 'delete transactions',
                              'view roles', 'create roles', 'edit roles', 'delete roles',
                              'view schedules', 'create schedules', 'edit schedules', 'delete schedules',
                              'view employees', 'create employees', 'edit employees', 'delete employees']
        ]);

        Role::create([
            'user_id' => 1,
            'name' => 'cashier',
            'permissions' => ['home attendance', 'home cashier', 'home sales', 'home report',
                              'dashboard main',
                              'view categories',
                              'view products',
                              'view cashier',
                              'view transactions', 'create transactions', 'edit transactions']
        ]);
    }
}
