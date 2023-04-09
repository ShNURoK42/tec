<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected  $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'is_working_now',
    ];

    /**
     * Записи о рабочем времени работника.
     */
    public function work_records()
    {
        return $this->hasMany(EmployeeWorkRecord::class);
    }
}
