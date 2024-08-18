<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'requests';
    protected $fillable = ['employee_id', 'request_type', 'request_date', 'manager_id'];
    protected $primaryKey = 'request_id';
    public $incrementing = true;
    public $timestamps = true;
}