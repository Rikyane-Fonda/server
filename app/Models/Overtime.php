<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'date', 'hours', 'rate', 'status'
    ];

    public function employees(){
        return $this->belongsTo(Employee::class);
    }
}
