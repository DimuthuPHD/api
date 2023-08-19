<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EducationLevel::updateOrCreate(['name' => 'Preschool / Kindergarten']);
        EducationLevel::updateOrCreate(['name' => 'Primary Education']);
        EducationLevel::updateOrCreate(['name' => 'Secondary Education']);
        EducationLevel::updateOrCreate(['name' => 'Post-Secondary Non-Tertiary Education']);
        EducationLevel::updateOrCreate(['name' => 'Tertiary Education']);
        EducationLevel::updateOrCreate(['name' => 'Graduate Education']);
        EducationLevel::updateOrCreate(['name' => 'Professional Degrees']);
        EducationLevel::updateOrCreate(['name' => 'Certificates and Diplomas']);
    }
}
