<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobSeeker;

class JobSeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(JobSeeker::get()->count() < 100){
            JobSeeker::factory(100)->create();
        }
    }
}
