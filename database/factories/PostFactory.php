<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
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
            'title' => $this->faker->sentence,
            'user_id' => User::factory()->create()->id,
            'description' => $this->faker->sentence(50),
            'publication_date' => Carbon::now()->subDays(rand(2, 50)),
            'status' => 1,

        ];
    }
}
