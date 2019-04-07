<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'dob','fathername','nrc','photo','joineddate','leavedate','status', 'location_id','user_id'
    ];
}
