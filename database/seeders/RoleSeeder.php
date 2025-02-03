<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Owner', 'Manager', 'Cashier', 'Waitress', 'Kitchen'];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'branch_id' => 1
            ]);
        }
    }
}
