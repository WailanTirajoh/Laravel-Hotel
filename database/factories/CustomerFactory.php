<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = array(
            'Male', 'Female'
        );
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'gender' => $genders[array_rand($genders)],
            'job' => $this->faker->jobTitle,
            'birthdate' => $this->faker->date(),
            'user_id' => User::factory()->isCustomer()
        ];
    }
}
