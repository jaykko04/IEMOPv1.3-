<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mandated_participants extends Model
{
    use HasFactory;
      protected $fillable = [
       'participant_name','id','resource_name'
    ];
}
