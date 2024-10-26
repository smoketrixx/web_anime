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
        Schema::create('users_anime_watching', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('anime_id')->constrained();
            $table->primary(['user_id', 'anime_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_anime_watching');
    }
};
