<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
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

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }
}
