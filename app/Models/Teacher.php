<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use softDeletes, HasFactory;
    protected $guarded = [];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . strtoupper($this->last_name);
    }

    public function timeTables()
    {
        return $this->hasMany(TimeTable::class);
    }

    public function teacherSubjectName($classe_id)
    {
        $timeTable = TimeTable::where('teacher_id', $this->id)->where('classe_id', $classe_id)->first();
        // dd($timeTable);
        $subject = Subject::find($timeTable->subject_id);
        if ($subject) {
            return $subject->name;
        }
    }
}
