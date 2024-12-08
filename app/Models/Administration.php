<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'photo',
        'designation',
        'department',
        'mobile_no',
       'bcs_batch',
       'blood_group',
       'home_dis'


    ];
}
