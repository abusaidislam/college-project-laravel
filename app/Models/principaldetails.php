<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class principaldetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'designation',
        'p_id',
       'from',
       'to',


    ];
}
