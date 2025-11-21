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
        Schema::create('exampaper_questiontype', function (Blueprint $table) {
            $table->uuid('exampaper_id');
            $table->uuid('questiontype_id');
            $table->string('description');
            $table->bigInteger('total_questions');
            $table->bigInteger('evaluated_question_nos');

            $table->unique(['exampaper_id', 'questiontype_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exampaper_questiontype');
    }
};
