<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'bus_type' => $this->faker->randomElement(['Scania', 'Mercedes', 'Toyota', 'Ford']),
            'bus_number' => $this->faker->unique()->bothify('AB-####'),
            'driver_fullname' => $this->faker->name(),
            'helper_fullname' => $this->faker->name(),
            'driver_phone' => $this->faker->unique()->e164PhoneNumber(),
            'helper_phone' => $this->faker->unique()->e164PhoneNumber(),
            'driver_cni_number' => $this->faker->unique()->numerify('###-####-######'),
            'helper_cni_number' => $this->faker->unique()->numerify('###-####-######'),
            'route' => $this->faker->randomElement(['Pikine', 'Gueule Tapee', 'Fann', 'HLM', 'Grand Dakar', 'Almadies', 'Ngor', 'Ouakam', 'Yoff', 'Dakar Plateau']),
            'capacity' => $this->faker->numberBetween(20, 100),
            'status' => $this->faker->boolean(100),
        ];
    }
}
