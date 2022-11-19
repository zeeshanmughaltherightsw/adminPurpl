<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->firstname() . ' ' . fake()->lastName(),
            'username' => fake()->userName(),
            'phone_no' => fake()->phoneNumber(),
            'ref_by' => mt_rand(4, 203),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'status' => Arr::random(['active', 'baned']),
            'user_type' => 'user',
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
            'phone_no' => fake()->phoneNumber(),
            'mv' => fake()->boolean(),
            'ev' => fake()->boolean(),
            'two_fa' => fake()->boolean(),
            'address' => fake()->address(),
            // 'investment' => mt_rand(1, 1000000)
            'investment' => 0
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
