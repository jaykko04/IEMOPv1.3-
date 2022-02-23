<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
     protected $fillable = [
     	'id',
        'org_name',
        'location',
        'price',
        'volume',
        'sched_date_tran',
        'status',
    ];    
}
