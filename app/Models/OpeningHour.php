<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpeningHour extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['day', 'open_time', 'close_time'];
}