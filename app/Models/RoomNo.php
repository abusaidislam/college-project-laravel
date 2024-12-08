<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomNo extends Model
{
    use HasFactory;
    protected $table = 'room_no';
     protected $fillable = [
        'building_id',
        'title',
        'number_bench',  
        'total_row',      
        'total_bench_per_col', 
        'student_per_bench',     
    ];
}
