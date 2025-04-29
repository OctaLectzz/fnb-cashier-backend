<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Main\BranchSeeder;
use Database\Seeders\Main\CategorySeeder;
use Database\Seeders\Main\ProductSeeder;
use Database\Seeders\Main\TransactionSeeder;
use Database\Seeders\Employee\RoleSeeder;
use Database\Seeders\Employee\ScheduleSeeder;
use Database\Seeders\Employee\EmployeeSeeder;
use Database\Seeders\Employee\AttendanceSeeder;
use Database\Seeders\Employee\LeaveSeeder;
use Database\Seeders\Employee\OvertimeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            BranchSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            TransactionSeeder::class,
            RoleSeeder::class,
            ScheduleSeeder::class,
            EmployeeSeeder::class,
            AttendanceSeeder::class,
            LeaveSeeder::class,
            OvertimeSeeder::class
        ]);
    }
}
