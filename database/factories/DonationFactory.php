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
        $weight = mt_rand(0,4000);
        $money = $weight * 5000;
        return [
            'nickname' => $this->faker->name(),
            'message' => $this->faker->sentence(6),
            'trash_weights' => $weight,
            'money_amount' => $money,
        ];
    }
}
