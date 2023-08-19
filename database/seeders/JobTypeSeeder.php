<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobType::updateOrCreate(['name' => 'Healthcare']);
        JobType::updateOrCreate(['name' => 'Engineering']);
        JobType::updateOrCreate(['name' => 'Information Technology (IT)']);
        JobType::updateOrCreate(['name' => 'Finance']);
        JobType::updateOrCreate(['name' => 'Sales']);
        JobType::updateOrCreate(['name' => 'Marketing']);
        JobType::updateOrCreate(['name' => 'Education']);
        JobType::updateOrCreate(['name' => 'Manufacturing']);
        JobType::updateOrCreate(['name' => 'Administration']);
        JobType::updateOrCreate(['name' => 'Customer Service']);
        JobType::updateOrCreate(['name' => 'Human Resources']);
        JobType::updateOrCreate(['name' => 'Retail']);
        JobType::updateOrCreate(['name' => 'Hospitality']);
        JobType::updateOrCreate(['name' => 'Construction']);
        JobType::updateOrCreate(['name' => 'Transportation and Logistics']);
        JobType::updateOrCreate(['name' => 'Arts and Entertainment']);
        JobType::updateOrCreate(['name' => 'Media and Communication']);
        JobType::updateOrCreate(['name' => 'Legal']);
        JobType::updateOrCreate(['name' => 'Research and Development']);
        JobType::updateOrCreate(['name' => 'Agriculture']);
        JobType::updateOrCreate(['name' => 'Nonprofit and Social Services']);
        JobType::updateOrCreate(['name' => 'Public Service and Government']);
    }
}
