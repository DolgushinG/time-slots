<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAndTimeSlot extends Model
{
    public $table = 'event_and_time_slot';
    protected $fillable = [
        'event_id',
        'time_slot_id'
    ];
}
