<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EmployeeWorkRecordSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $employee = \App\Models\Employee::create([
            'first_name' => 'Иван',
            'last_name' => 'Иванов',
            'is_working_now' => true,
        ]);

         \App\Models\EmployeeWorkRecord::create([
             'employee_id' => $employee->id,
             'started_work_at' => Carbon::now(),
         ]);
    }
}
