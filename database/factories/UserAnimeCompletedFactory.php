<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserAnimeCompleted;
use Database\Factories\Traits\UserAnimeRelationshipTrait;

class UserAnimeCompletedFactory extends Factory
{
    use UserAnimeRelationshipTrait;

    protected $model = UserAnimeCompleted::class;

    public function definition(): array
    {
        return $this->getRandomPair();
    }
}