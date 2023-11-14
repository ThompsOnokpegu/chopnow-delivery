<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $business_name = fake()->company();
        $first_name = fake()->firstName();
        return [
            'first_name' => $first_name,
            'last_name' => fake()->lastName(),
            'email' => Str::lower($first_name).'@gmail.com',
            'business_name'=> $business_name,
            'slug' => str()->slug($business_name),
            'phone' => fake()->phoneNumber(),
            'business_phone'=>fake()->phoneNumber(),
            'address' => fake()->address(),
            'delivery_fee' => 400,
            'preparation_time' => 20,
            'city' => 'Calabar',
            'restaurant_type' => 'Nigerian',
            'business_type' => 'Registered',
            'kitchen_banner_image' => 'brand-image.png',
            'email_verified_at' => now(),
            'featured' => 0,
            //'password' => Hash::make('naija123'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            
        ];
    }
}
