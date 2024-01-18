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
        Schema::create('curriculum_method_relationship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('method_id');
            $table->timestamps();

            $table->foreign('curriculum_id')->references('id')->on('curricula')->onDelete('cascade');
            $table->foreign('method_id')->references('id')->on('curriculum_methods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_method_relationship');
    }
};
