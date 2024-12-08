<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademinCouncil extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'email',
        'designation',
        'department',
        'mobile_no',
       'bcs_batch',
       'photo',
    ];
}
