<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_order extends Model
{
    use HasFactory;
     protected $fillable = [
        'issue_no',
        'subject',
        'publish_date',
       'document',


    ];
}
