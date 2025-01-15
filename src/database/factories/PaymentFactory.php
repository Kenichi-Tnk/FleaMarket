<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(100, 1000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
