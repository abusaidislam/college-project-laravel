<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_attendence extends Model
{
    use HasFactory;

     protected $fillable = [
        'student_name',
        
        'exam_name',
        'roll',
        'registration',
        'course_name',
      
       

    ];
}
