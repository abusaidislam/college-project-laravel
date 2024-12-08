<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElearningNotice extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'file',];
}
