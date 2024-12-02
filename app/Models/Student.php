<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function place_of_birth()
    {
        return $this->belongsTo(Country::class, 'place_of_birth_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }


    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

}
