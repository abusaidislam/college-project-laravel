<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    use HasFactory;
      protected $fillable = [
         'company_name',
        'company_email',
         'mobile_no',
        'address',
         'logo',
         'citizen',
         'arts' ,
         'principaloffice',
         'science',
         'portal',
         'socialscience',
         'business',
          'links',
           'mail',
           'forms',
           'currentusers',
        'bangabandhu',
         'golden_jubilee',
        'Class_s',
          'bus_s',
        'Journal',
       'facebook',
        'twitter',
         'instragram',
        'skype',
        'apa',
        'nis',
        'innovation',
        'elearning',
        

       


    ];
}
