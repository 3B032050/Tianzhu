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
        Schema::create('course_objectives', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('last_1_modified_by')->nullable();
            $table->string('last_2_modified_by')->nullable();
            $table->string('last_3_modified_by')->nullable();
            $table->string('last_4_modified_by')->nullable();
            $table->string('last_5_modified_by')->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_objectives');
    }
};
