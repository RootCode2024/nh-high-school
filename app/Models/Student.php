<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . strtoupper($this->last_name);
    }

    public function getFormattedBirthDateAttribute()
    {
        return Carbon::parse($this->birth_date)->translatedFormat('d F Y');
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
