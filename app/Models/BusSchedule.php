<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusSchedule extends Model
{
    use HasFactory;
     protected $table = 'bus_schedules';
    protected $primaryKey = 'id';

    protected $fillable = [
        'bus_no', 'sokhipur', 'gorai', 'mirjapur', 'elenga', 'notunbusstand', 'puratonbusstand', 'college', 'note',
    ];}
