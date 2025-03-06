<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Main\BranchSeeder;
use Database\Seeders\Employee\RoleSeeder;
use Database\Seeders\Main\CategorySeeder;
use Database\Seeders\Main\ProductSeeder;
use Database\Seeders\Main\TransactionSeeder;
use Database\Seeders\Employee\ScheduleSeeder;
use Database\Seeders\Employee\EmployeeSeeder;

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
