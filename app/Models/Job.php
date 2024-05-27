<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
