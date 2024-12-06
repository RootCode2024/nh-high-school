<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'cni_number' => $this->faker->unique()->numerify('######'),
            'speciality' => $this->faker->jobTitle(),
            'hire_date' => $this->faker->date(),
            'date_of_first_appointment' => $this->faker->date(),
            'date_of_birth' => $this->faker->date(),
            'place_of_birth_id' => Country::all()->random()->id,
            'nationality_id' => Country::all()->random()->id,
            'current_salary' => $this->faker->numberBetween(100000, 1000000),
            'status' => true,
            'profile-picture' => $this->faker->optional()->imageUrl(),
        ];
    }
}
