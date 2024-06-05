<?php

namespace Database\Factories;

use App\Models\Overtime;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Overtime>
 */
class OvertimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Overtime::class;


    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'number_of_hours' => $this->faker->numberBetween(1, 12), // Nombre d'heures supplémentaires aléatoires entre 1 et 12
        ];
    }
}
