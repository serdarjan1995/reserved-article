<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => $this->faker->numberBetween(1,49),
            'title' => $this->faker->text(50),
            'content' => $this->faker->realText(),
            'image' => env('APP_URL').'/images/news/'.$this->faker->numberBetween(1,100).'.jpg',
            'created_at' => $this->faker->dateTimeBetween('-10 years','now')
        ];
    }
}
