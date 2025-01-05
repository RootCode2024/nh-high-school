<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function classeLevel($level)
    {
        $classeLevel = ClasseLevel::where('id', $level)->first();

        return $classeLevel->name;
    }

    public function mainTeacher()
    {
        $teacher = Teacher::where('id', $this->main_teacher)->firstOrFail();

        return $teacher;
    }
}
