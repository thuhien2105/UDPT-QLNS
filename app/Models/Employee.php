<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{


    protected $primaryKey = 'employee_id';

    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'employee_id',
        'name',
        'dob',
        'address',
        'phone_number'
    ];

    public $timestamps = true; 
}