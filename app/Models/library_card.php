<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class library_card extends Model
{
    use HasFactory;
     protected $fillable = [
       'department_id',
       'student_name',
       'class',
       'roll',
       'card_no',
       'session',
       'registration',
       'date',
       'blood_group',
       'mobile_no',
       'photo'
    ];
}
