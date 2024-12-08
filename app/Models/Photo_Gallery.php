<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo_Gallery extends Model
{
    use HasFactory;
     protected $fillable = [
        'photo',
        'note',
         'department_id',
       
    ];
}
