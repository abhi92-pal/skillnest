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
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('exampaper_id');
            $table->uuid('questiontype_id');
            $table->text('question');
            $table->double('marks');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('exampaper_id')->on('exampapers')->references('id')->onDelete('cascade');
            $table->foreign('questiontype_id')->on('questiontypes')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
