<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'email',
         'photo',
        'deprartment',
        'mobile_no',
       'blood_group',
       'home_dis',
       'events',
       'awards',
       'session'

    ];
}
