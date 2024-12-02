<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'academic_year_id',
        'student_id',
        'subject_id',
        'period_id',
        'day',
    ];

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
