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
        Schema::create('anime_genres', function (Blueprint $table) {
            $table->foreignId('genre_id')->constrained();
            $table->foreignId('anime_id')->constrained();
            $table->primary(['genre_id', 'anime_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime_genres');
    }
};
