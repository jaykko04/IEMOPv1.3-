<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
     protected $fillable = [
     	'serialnumber',
        'ownername',
        'newownername',
        'xferRequested_by',
        'xferRequestDate',
        'xferStatus',
        'ID',
    ];    
}
