<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use HasTranslations;
    public $timestamps = false;
    public $translatable = ['title', 'description'];
    protected $fillable = [
        'brochure_id',
        'category_id',
        'title',
        'description',
        'price',
        'discount_price',
        'available_for',
        'available_in_stock',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brochure()
    {
        return $this->belongsTo(Brochure::class, 'broshore_id');
    }
}
