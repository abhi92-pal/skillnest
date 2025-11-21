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
        Schema::create('examslots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('semester_id');
            $table->uuid('topic_id');
            $table->timestamp('starts_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('semester_id')->on('semesters')->references('id')->onDelete('cascade');
            $table->foreign('topic_id')->on('topics')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examslots');
    }
};
