<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remuneration extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'amount', 'bonus', 'prime', 'motif_prime', 'deduction', 'motif_deduction', 'date'
    ];

    // Événement "saving" pour mettre à jour le montant total de la rémunération
    protected static function booted()
    {
        static::saving(function ($remuneration) {
            $remuneration->amount = ($remuneration->bonus ?? 0) + ($remuneration->prime ?? 0) - ($remuneration->deduction ?? 0);
        });
    }

    public function employees(){
        return $this->belongsTo(Employee::class);
    }
}
