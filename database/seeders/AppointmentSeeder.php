<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Appointment::get()->count() < 1000) {
            $countToCreate = 1000 - Appointment::count();
            Appointment::factory($countToCreate)->create();
        }
    }
}
