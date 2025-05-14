<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'branch_id',
        'day_id',
        'open_time',
        'close_time',
    ];
}
