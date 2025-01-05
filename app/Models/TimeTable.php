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
        return $this->belongsTo(Subject::class);
    }

    public function matiere($classe_id)
    {
        return Subject::where('id', $classe_id)->firstOrFail();
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
