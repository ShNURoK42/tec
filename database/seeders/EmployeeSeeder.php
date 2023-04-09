<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $employee = \App\Models\Employee::create([
             'first_name' => 'Иван',
             'last_name' => 'Иванов',
         ]);
    }
}
