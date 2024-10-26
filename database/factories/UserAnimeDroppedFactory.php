<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Anime;
use App\Models\UserAnimeDropped;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAnimeDropped>
 */
class UserAnimeDroppedFactory extends Factory
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
        while (UserAnimeDropped::where('user_id', $userId)->where('anime_id', $animeId)->exists()) {
            $userId = $this->faker->randomElement($userIds);
            $animeId = $this->faker->randomElement($animeIds);
        }

        return [
            'user_id' => $userId,
            'anime_id' => $animeId,
        ];
    }
}
