<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations, Sluggable;
    protected $fillable = ['name', 'parent', 'status'];
    public $translatable = ["name"];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'category_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent');
    }
    public function children() {
        return $this->hasMany(Category::class, 'parent');
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

    public function getNameEnAttribute()
    {
        return $this->name['en'] ?? null;
    }
}