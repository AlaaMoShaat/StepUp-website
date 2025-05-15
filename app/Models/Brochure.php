<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }
}
