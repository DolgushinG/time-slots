<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    public $table = 'time_slots';
    protected $fillable = [
        'time_slot',
        'is_open',
    ];
}
