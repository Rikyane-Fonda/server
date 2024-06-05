<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'amount_payable', 'payment_amount', 'payment_status', 'remains', 'payment_method'
    ];

    public function employees(){
        return $this->belongsTo(Employee::class);
    }
}
