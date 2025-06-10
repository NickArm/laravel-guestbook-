<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('editor_images');
    }

    public function down()
    {
        Schema::create('editor_images', function (Blueprint $table) {
            $table->id();
            $table->string('public_id')->nullable();
            $table->string('url')->nullable();
            $table->string('original_filename')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('folder')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('format')->nullable();
            $table->nullableMorphs('imageable');
            $table->timestamps();
        });
    }
};
