<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    public function pointings(){
        return $this->hasMany(Pointing::class);
    }

    public function salaries(){
        return $this->hasMany(Salary::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function vacations(){
        return $this->hasMany(Vacation::class);
    }

    public function remunerations(){
        return $this->hasMany(Remuneration::class);
    }

    public function overtimes(){
        return $this->hasMany(Overtime::class);
    }

    public function posts(){
        return $this->belongsTo(Posts::class);
    }

    public function departments(){
        return $this->belongsTo(Department::class);
    }

}
