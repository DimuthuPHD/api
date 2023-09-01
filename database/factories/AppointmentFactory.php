<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\JobSeeker;
use App\Models\Slot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    public function definition()
    {
        return [
            'job_seeker_id' => JobSeeker::inRandomOrder()->first()->id,
            'slot_id' => Slot::inRandomOrder()->first()->id,
            'status_id' => AppointmentStatus::inRandomOrder()->first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($appointment) {
            while (Appointment::where([
                'job_seeker_id' => $appointment->job_seeker_id,
                'slot_id' => $appointment->slot_id,
                'status_id' => $appointment->status_id,
            ])->exists()) {
                $this->definition();
                $appointment->save();
            }
        });
    }
}
