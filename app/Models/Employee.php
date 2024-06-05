<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id', 'name', 'surname', 'email', 'national_ID_card', 'adress', 'city', 'state', 'postal_code', 'Telephone', 'hiring_date', 'departure_date', 'status'
    ];


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

    public function permissions()
    {
        return $this->post->permissions();
    }

    public function hasPermission($permission)
    {
        return $this->permissions()->where('name', $permission)->exists();
    }

}
