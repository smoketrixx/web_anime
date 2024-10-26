<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Anime; 

use App\Models\Status; 

use App\Models\OriginalSource;

use App\Models\Studio; 

use App\Models\MpaaRating; 

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Anime::class;
    // public function definition(): array
    // {
    //     return [
    //         'russian_name' => $this->faker->words(3, true),
    //         'original_name' => $this->faker->words(3, true),
    //         'english_name' => $this->faker->words(3, true),
    //         'avatar' => $this->faker->imageUrl(),
    //         'description' => $this->faker->paragraph(),
    //         'rating' => $this->faker->randomFloat(2, 0, 10),
    //         'current_episodes' => $this->faker->numberBetween(1, 100),
    //         'total_episodes' => $this->faker->numberBetween(1, 100),
    //         'status_id' => $this->faker->numberBetween(1, 5),
    //         'original_source_id' => $this->faker->numberBetween(1, 5),
    //         'issue_date' => $this->faker->date(),
    //         'mpaa_rating_id' => $this->faker->numberBetween(1, 5),
    //     ];
    // }
    public function definition(): array
{
    return [
        'russian_name' => $this->faker->words(3, true),
        'original_name' => $this->faker->words(3, true),
        'english_name' => $this->faker->words(3, true),
        'avatar' => $this->faker->imageUrl(),
        'description' => $this->faker->paragraph(),
        'rating' => $this->faker->randomFloat(2, 0, 10),
        'current_episodes' => $this->faker->numberBetween(1, 100),
        'total_episodes' => $this->faker->numberBetween(1, 100),
        'status_id' => $this->faker->randomElement(Status::pluck('id')->toArray()), // Используем существующие значения
        'original_source_id' => $this->faker->randomElement(OriginalSource::pluck('id')->toArray()),
        'issue_date' => $this->faker->date(),
        'mpaa_rating_id' => $this->faker->randomElement(MpaaRating::pluck('id')->toArray()),
        'studio_id' => $this->faker->randomElement(Studio::pluck('id')->toArray()),
    ];
}



}
