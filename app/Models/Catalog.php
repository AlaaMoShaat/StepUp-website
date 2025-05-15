<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Catalog extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'description'];
    protected $fillable = ['title', 'store_id', 'description', 'start_date', 'end_date', 'status'];

    public function store()
    {
        return $this->belongsTo(store::class, 'store_id');
    }
    public function brochures()
    {
        return $this->hasMany(brochure::class, 'catalog_id');
    }

    public function scopeActive($query) {
        return $query->where('status', 1);
    }
    public function scopeInactive($query) {
        return $query->where('status', 0);
    }

    public function getStatusTranslatable()
    {
        if( app()->getLocale() == 'ar') {
            return $this->status == 1? 'مفعل' : 'غير مفعل';
        }else {
            return $this->status == 1? 'Active' : 'Inactive';
        }
    }

    public function getCreatedAtAttribute($val)
    {
        return date('Y/m/d - H:i A', strtotime($val));
    }
}
