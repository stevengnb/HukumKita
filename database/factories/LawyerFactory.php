<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lawyer>
 */
class LawyerFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genders = [
            'male',
            'female',
        ];

        $educations = [
            'High School',
            'Associate Degree',
            'Bachelor\'s Degree',
            'Master\'s Degree',
            'Doctorate (PhD)',
            'JD (Juris Doctor)',
            'MD (Doctor of Medicine)',
            'Law Degree',
            'Postgraduate Diploma',
            'Diploma',
            'Vocational Training',
            'Self-Taught',
        ];

        $categories = [
            "Perkawinan & Perceraian",
            "Perdata",
            "Ketenagakerjaan",
            "Pertanahan",
            "Perpajakan",
            "Pidana"
        ];

        return [
            'name' => $this->faker->firstName().' '.$this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phoneNumber' => '08'.$this->faker->numberBetween(10, 99).'-'.$this->faker->numberBetween(1000, 9999).'-'.$this->faker->numberBetween(1000, 9999),
            'gender' => $this->faker->randomElement($genders),
            'password' => static::$password ??= Hash::make('password'),
            'education' => $this->faker->randomElement($educations),
            'address' => $this->faker->address(),
            'experience' => $this->faker->dateTimeBetween('1990-01-01', '2020-01-01'),
            'dob' => $this->faker->dateTimeBetween('1950-01-01', '2000-01-01'),
            'rate' => $this->faker->randomFloat(1, 0, 5),
            // 'rate' => $this->faker->randomElement([50000, 60000, 70000, 80000, 90000, 100000, 110000, 120000, 130000, 140000, 150000]),
            'profileLink' => file_get_contents(public_path('images/lawyer-dummy.jpg')),

        ];
    }
}
