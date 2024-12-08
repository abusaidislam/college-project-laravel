<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuldingName extends Model
{
    use HasFactory;
     protected $fillable = [
        'building_name',
        'hostel_id',
    ];
}
