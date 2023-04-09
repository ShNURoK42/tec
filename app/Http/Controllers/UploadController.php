<?php

namespace App\Http\Controllers;

use App\Contracts\Employees\UploadServiceContract;
use App\Http\Requests\UploadRequest;
use App\Models\Employee;

class UploadController
{
    public function __construct(
        private readonly UploadServiceContract $service,
    ) {}

    public function __invoke(UploadRequest $request)
    {
        $employeeCollections = $this->service->parse(file: $request->file('file'));
        $employeeCollections->each(function ($item, $key) {
            Employee::forceCreate($item);
        });

        return back()
            ->with('success','Список успешно загружен.');
    }
}
