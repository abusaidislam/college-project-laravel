<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseName extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'department',
        'depart_id',
        'class_id',
        'class_typeof',
        'credit',
        'marks',
        'course_code'   
    ];
}
