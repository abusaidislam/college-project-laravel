<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrExamSeatplan extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_num',
        'roll',
        'type',
        'total_row',
        'starting_roll',
        'rending_rolloll',
        'year',
         ];
}
