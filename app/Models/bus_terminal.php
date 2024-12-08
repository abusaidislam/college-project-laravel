<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bus_terminal extends Model
{
    use HasFactory;
     protected $table = 'bus_terminals';
    protected $primaryKey = 'id';

    protected $fillable = [
        'space_name',
    ];
}
