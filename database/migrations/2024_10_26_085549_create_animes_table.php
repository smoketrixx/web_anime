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
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string('russian_name', 1000);
            $table->string('original_name', 1000);
            $table->string('english_name', 1000)->nullable();
            $table->string('avatar', 1000)->nullable();
            $table->text('description')->nullable();
            $table->decimal('rating', 5, 2)->nullable();
            $table->integer('current_episodes');
            $table->integer('total_episodes')->nullable();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->foreignId('original_source_id')->nullable()->constrained();
            $table->date('issue_date')->nullable();
            $table->foreignId('mpaa_rating_id')->nullable()->constrained('mpaa_ratings');
            $table->foreignId('studio_id')->nullable()->constrained('studios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
