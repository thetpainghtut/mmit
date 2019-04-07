<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'codeno', 'title', 'startdate', 'enddate', 'duration_id', 'teacher_id'
    ];
}
