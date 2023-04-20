<?php

namespace Database\Factories;

use App\Models\NewsArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsArticle>
 */
class NewsArticleFactory extends Factory
{
    protected $model = NewsArticle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'text' => $this->faker->paragraph(),
            'creation_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'publication_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expiration_date' => $this->faker->dateTimeBetween('-1 month', '+5 months'),
        ];
    }
}
