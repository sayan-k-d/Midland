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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('page'); 
            $table->string('banner_image'); 
            $table->string('banner_title')->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('link_url')->nullable();
            $table->enum('type', ['carousel', 'single']); 
            $table->integer('position')->default(0); 
            $table->boolean('is_active')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
