<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPublication extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'file',];
}
