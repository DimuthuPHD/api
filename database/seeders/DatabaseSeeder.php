<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ConsultantSeeder::class);
        $this->call(JobTypeSeeder::class);
        $this->call(EducationLevelSeeder::class);
        $this->call(JobSeekerSeeder::class);
        $this->call(AppointmentStatusSeeder::class);
        $this->call(AppointmentSeeder::class);
    }
}
