<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
      use HasFactory;
    protected $table = 'departments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
        'email',
        'password',
        'text_password',
        'faculty',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
