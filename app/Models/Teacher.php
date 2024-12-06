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
}
