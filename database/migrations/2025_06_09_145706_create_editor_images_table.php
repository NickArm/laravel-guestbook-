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
        Schema::create('editor_images', function (Blueprint $table) {
            $table->id();
            $table->string('public_id')->unique(); // Cloudinary public_id
            $table->text('url'); // Full Cloudinary URL (using text for long URLs)
            $table->string('original_filename')->nullable();
            $table->nullableMorphs('imageable'); // Creates imageable_type and imageable_id as NULLABLE
            $table->uuid('user_id'); // UUID for user_id to match your users table
            $table->string('folder')->nullable(); // Cloudinary folder path
            $table->unsignedBigInteger('file_size')->nullable(); // File size in bytes
            $table->string('format', 10)->nullable(); // Image format (jpg, png, etc.)
            $table->unsignedInteger('width')->nullable(); // Image width
            $table->unsignedInteger('height')->nullable(); // Image height
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes for better performance
            $table->index('user_id');
            $table->index('public_id');
            $table->index('created_at'); // For orphaned image cleanup queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editor_images');
    }
};
