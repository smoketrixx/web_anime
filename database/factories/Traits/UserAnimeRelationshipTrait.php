<?php

namespace Database\Factories\Traits;

use Illuminate\Support\Collection;

trait UserAnimeRelationshipTrait
{
    private ?Collection $availablePairs = null;
    private array $existingPairs = [];

    /**
     * Initialize available pairs for the relationship
     */
    private function initializeAvailablePairs(): void
    {
        // Get model class name
        $modelClass = $this->model;

        // Get existing pairs only once
        if (empty($this->existingPairs)) {
            $this->existingPairs = $modelClass::select('user_id', 'anime_id')
                ->get()
                ->map(fn($pair) => $pair->user_id . '-' . $pair->anime_id)
                ->toArray();
        }

        // Create all possible pairs that don't exist yet
        $this->availablePairs = collect();
        
        // Get IDs in chunks to handle large datasets
        $userIds = $this->getUserIds();
        $animeIds = $this->getAnimeIds();

        foreach ($userIds as $userId) {
            foreach ($animeIds as $animeId) {
                $pairKey = $userId . '-' . $animeId;
                if (!in_array($pairKey, $this->existingPairs)) {
                    $this->availablePairs->push([
                        'user_id' => $userId,
                        'anime_id' => $animeId,
                    ]);
                }
            }
        }
    }

    /**
     * Get a random available pair
     */
    protected function getRandomPair(): array
    {
        if ($this->availablePairs === null) {
            $this->initializeAvailablePairs();
        }

        if ($this->availablePairs->isEmpty()) {
            throw new \Exception('No more unique user-anime pairs available for ' . class_basename($this->model));
        }

        $randomPair = $this->availablePairs->random();
        
        // Remove used pair from available pairs
        $this->availablePairs = $this->availablePairs->reject(function ($pair) use ($randomPair) {
            return $pair['user_id'] === $randomPair['user_id'] && 
                   $pair['anime_id'] === $randomPair['anime_id'];
        });

        // Add to existing pairs
        $this->existingPairs[] = $randomPair['user_id'] . '-' . $randomPair['anime_id'];

        return $randomPair;
    }

    /**
     * Get user IDs in chunks
     */
    private function getUserIds(): array
    {
        return \App\Models\User::pluck('id')->toArray();
    }

    /**
     * Get anime IDs in chunks
     */
    private function getAnimeIds(): array
    {
        return \App\Models\Anime::pluck('id')->toArray();
    }
}