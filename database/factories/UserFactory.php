<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password = 'secret';

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => '380'.fake()->numberBetween(100000000, 999999999),
            'invite' => fake()->uuid(),
            'expired_at' => fake()->dateTimeBetween('+7 days', '+30 days'),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
