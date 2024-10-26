<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AnimeGenre;
use App\Models\Anime;
use App\Models\Genre;
use Illuminate\Support\Collection;

class AnimeGenreFactory extends Factory
{
    private ?Collection $availablePairs = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Initialize available pairs if not already done
        if ($this->availablePairs === null) {
            $this->initializeAvailablePairs();
        }

        // If no pairs are available, throw an exception
        if ($this->availablePairs->isEmpty()) {
            throw new \Exception('No more unique anime-genre pairs available for seeding.');
        }

        // Get and remove a random pair from the available pairs
        $randomPair = $this->availablePairs->random();
        $this->availablePairs = $this->availablePairs->reject(function ($pair) use ($randomPair) {
            return $pair['anime_id'] === $randomPair['anime_id'] && 
                   $pair['genre_id'] === $randomPair['genre_id'];
        });

        return $randomPair;
    }

    /**
     * Initialize the collection of available anime-genre pairs
     */
    private function initializeAvailablePairs(): void
    {
        // Get existing pairs
        $existingPairs = AnimeGenre::select('anime_id', 'genre_id')->get()
            ->map(function ($pair) {
                return $pair->anime_id . '-' . $pair->genre_id;
            })->toArray();

        // Get all anime and genre IDs
        $animeIds = Anime::pluck('id')->toArray();
        $genreIds = Genre::pluck('id')->toArray();

        // Create collection of all possible unique pairs that don't exist yet
        $this->availablePairs = collect();
        foreach ($animeIds as $animeId) {
            foreach ($genreIds as $genreId) {
                $pairKey = $animeId . '-' . $genreId;
                if (!in_array($pairKey, $existingPairs)) {
                    $this->availablePairs->push([
                        'anime_id' => $animeId,
                        'genre_id' => $genreId,
                    ]);
                }
            }
        }
    }

    /**
     * Configure the factory to create a specific number of pairs for an anime
     */
    public function forAnime(int $animeId, int $count = 1): self
    {
        return $this->state(function (array $attributes) use ($animeId, $count) {
            // Get existing genre IDs for this anime
            $existingGenreIds = AnimeGenre::where('anime_id', $animeId)
                ->pluck('genre_id')
                ->toArray();

            // Get available genre IDs that aren't already associated
            $availableGenreIds = Genre::whereNotIn('id', $existingGenreIds)
                ->pluck('id')
                ->toArray();

            if (empty($availableGenreIds)) {
                throw new \Exception("No more available genres for anime ID: {$animeId}");
            }

            // Get a random genre ID from available ones
            $randomGenreId = $this->faker->randomElement($availableGenreIds);

            return [
                'anime_id' => $animeId,
                'genre_id' => $randomGenreId,
            ];
        });
    }
}