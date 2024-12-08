<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyRoaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_name',
        'name',
        'designation',
        'department',
        'email',
        'duty_date',
        'duty_time',
    ];
}
