<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Anime;
use App\Models\UserAnimePlanned;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAnimePlanned>
 */
class UserAnimePlannedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $animeIds = Anime::pluck('id')->toArray();

        // Получаем случайные user_id и anime_id
        $userId = $this->faker->randomElement($userIds);
        $animeId = $this->faker->randomElement($animeIds);

        // Проверяем, существует ли такая запись
        while (UserAnimePlanned::where('user_id', $userId)->where('anime_id', $animeId)->exists()) {
            $userId = $this->faker->randomElement($userIds);
            $animeId = $this->faker->randomElement($animeIds);
        }

        return [
            'user_id' => $userId,
            'anime_id' => $animeId,
        ];
    }
}
