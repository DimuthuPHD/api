<?php

namespace Database\Factories;

use App\Models\EducationLevel;
use App\Models\Gender;
use App\Models\JobType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\jobSeeker>
 */
class JobSeekerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'gender_id' => Gender::inRandomOrder()->first()->id,
            'date_of_birth' => fake()->dateTimeBetween('-50 years', '-18 years', 'Asia/Colombo')->format('Y-m-d'),
            'address' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
            'job_type_id' => JobType::inRandomOrder()->first()->id,
            'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
            'work_experience' => fake()->paragraphs(rand(1, 5), true),
            'notes' => fake()->paragraphs(rand(1, 5), true),
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'remember_token' => Str::random(10),
            'status' => fake()->boolean(50),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
