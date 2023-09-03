<?php

namespace Database\Seeders;

use App\Models\AppointmentStatus;
use Illuminate\Database\Seeder;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppointmentStatus::updateOrCreate(['name' => 'created']);
        AppointmentStatus::updateOrCreate(['name' => 'started']);
        AppointmentStatus::updateOrCreate(['name' => 'ended']);
        AppointmentStatus::updateOrCreate(['name' => 'cancelled']);
    }
}
