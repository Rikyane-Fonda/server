<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'dayoff_type', 'hours', 'rate', 'status', 'start_date', 'end_date'
    ];

    public function employees(){
        return $this->belongsTo(Employee::class);
    }
}
