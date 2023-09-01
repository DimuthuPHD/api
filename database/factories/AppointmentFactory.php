<?php

namespace Database\Factories;

use App\Models\Consultant;
use App\Models\JobSeeker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a date and time for the appointment
        $dateTime = fake()->dateTimeThisYear(null, 'Asia/Colombo');
        $dateTime = Carbon::parse($dateTime);

        $appointmentDate = $dateTime->format('Y-m-d');
        $timeFrom = $dateTime->format('H:i');
        $timeTo = $dateTime->addHour()->format('H:i');

        // Randomly select one consultant and one job seeker from the available list
        $consultant = $this->getAvailableUser('consultant', $appointmentDate, $timeFrom, $timeTo);
        $jobSeeker = $this->getAvailableUser('job_seeker', $appointmentDate, $timeFrom, $timeTo);

        if (! $consultant || ! $jobSeeker) {
            return [];
        }

        return [
            'job_seeker_id' => Consultant::inRandomOrder()->first()->id,
            'consultant_id' => JobSeeker::inRandomOrder()->first()->id,
            'date' => $dateTime,
            'time_from' => $timeFrom,
            'time_to' => $timeTo,
            'status_id' => 1,
            'notes' => fake()->paragraphs(rand(1, 5), true),
        ];
    }

    /**
     * Retrieve available users (consultants or job seekers) at the specified time.
     *
     * @param  string  $userType
     * @param  string  $date
     * @param  string  $timeFrom
     * @param  string  $timeTo
     */
    private function getAvailableUser($userType, $date, $timeFrom, $timeTo)
    {
        $userModel = $userType === 'consultant' ? Consultant::query() : JobSeeker::query();

        return $userModel
            ->whereDoesntHave('appointments', function ($query) use ($date, $timeFrom, $timeTo) {
                $query->where('date', $date)
                    ->where('time_from', '<', $timeTo)
                    ->where('time_to', '>', $timeFrom);
            })
            ->first();
    }
}
