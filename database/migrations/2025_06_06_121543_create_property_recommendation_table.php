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
        Schema::create('property_recommendation', function (Blueprint $table) {
            $table->uuid('property_id');
            $table->uuid('recommendation_id');

            $table->primary(['property_id', 'recommendation_id']);

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('recommendation_id')->references('id')->on('recommendations')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_recommendation');
    }
};
