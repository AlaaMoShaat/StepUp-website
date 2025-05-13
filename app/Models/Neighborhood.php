<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Neighborhood extends Model
{
    use HasTranslations;
    public $timestamps = false;
    public $translatable = ['name'];
    protected $fillable = ['name', 'city_id', 'postal_code'];

    public function branches()
    {
        return $this->hasMany(StoreBranch::class, 'neighborhood_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}