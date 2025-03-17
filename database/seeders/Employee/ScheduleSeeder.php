<?php

namespace Database\Seeders\Employee;

use Illuminate\Database\Seeder;
use App\Models\Employee\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'user_id' => 1,
            'name' => 'Shift Pagi',
            'start_time' => '08:00',
            'end_time' => '16:00'
        ]);
        Schedule::create([
            'user_id' => 1,
            'name' => 'Shift Siang',
            'start_time' => '12:00',
            'end_time' => '20:00'
        ]);
        Schedule::create([
            'user_id' => 1,
            'name' => 'Shift Malam',
            'start_time' => '20:00',
            'end_time' => '04:00'
        ]);
    }
}
