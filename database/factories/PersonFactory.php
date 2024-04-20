<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        return [
            'full_name'=>fake()->name(),
            'gender'=>fake()->boolean(),
            'birthdate'=>fake()->dateTimeBetween('-50 years', '-18 years'),
            'phone_number'=>fake()->phoneNumber(),
            'address'=>fake()->address(),
            'user_id' => $this->faker->unique()->numberBetween(1, $users->count()),
            'company_id' => Company::query()->inRandomOrder()->value('id'),
        ];
    }
}
