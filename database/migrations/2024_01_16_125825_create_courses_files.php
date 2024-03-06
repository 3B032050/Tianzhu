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
        Schema::create('courses_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_file_category_id');
            $table->string('title');
            $table->string('file');
            $table->string('status')->default('1');
            $table->unsignedBigInteger('last_modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_files');
    }
};
