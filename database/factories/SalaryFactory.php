<?php

namespace Database\Factories;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Salary>
 */
class SalaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Salary::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'montant' => $this->faker->randomFloat(2, 1000, 5000), // Generate a random salary amount between 1000 and 5000 with 2 decimal places
            'period' => $this->faker->month(). '/'. $this->faker->year(), // Generate a random salary period in the format: month/year
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
