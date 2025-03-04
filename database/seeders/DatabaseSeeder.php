<?php

namespace Database\Seeders;

use Database\Seeders\Employee\EmployeeSeeder;
use Database\Seeders\Employee\ScheduleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BranchSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            TransactionSeeder::class,
            ScheduleSeeder::class,
            EmployeeSeeder::class,
            SettingSeeder::class
        ]);
    }
}
