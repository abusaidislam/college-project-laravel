<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCouncilHB extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'designation',
        'academicdesignation',
        'department',
        'bcs_batch',
        'mobile_no',
        'photo',
        'from',
        'to',
       
    ];
}
