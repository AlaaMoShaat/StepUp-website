<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;
    public $timestamps = false;
    public $translatable = ['name'];
    protected $fillable = ['name', 'status'];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class, 'city_id');
    }
}
