<?php

namespace Database\Seeders;

use App\Models\Consultant;
use App\Models\Country;
use App\Models\JobType;
use Illuminate\Database\Seeder;

class ConsultantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Consultant::get()->count() < 100) {
            Consultant::factory(100)->create()->each(function ($consultant) {
                $countryIds = Country::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray();
                $jobTypeIds = JobType::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray();
                $consultant->countries()->attach($countryIds);
                $consultant->jobTypes()->attach($jobTypeIds);
            });
        }
    }
}
