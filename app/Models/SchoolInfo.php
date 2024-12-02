<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolInfo extends Model
{
    use SoftDeletes;
    protected $table = 'school_infos';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'logo',
        'favicon',
        'director_name',
        'director_signature',
        'devise',
        'small_description',
        'long_description',
        'internal_regulations',
    ];
}
