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
        Schema::create('game_skill', function (Blueprint $table) {
            $table->foreignId('game_id')
                  ->constrained('games')
                  ->onDelete('cascade');
            $table->foreignId('skill_id')
                  ->constrained('skills')
                  ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_skill');
    }
};
