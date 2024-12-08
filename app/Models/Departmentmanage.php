<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Departmentmanage extends Authenticatable
{
    use HasFactory;
    protected $table = 'departments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
        'email',
        'password',
        'faculty',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
