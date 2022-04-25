<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => $this->faker->randomElement(User::pluck('id')),
            'slug'      => $this->faker->unique()->slug,
            'title'     => $this->faker->title,
            'subtitle'  => $this->faker->sentence(2),
            'tags'      => $this->faker->words(2),
            'content'   => $this->faker->paragraph(8),
            'image'     => $this->faker->image(),
            'is_published' => $this->faker->boolean(),
            'category_id'  => $this->faker->randomElement(Category::pluck('id')),
        ];
    }
}
