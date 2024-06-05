<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Payment::class;

    public function definition(): array
    {
        $amountPayable = $this->faker->randomFloat(2, 100, 1000);
        $paymentAmount = $this->faker->randomFloat(2, 0, $amountPayable);
        $paymentStatus = $paymentAmount >= $amountPayable ? 'paid' : ($paymentAmount == 0 ? 'unpaid' : 'pending');
        $remains = $paymentAmount >= $amountPayable ? null : $amountPayable - $paymentAmount;

        return [
            'employee_id' => Employee::factory(),
            'amount_payable' => $amountPayable,
            'payment_amount' => $paymentAmount,
            'payment_status' => $paymentStatus,
            'remains' => $remains,
            'payment_method' => $this->faker->randomElement(['cash', 'card', 'cheque', 'transfer']),
        ];
    }
}
