<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    use HasFactory;

    protected $table = 'vision_missions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'depart_id', 'vision_title', 'vision_images', 'vision_details',
    ];
}
