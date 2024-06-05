<?php

namespace Database\Factories;

use App\Models\Pointing;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pointing>
 */
class PointingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pointing::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'number_of_hours' => $this->faker->numberBetween(1, 12), // Nombre d'heures pointées aléatoires entre 1 et 12
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
