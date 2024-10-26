<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\MpaaRating;
class MpaaRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [
            // Напиши сюда источники аниме 5 штук
            ['name' => 'G'],
            ['name' => 'PG'],
            ['name' => 'PG-13'],
            ['name' => 'R'],
            ['name' => 'NC-17'],
            ['name' => 'X'],
            ['name' => 'NR'],
        ];

        foreach ($ratings as $rating) {
            MpaaRating::create($rating);
        }
    }
}
