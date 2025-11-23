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
        Schema::table('examslots', function (Blueprint $table) {
            $table->bigInteger('max_candidate');
            $table->bigInteger('rem_seat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examslots', function (Blueprint $table) {
            $table->dropColumn(['max_candidate', 'rem_seat']);
        });
    }
};
