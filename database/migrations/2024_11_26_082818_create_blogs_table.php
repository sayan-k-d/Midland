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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->text('meta_header')->nullable(); // Meta header
            $table->text('meta_desc')->nullable(); // Meta description
            $table->string('title', 100); // Title
            $table->date('date'); // Date
            $table->text('content'); // Content
            $table->binary('content_image')->nullable(); // Content image (MediumBlob equivalent)
            $table->string('intro_heading', 100); // Intro heading
            $table->text('introduction'); // Introduction
            $table->binary('intro_image')->nullable(); // Intro image
            $table->string('video_heading', 100); // Video heading
            $table->longText('video_link'); // Video link
            $table->text('video_content'); // Video content
            $table->string('diet_heading', 100); // Diet heading
            $table->binary('diet_image')->nullable(); // Diet image
            $table->text('diet_description'); // Diet description
            $table->text('diet_content'); // Diet content
            $table->string('diet_advice', 500)->nullable(); // Diet advice
            $table->string('test_heading', 100); // Test heading
            $table->text('test_content'); // Test content
            $table->boolean('is_recent')->nullable(); // isRecent (TINYINT equivalent)
            $table->text('tags'); // Tags
            $table->string('created_by', 100)->nullable(); // Created by
            $table->timestamps(); // Adds created_at and updated_at
            $table->softDeletes(); // Adds deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
