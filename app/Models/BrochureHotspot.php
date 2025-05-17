<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrochureHotspot extends Model
{
    protected $fillable = ['coordinates', 'link', 'brochure_id']; //'offer_id'

    public function brochure()
    {
        return $this->belongsTo(Brochure::class, 'brochure_id');
    }
}
