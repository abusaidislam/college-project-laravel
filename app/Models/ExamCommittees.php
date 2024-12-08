<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCommittees extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'name',
        'email',
        'photo',
        'designation',
        'examname_id',
        'academic_designation',
        'mobile_no',
        'bcs_batch',
        'home_dis',
        'year',  
    ];
}
