<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $limit = $this->faker->numberBetween(10, 100);
        $times_used = $this->faker->numberBetween(0, $limit);
        return [
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'discount_percentage' => $this->faker->numberBetween(5, 50),
            'start_date' => now()->addDay(random_int(1, 4)),
            'end_date' => now()->addDay(random_int(5, 20)),
            'limit' => $limit,
            'times_used' => $times_used,
            'created_at' => now(),
            'updated_at' => now(),
            'status' => $this->faker->boolean(),
        ];
    }
}