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
        Schema::create('common_senses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('common_sense_category_id');
            $table->string('title');
            $table->text('content');
            $table->integer('status');
            $table->unsignedBigInteger('last_modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_senses');
    }
};
