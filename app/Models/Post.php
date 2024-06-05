<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id', 'name','description'
    ];

    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
