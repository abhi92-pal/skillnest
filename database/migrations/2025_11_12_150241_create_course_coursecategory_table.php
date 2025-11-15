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
        Schema::create('course_coursecategory', function (Blueprint $table) {
            $table->uuid('course_id');
            $table->uuid('coursecategory_id');

            $table->unique(['course_id', 'coursecategory_id']);
            $table->foreign('course_id')->on('courses')->references('id')->onDelete('cascade');
            $table->foreign('coursecategory_id')->on('coursecategories')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_coursecategory');
    }
};
