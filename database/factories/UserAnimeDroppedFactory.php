<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserAnimeDropped;
use Database\Factories\Traits\UserAnimeRelationshipTrait;

class UserAnimeDroppedFactory extends Factory
{
    use UserAnimeRelationshipTrait;

    protected $model = UserAnimeDropped::class;

    public function definition(): array
    {
        return $this->getRandomPair();
    }
}