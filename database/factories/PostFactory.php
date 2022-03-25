<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostFactory extends Factory
{

    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // return [
        //     'category_id' => function(){
        //         return Category::factory()->create()->id;
        //     },
        //     'user_id' => function(){
        //         return User::factory()->create()->id;
        //     },
        //     'title' => $this->faker->sentence,
        //     'description' => $this->faker->paragraph,
        //     'image' => $this->faker->imageUrl
        // ];
    }
}
