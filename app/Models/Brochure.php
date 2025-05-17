<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Brochure extends Model
{
    use HasTranslations;
    protected $fillable = ['file', 'catalog_id'];
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'broshore_id');
    }

    public function brochureHotspots()
    {
        return $this->hasMany(BrochureHotspot::class, 'broshore_id');
    }
}