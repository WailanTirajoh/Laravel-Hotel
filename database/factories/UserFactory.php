<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = [
            'Admin',
        ];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'role' => $roles[array_rand($roles)],
            'password' => Hash::make('admin'), // password
            'remember_token' => Str::random(10),
            'random_key' => Str::random(60),
            // 'avatar' => $this->faker->image('public/img/user/testing/',640,480, null, false),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function isCustomer()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'Customer',
            ];
        });
    }
}
