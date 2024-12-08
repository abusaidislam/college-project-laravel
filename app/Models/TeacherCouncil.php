<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCouncil extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'designation',
        'academicdesignation',
        'department',
        'bcs_batch',
        'from',
        'to',
        'mobile_no',
        'photo',
       
    ];
}
