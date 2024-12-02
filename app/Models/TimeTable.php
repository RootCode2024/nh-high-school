<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeTable extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'academic_year_id',
        'classe_id',
        'subject_id',
        'period_id',
        'teacher_id',
        'coefficient',
        'day',
        'start_time',
        'end_time',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function subject()
    {
        return $this->hasMany(Subject::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
