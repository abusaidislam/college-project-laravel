<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class internal_mail extends Model
{
    use HasFactory;
    protected $fillable = [
      'subject', 'sender','status', 'receiver','mail','files','file1', 'file2','file3','file4'];
}
