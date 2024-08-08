<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'request_id';
    public $incrementing = true;
    protected $keyType = 'bigint';
    protected $fillable = ['employee_id', 'request_type', 'request_date', 'manager_id'];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    } 
}