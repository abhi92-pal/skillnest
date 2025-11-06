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
        Schema::create('lessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('topic_id');
            $table->enum('type', ['Video', 'Text', 'Quiz']);
            $table->string('name');
            $table->text('description');
            $table->text('content_url')->nullable();
            $table->double('duration', 20, 5)->comment('In Seconds');
            $table->enum('is_freezed', ['Yes', 'No'])->default('No'); // content will be available after freezing
            $table->string('language');
            $table->uuid('created_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('topic_id')->on('topics')->references('id')->onDelete('cascade');
            $table->foreign('created_by')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessions');
    }
};
