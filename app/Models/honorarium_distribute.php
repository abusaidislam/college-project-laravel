<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class honorarium_distribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'receiver',
        'ammount',
        'dates',
       'note',


    ];
}
