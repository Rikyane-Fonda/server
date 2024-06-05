<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'base_salary', 'start_date', 'end_date', 'monthly_hours'
    ];

    // Événement "creating" pour mettre à jour la date de fin du précédent salaire
    public static function boot()
    {
        parent::boot();

        static::creating(function ($salary) {
            // Set the end_date of the previous salary
            $previousSalary = Salary::where('employee_id', $salary->employee_id)->latest('start_date')->first();
            if ($previousSalary) {
                $previousSalary->end_date = now();
                $previousSalary->save();
            }
        });
    }

    public function employees(){
        return $this->belongsTo(Employee::class);
    }
}
