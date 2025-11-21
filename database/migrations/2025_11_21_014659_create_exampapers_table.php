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
        Schema::create('exampapers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('examslot_id')->nullable();
            $table->uuid('semester_id');
            $table->uuid('topic_id');
            $table->bigInteger('duration')->comment('in min');
            $table->bigInteger('grace_period')->comment('in min');
            $table->bigInteger('total_marks');
            $table->enum('is_freezed', ['Yes', 'No'])->default('No');
            $table->enum('is_gradable', ['Yes', 'No']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exampapers');
    }
};
