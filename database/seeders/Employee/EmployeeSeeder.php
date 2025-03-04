<?php

namespace Database\Seeders\Employee;

use Illuminate\Database\Seeder;
use App\Models\Employee\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'nip' => '2024061006',
            'name' => 'Octavyan Putra Ramadhan',
            'email' => 'octalectzz@gmail.com',
            'phone_number' => '0896 - 9022 - 0404',
            'position' => 'Manager',
            'pin' => '220404',
            'branch_id' => 1,
            'schedule_id' => 1,
            'ktp' => '3311040410060003',
            'dob' => '2006-10-04',
            'gender' => 'male',
            'domicile' => 'Sukoharjo',
            'address' => 'Jl. Seta No.32, Larangan RT04/RW04 Gayam Sukoharjo',
            'employment_status' => 'permanent',
            'date_joined' => '2025-01-15',
            'end_date' => null,
            'bpjs_tk_number' => '803473384733',
            'bpjs_health_number' => '04043843833',
            'bank_name' => 'Bank Negara Indonesia',
            'bank_account_number' => '0128374744',
            'account_holder_name' => 'Octavyan Putra Ramadhan',
            'status' => true
        ]);

        Employee::create([
            'nip' => '1234567890',
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '0812 - 3456 - 789',
            'position' => 'Software Engineer',
            'pin' => '123456',
            'branch_id' => 1,
            'schedule_id' => 2,
            'ktp' => '3216549876543210',
            'dob' => '1990-05-20',
            'gender' => 'male',
            'domicile' => 'Jakarta',
            'address' => 'Jl. Merdeka No.10',
            'employment_status' => 'permanent',
            'date_joined' => '2023-01-15',
            'end_date' => null,
            'bpjs_tk_number' => '1234567890123',
            'bpjs_health_number' => '0987654321098',
            'bank_name' => 'Bank Central Asia',
            'bank_account_number' => '1122334455',
            'account_holder_name' => 'John Doe',
            'status' => true
        ]);

        Employee::create([
            'nip' => '100002',
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'phone_number' => '081234567892',
            'position' => 'HR Manager',
            'pin' => '654321',
            'branch_id' => 1,
            'schedule_id' => 2,
            'ktp' => '3216549876543220',
            'dob' => '1988-08-15',
            'gender' => 'female',
            'domicile' => 'Surabaya',
            'address' => 'Jl. Sudirman No.20',
            'employment_status' => 'contract',
            'date_joined' => '2022-06-10',
            'end_date' => '2025-06-10',
            'bpjs_tk_number' => '1234567890124',
            'bpjs_health_number' => '0987654321099',
            'bank_name' => 'Bank Mandiri',
            'bank_account_number' => '2233445566',
            'account_holder_name' => 'Jane Smith',
            'status' => true
        ]);

        Employee::create([
            'nip' => '100004',
            'name' => 'Susan Williams',
            'email' => 'susan.williams@example.com',
            'phone_number' => '081234567894',
            'position' => 'Finance Analyst',
            'pin' => '112233',
            'branch_id' => 2,
            'schedule_id' => 1,
            'ktp' => '3216549876543240',
            'dob' => '1993-07-12',
            'gender' => 'female',
            'domicile' => 'Yogyakarta',
            'address' => 'Jl. Malioboro No.25',
            'employment_status' => 'permanent',
            'date_joined' => '2021-11-20',
            'end_date' => null,
            'bpjs_tk_number' => '1234567890126',
            'bpjs_health_number' => '0987654321101',
            'bank_name' => 'Bank CIMB Niaga',
            'bank_account_number' => '4455667788',
            'account_holder_name' => 'Susan Williams',
            'status' => true
        ]);
    }
}
