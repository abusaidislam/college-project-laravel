<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subofsubmenu extends Model
{
    use HasFactory;
     protected $table = 'subofsubmenus';
    protected $fillable = [
        'title',
        'route',
        'sub_id',
        
    ];
}
