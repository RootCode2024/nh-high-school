<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutor extends Model
{
    use HasFactory, SoftDeletes;
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
