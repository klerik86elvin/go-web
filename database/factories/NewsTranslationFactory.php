<?php

namespace Database\Factories;

use App\Models\Locale;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsTranslation>
 */
class NewsTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(100),
            'description' => $this->faker->paragraph(6),
            'locale_id'=> $this->faker->randomElement(Locale::all()->pluck('id')),
            'news_id'=> $this->faker->randomElement(News::all()->pluck('id')),
        ];
    }
}
