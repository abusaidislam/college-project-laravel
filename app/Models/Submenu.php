<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

      protected $fillable = [
        'sub_title',
        'subroute',
        'menu_id',
         'menu',
       
        
    ];
}
