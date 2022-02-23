<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recertificate extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'serialnumber',
		'ownername',
		'generatorname',
		'customerName',
		'technology',
		'vintage',
		'startDate',
		'endDate',
		'dateissued',
		'expirydate',
		'updated_by',
		'updated_date',
		'ID',
		'IDParent',
		'typeFIT'
    ];
    
}
