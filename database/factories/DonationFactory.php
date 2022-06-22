<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nickname' => $this->faker->name(),
            'message' => $this->faker->sentence(10),
            'trash_weights' => mt_rand(0, 4000),
            'money_amount' => mt_rand(200000000, 500000000),
        ];
    }
}
