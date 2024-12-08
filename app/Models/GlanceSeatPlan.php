<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlanceSeatPlan extends Model
{
    use HasFactory;
     protected $fillable = [
        'class_name',
        'bulding',
        'room',
        'dates',
       'starting_roll',
       'ending_roll',
       


    ];
}
