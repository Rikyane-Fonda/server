<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'department_id' => Department::factory(),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'national_ID_card' => $this->faker->optional()->unique()->numberBetween(1000000000, 9999999999),
            'email' => $this->faker->optional()->unique()->safeEmail,
            'adress' => $this->faker->optional()->address,
            'city' => $this->faker->optional()->city,
            'state' => $this->faker->optional()->state,
            'postal_code' => $this->faker->optional()->postcode,
            'Telephone' => $this->faker->optional()->phoneNumber,
            'hiring_date' => $this->faker->optional()->dateTime,
            'departure_date' => $this->faker->optional()->dateTime,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
