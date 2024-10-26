<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserAnimePlanned;
use Database\Factories\Traits\UserAnimeRelationshipTrait;

class UserAnimePlannedFactory extends Factory
{
    use UserAnimeRelationshipTrait;

    protected $model = UserAnimePlanned::class;

    public function definition(): array
    {
        return $this->getRandomPair();
    }
}