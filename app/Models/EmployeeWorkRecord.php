<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeWorkRecord extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'started_work_at',
        'finished_work_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'started_work_at' => 'datetime:Y.m.d h:i:s',
        'finished_work_at' => 'datetime:Y.m.d h:i:s',
    ];

    /**
     * Get the group that owns the student.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
