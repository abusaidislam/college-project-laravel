<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NOC extends Model
{
    use HasFactory;
     protected $fillable = [
        'issue_no',
        'subject',
        'publish_date',
       'document',


    ];
}
