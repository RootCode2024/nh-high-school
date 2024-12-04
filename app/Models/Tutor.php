<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{

    protected $guarded = [];


    public function students()
    {
        return $this->hasMany(Student::class, 'tutor_id');
    }

    public function nationality()
    {
        return $this->has(Country::class, 'nationality_id');
    }

    public function place_of_birth()
    {
        return $this->belongsTo(Country::class, 'place_of_birth_id');
    }
}
