<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeWorkRecord;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeController
{
    public function index(Request $request): View
    {
        $employees = Employee::orderBy('id')->get();

        return view('employee.index', compact(['employees']));
    }

    public function show(Employee $employee): View
    {
        $records = EmployeeWorkRecord::query()
            ->orderBy('started_work_at', 'desc')
            ->where('employee_id', '=', $employee->id)
            ->get()
            ->groupBy(function($item) {
                return Carbon::parse($item->started_work_at)->format('Y');
            })->map(function ($groups) {
                return $groups->groupBy(function($item) {
                    return Carbon::parse($item->started_work_at)->format('W');
                });
            });

        return view('employee.show', compact(['employee', 'records']));
    }

    public function upload(Request $request): View
    {
        return view('employee.upload');
    }
}
