<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remuneration>
 */
class RemunerationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Remuneration::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(), // Crée un employee et attache la rémunération
            'montant' => $this->faker->randomFloat(2, 1000, 5000),
            'bonus' => $this->faker->optional()->randomFloat(2, 100, 1000),
            'pime' => $this->faker->optional()->randomFloat(2, 50, 500),
            'motif_prime' => $this->faker->optional()->sentence,
            'deduction' => $this->faker->optional()->randomFloat(2, 50, 500),
            'motif_deduction' => $this->faker->optional()->sentence,
            'period' => $this->faker->date('m/Y'),
        ];
    }

    public function forEmployee(Employee $employee)
    {
        return $this->state(function (array $attributes) use ($employee) {
            return [
                'employee_id' => $employee->id,
            ];
        });
    }
}
