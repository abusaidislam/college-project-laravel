<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exprincipal extends Model
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
       'home_dis',
       'from',
       'to'


    ];
}
