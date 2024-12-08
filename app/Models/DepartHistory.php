<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartHistory extends Model
{
    use HasFactory;

    protected $table = 'depart_histories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'depart_id', 'history_title', 'history_images', 'history_details',
    ];
}
