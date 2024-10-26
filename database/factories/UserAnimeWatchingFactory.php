<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserAnimeWatching;
use Database\Factories\Traits\UserAnimeRelationshipTrait;

class UserAnimeWatchingFactory extends Factory
{
    use UserAnimeRelationshipTrait;

    protected $model = UserAnimeWatching::class;

    public function definition(): array
    {
        return $this->getRandomPair();
    }
}