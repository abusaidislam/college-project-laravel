<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book_issue extends Model
{
    use HasFactory;
     protected $fillable = [
       
        'card_no',
        'book_id',
        'author',
        'number_of_book',
        'number_of_remaining_book',
        'date_of_issue_book',
        'date_of_return_book',
         ];
}
