<?php

namespace Database\Seeders\Employee;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Employee\Employee;
use App\Models\Employee\Attendance;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all employees
        $employees = Employee::with('schedule')->get();

        // Set the first day of the current month and the current date
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now(); // Today's date

        // Loop through each day from the start of the month to today
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            // Loop through each employee
            foreach ($employees as $employee) {
                // Check if employee has a schedule
                if ($employee->schedule) {
                    // Retrieve the employee's schedule start and end times
                    $entryTime = Carbon::createFromFormat('H:i:s', $employee->schedule->start_time);
                    $exitTime = Carbon::createFromFormat('H:i:s', $employee->schedule->end_time);

                    // Generate random entry and exit locations
                    $entryLocation = 'Office';
                    $exitLocation = 'Office';

                    // Create attendance record for each employee on each day
                    Attendance::create([
                        'user_id' => 1,
                        'employee_id' => $employee->id,
                        'branch_id' => 1,
                        'date' => $date->toDateString(),
                        'entry_time' => $entryTime->format('H:i'),
                        'entry_location' => $entryLocation,
                        'entry_status' => 'on_time',
                        'late_minutes' => null,
                        'late_reason' => null,
                        'exit_time' => $exitTime->format('H:i'),
                        'exit_location' => $exitLocation,
                        'exit_status' => 'on_time',
                        'early_leave_minutes' => null,
                        'early_leave_reason' => null,
                        'status' => 'valid',
                        'verified_by' => 1
                    ]);
                }
            }
        }
    }
}
