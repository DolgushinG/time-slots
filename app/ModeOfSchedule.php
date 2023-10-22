<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeOfSchedule extends Model
{
    public $table = 'mode_of_schedule';
    protected $fillable = [
        'two_in_two',
        'latest_work_day',
    ];
}
