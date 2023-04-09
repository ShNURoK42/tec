<?php

namespace App\Contracts\Employees;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface UploadServiceContract
{
    /**
     * @param  UploadedFile $file
     * @return Collection
     */
    public function parse(UploadedFile $file): Collection;
}
