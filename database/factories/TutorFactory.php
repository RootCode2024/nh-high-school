<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tutor>
 */
class TutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->optional()->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'cni_number' => $this->faker->optional()->numerify('######'),
            'work' => $this->faker->optional()->jobTitle(),
            'type' => $this->faker->randomElement(['father', 'mother', 'sister', 'brother', 'uncle', 'aunt', 'grand_father', 'grand_mother']),
            'date_of_birth' => $this->faker->date(),
            'place_of_birth_id' => Country::all()->random()->id,
            'nationality_id' => Country::all()->random()->id,
            'profile_picture' => $this->faker->optional()->imageUrl(),
        ];
    }
}
