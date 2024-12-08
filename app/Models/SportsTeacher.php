<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportsTeacher extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'email',
         'photo',
        'designation',
        'mobile_no',
       'blood_group',
       'home_dis',
       'first_join',
       'present_join'

    ];
}
