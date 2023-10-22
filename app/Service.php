<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    public $table = 'services';
    protected $fillable = [
        'name_service',
        'price',
    ];
    public function event()
    {
        return $this->belongsToMany(Event::class);
    }
}
