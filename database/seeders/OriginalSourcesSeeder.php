<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\OriginalSource;
class OriginalSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sources = [
            // Напиши сюда источники аниме 5 штук
            ['name' => 'Манга'],
            ['name' => 'Манхва'],
            ['name' => 'Лайт-новеллы'],
            ['name' => 'Визуальные новеллы'],
            ['name' => 'Ранобэ'],
            ['name' => 'Комиксы'],
            ['name' => 'Другие источники'],
        ];

        foreach ($sources as $source) {
            OriginalSource::create($source);
        }
    }
}
