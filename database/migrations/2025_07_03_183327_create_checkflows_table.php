<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_checkflows_table.php
    public function up()
    {
        Schema::create('checkflows', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('property_id');
            $table->string('checkin')->nullable();
            $table->text('checkin_instructions')->nullable();
            $table->string('checkout')->nullable();
            $table->text('checkout_instructions')->nullable();
            $table->string('checkin_video')->nullable();
            $table->string('checkout_video')->nullable();
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkflows');
    }
};
