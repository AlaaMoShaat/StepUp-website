<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_desc');
            $table->string('site_phone');
            $table->string('site_address');
            $table->string('site_email');
            $table->string('site_email_support', 500);
            $table->string('site_facebook_url', 500);
            $table->string('site_twitter_url', 500);
            $table->string('site_instagram_url', 500);
            $table->string('site_whatsapp_url', 500);
            $table->string('logo');
            $table->string('favicon');
            $table->string('site_meta_description', 500);
            $table->string('site_copyright');
            $table->string('site_promotion_video_url', 1000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};