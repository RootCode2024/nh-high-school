<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Club;
use App\Models\Tutor;
use App\Models\Classe;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $initial = strtoupper(substr($this->removeAccents($firstName), 0, 1) . substr($this->removeAccents($lastName), 0, 1));
        
        return [
            'academic_year_id' => 1,
            'uuid' => fake()->uuid(),
            'matricule' => 'STUD' . fake()->numberBetween(1000, 9999) . $initial,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => fake()->randomElement(['male', 'female']),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'blood_group' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'religion' => fake()->randomElement(['muslim', 'christian', 'other']),
            'scholarship' => fake()->randomElement(['none', 'partial', 'full']),
            'date_of_birth' => fake()->date('Y-m-d', '-15 years'),
            'cni_number' => fake()->unique()->ean13(),
            'status' => fake()->boolean(),
            'profile_picture' => fake()->imageUrl(),
            'assurance_number' => fake()->ean13(),
            'enable_for_canteen' => fake()->boolean(),
            'alergies' => fake()->sentence(),
            'place_of_birth_id' => Country::query()->inRandomOrder()->value('id') ?? 1,
            'nationality_id' => Country::query()->inRandomOrder()->value('id') ?? 1,
            'club_id' => Club::query()->inRandomOrder()->value('id') ?? null,
            'bus_id' => Bus::query()->inRandomOrder()->value('id') ?? null,
            'tutor_id' => Tutor::query()->inRandomOrder()->value('id') ?? null,
            'classe_id' => Classe::query()->inRandomOrder()->value('id') ?? null,
        ];
    }

    private function removeAccents(string $string): string
    {
        return str_replace(
            ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'], 
            ['A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y'], 
            $string
        );
    }
}
