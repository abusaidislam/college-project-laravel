<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annual_committees extends Model
{
    use HasFactory;
      protected $fillable = [
        'name',
        'email',
        'designation',
         'academic_designation',
        'department',
          'bcs_batch',
        'mobile_no',
      'type',
      'photo',


    ];
}
