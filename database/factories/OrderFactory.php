<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'user_id' =>1,
        'vendor_id'=> 1,
        'recipient_address' => fake()->address(),
        'recipient_phone' => fake()->phoneNumber(),
        'recipient_name' =>fake()->firstName(),
        'discount'  => fake()->numberBetween(300,800),
        'payment_method' => 'Paystack',
        'order_status' => 'Processing',
        ];
    }
}
