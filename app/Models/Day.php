<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Day extends Model
{
    use HasTranslations;
    public $timestamps = false;
    protected $fillable = ['day'];
    public $translatable = ['day'];

}
