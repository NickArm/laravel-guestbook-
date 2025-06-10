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
        Schema::create('appliance_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appliance_id'); // <-- διορθωμένο
            $table->string('url');
            $table->string('public_id')->nullable();
            $table->timestamps();

            $table->foreign('appliance_id')
                ->references('id')
                ->on('appliances')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appliance_images');
    }
};
