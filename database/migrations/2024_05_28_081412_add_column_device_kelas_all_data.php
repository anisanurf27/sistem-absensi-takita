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
        Schema::table('all_data', function (Blueprint $table) {
            $table->string('device_kelas',20);
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('all_data', function (Blueprint $table) {
            $table->dropColumn(['device_kelas']);
         });
    }
};