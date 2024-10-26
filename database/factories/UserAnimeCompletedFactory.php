<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\UserAnimeCompleted;
use App\Models\User;
use App\Models\Anime;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAnimeCompleted>
 */
class UserAnimeCompletedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = UserAnimeCompleted::class;

     public function definition(): array
     {
        $userIds = User::pluck('id')->toArray();
        $animeIds = Anime::pluck('id')->toArray();

        // Получаем случайные user_id и anime_id
        $userId = $this->faker->randomElement($userIds);
        $animeId = $this->faker->randomElement($animeIds);

        // Проверяем, существует ли такая запись
        while (UserAnimeCompleted::where('user_id', $userId)->where('anime_id', $animeId)->exists()) {
            $userId = $this->faker->randomElement($userIds);
            $animeId = $this->faker->randomElement($animeIds);
        }

        return [
            'user_id' => $userId,
            'anime_id' => $animeId,
        ];
     }
     
}
