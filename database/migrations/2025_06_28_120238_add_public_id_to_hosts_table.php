<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_public_id_to_hosts_table.php

    public function up()
    {
        Schema::table('hosts', function (Blueprint $table) {
            $table->string('public_id')->nullable()->after('photo');
        });
    }

    public function down()
    {
        Schema::table('hosts', function (Blueprint $table) {
            $table->dropColumn('public_id');
        });
    }
};
