<?php

use App\Models\EducationLevel;
use App\Models\Gender;
use App\Models\JobType;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

test('job seeker can register', function () {

    $faker = Faker::create();

    $form_params = [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->unique()->safeEmail(),
        'gender_id' => Gender::inRandomOrder()->first()->id,
        'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years', 'Asia/Colombo')->format('Y-m-d'),
        'address' => $faker->address(),
        'telephone' => $faker->phoneNumber(),
        'job_type_id' => JobType::inRandomOrder()->first()->id,
        'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
        'work_experience' => $faker->paragraphs(rand(1, 5), true),
        'notes' => $faker->paragraphs(rand(1, 5), true),
        'email_verified_at' => now(),
        'password' => bcrypt('secret'),
        'remember_token' => Str::random(10),
        'status' => $faker->boolean(50),
    ];

    $response = $this->postJson('/api/register', $form_params);
    $response->assertStatus(200);

});

it('Job Seeker List Load Successfully', function () {
    $user = User::where(['role_id' => 1, 'status' => 1])->first();
    $response = $this->actingAs($user)->get('/admin/job-seeker');
    $response->assertStatus(200);
});

it('Job Seeker create in CMS Successfully', function () {
    $faker = Faker::create();
    $user = User::where(['role_id' => 1, 'status' => 1])->first();

    $form_params = [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->unique()->safeEmail(),
        'gender_id' => Gender::inRandomOrder()->first()->id,
        'date_of_birth' => $faker->dateTimeBetween('-50 years', '-18 years', 'Asia/Colombo')->format('Y-m-d'),
        'address' => $faker->address(),
        'telephone' => $faker->phoneNumber(),
        'job_type_id' => JobType::inRandomOrder()->first()->id,
        'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
        'work_experience' => $faker->paragraphs(rand(1, 5), true),
        'notes' => $faker->paragraphs(rand(1, 5), true),
        'email_verified_at' => now(),
        'password' => bcrypt('secret'),
        'remember_token' => Str::random(10),
        'status' => 1,
    ];

    $response = test()->actingAs($user)->post('/admin/job-seeker', $form_params);
    $response->assertStatus(200);
});
