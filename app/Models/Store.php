<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;

class Store extends Model
{
    use HasTranslations, Sluggable;
    protected $fillable = ['name', 'logo', 'importance_level', 'phone', 'email', 'website_url', 'status'];
    public $translatable = ["name", 'description'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public function catalogs() {
        return $this->hasMany(Catalog::class, 'store_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('followed_at')->withTimestamps();
    }
    public function branches()
    {
        return $this->hasMany(StoreBranch::class, 'store_id');
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
    public function getLogoAttribute($logo)
    {
        return 'uploads/stores/'. $logo;
    }
}