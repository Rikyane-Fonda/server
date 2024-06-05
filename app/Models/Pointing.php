<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointing extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'start_time', 'end_time', 'hours', 'pause_hours'
    ];


    protected $dates = [
        'start_time', 'end_time'
    ];

    public function employees(){
        return $this->belongsTo(Employee::class);
    }

    public function calculateHours()
    {
        if ($this->start_time && $this->end_time) {
            $startTime = Carbon::parse($this->start_time);
            $endTime = Carbon::parse($this->end_time);
            $totalHours = $endTime->diffInHours($startTime);
            $this->hours = $totalHours - $this->pause_hours;
            $this->save();
        }
    }
}
