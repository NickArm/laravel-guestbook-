<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('editor_images', function (Blueprint $table) {
            // drop old index first (if needed)
            $table->dropIndex(['imageable_type', 'imageable_id']);

            // change type
            $table->uuid('imageable_id')->nullable()->change();

            // re-add morph index
            $table->index(['imageable_type', 'imageable_id']);
        });
    }

    public function down(): void
    {
        Schema::table('editor_images', function (Blueprint $table) {
            $table->dropIndex(['imageable_type', 'imageable_id']);
            $table->unsignedBigInteger('imageable_id')->nullable()->change();
            $table->index(['imageable_type', 'imageable_id']);
        });
    }
};
