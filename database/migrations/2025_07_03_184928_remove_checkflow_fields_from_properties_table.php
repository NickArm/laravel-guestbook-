<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCheckflowFieldsFromPropertiesTable extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'checkin',
                'checkin_instructions',
                'checkout',
                'checkout_instructions',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->time('checkin')->nullable();
            $table->text('checkin_instructions')->nullable();
            $table->time('checkout')->nullable();
            $table->text('checkout_instructions')->nullable();
        });
    }
}
