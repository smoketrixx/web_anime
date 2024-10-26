<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Anime;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\AnimeGenre;
use App\Models\UserAnimeCompleted;
use App\Models\UserAnimeDropped;
use App\Models\UserAnimePlanned;
use App\Models\UserAnimeWatching;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        
        Genre::factory(10)->create();
        Studio::factory(10)->create();
        $this->call(StatusSeeder::class);
        $this->call(MpaaRatingSeeder::class);
        $this->call(OriginalSourcesSeeder::class);
        $this->call(AnimeSeeder::class);
        User::factory(50)->create();
        Comment::factory(500)->create();
        AnimeGenre::factory(50)->create();
        UserAnimeCompleted::factory(50)->create();
        UserAnimeDropped::factory(50)->create();
        UserAnimePlanned::factory(50)->create();
        UserAnimeWatching::factory(50)->create();

        // // User::factory(10)->create();
        // User::factory(10)->create();
        // Genre::factory(5)->create();
        // Studio::factory(5)->create();
        // Anime::factory(10)->create()->each(function ($anime) {
        //     // Пример: привязать жанры и студии к аниме
        //     $anime->genres()->attach(Genre::inRandomOrder()->take(rand(1, 3))->pluck('id'));
        //     $anime->studios()->attach(Studio::inRandomOrder()->take(rand(1, 2))->pluck('id'));
        // });
        // Comment::factory(20)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
