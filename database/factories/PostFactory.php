<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;


    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph,
        ];
    }
}
