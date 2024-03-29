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
            $table->id();
            $table->unsignedBigInteger('course_category_id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('method')->nullable();
            $table->string('time')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->default(0);
            $table->unsignedBigInteger('last_modified_by')->nullable();
            $table->unsignedBigInteger('order_by');
            $table->timestamps();
//            $table->foreign('last_modified_by')->references('id')->on('users')->onDelete('set null');
//            $table->foreign('course_category_id')->references('id')->on('course_categories')->onDelete('cascade');
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
