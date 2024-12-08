<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRoutine extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'exam_id',
        'date',
        'day',
        'first_sub',
        'second_sub',    

    ];
}



