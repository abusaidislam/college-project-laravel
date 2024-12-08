<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class academic extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','type',
      'details','department','session','department','depart_id',
        'year','publish_date',
       
        
    ];
}
