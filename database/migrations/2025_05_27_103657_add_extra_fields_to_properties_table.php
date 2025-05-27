<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('checkin')->nullable();
            $table->string('checkin_instructions')->nullable();
            $table->string('checkout')->nullable();
            $table->string('checkout_instructions')->nullable();
            $table->string('welcome_title')->nullable();
            $table->text('welcome_message')->nullable();
            $table->longText('amenities_description')->nullable();
            $table->string('location_area')->nullable();
            $table->string('location_country')->nullable();
            $table->text('google_map_url')->nullable();
            $table->text('location_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'checkin',
                'checkin_instructions',
                'checkout',
                'checkout_instructions',
                'welcome_title',
                'welcome_message',
                'amenities_description',
                'location_area',
                'location_country',
                'google_map_url',
                'location_description',
            ]);
        });
    }
};
