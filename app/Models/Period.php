<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{

    use SoftDeletes;

    protected $guarded = [];

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
