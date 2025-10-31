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
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('short_description');
            $table->longText('long_description');
            $table->double('price', 20, 5)->default(0);
            $table->double('selling_price', 20, 5)->default(0);
            $table->enum('duration_type', ['Year', 'Month', 'Day', 'Hour']);
            $table->double('duration', 20, 5)->default(0);
            $table->date('reg_end_date')->nullable();
            $table->bigInteger('no_of_semesters')->unsigned();
            $table->enum('is_freezed', ['Yes', 'No'])->default('No');
            $table->enum('is_published', ['Yes', 'No'])->default('No')->comment('Will be handled for Front end');
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive')->comment('Will be handled for Teacher portal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
