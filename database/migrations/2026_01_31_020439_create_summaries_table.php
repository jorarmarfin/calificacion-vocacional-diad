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
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();
            $table->string('voca')->unique();
            $table->integer('p05')->nullable();
            $table->integer('p06')->nullable();
            $table->integer('p07')->nullable();
            $table->integer('p08')->nullable();
            $table->integer('p09')->nullable();
            $table->integer('p10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summaries');
    }
};
