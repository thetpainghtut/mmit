<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Inquire extends Model
{
    protected $fillable = [
        'name', 'gender', 'dob', 'age', 'address', 'phno', 'email', 'installmentdate', 'installmentamount', 'remark', 'position', 'camp', 'education', 'acceptedyear', 'section_id', 'township_id', 'user_id'
    ];}
