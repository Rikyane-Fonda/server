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

    public function vacations(){
        return $this->hasMany(Vacation::class);
    }

    public function remunerations(){
        return $this->hasMany(Remuneration::class);
    }

    public function overtimes(){
        return $this->hasMany(Overtime::class);
    }

    public function jobs(){
        return $this->belongsTo(Job::class);
    }

    public function departments(){
        return $this->belongsTo(Department::class);
    }

}
