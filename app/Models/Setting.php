<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;
    public $timestamps = false;
    public $translatable = ['site_name', 'site_desc', 'site_address', 'site_meta_description'];
    protected $fillable = [
        'site_name',
        'site_desc',
        'site_phone',
        'site_address',
        'site_email',
        'site_email_support',
        'site_facebook_url',
        'site_twitter_url',
        'site_instagram_url',
        'site_whatsapp_url',
        'logo',
        'favicon',
        'site_meta_description',
        'site_copyright',
        'site_promotion_video_url'
    ];
    public function getLogoAttribute() {
        return 'uploads/settings/' . $this->attributes['logo'];
    }

    public function getFaviconAttribute() {
        return 'uploads/settings/' . $this->attributes['favicon'];
    }
}