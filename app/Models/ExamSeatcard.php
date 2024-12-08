<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSeatcard extends Model
{
    use HasFactory;
     protected $fillable = [
        'student_name',
        'exam_name',
        'roll',
        'course_name',
      
       

    ];
}
