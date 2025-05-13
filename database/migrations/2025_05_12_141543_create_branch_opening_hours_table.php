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
        Schema::create('branch_opening_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('store_branches')->onDelete('cascade');
            $table->foreignId('opening_hour_id')->constrained('opening_hours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_opening_hours');
    }
};
