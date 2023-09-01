<?php

namespace Database\Factories;

use App\Models\JobSeeker;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slot>
 */
class SlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $dateTime = $this->faker->dateTimeThisYear(null, 'Asia/Colombo');
        $dateTime = Carbon::parse($dateTime);
        $timeFrom = $dateTime->format('H:i');
        $timeTo = $dateTime->addHour()->format('H:i');

        return [
            'consultant_id' => function () {
                return JobSeeker::inRandomOrder()->first()->id;
            },
            'date' => $dateTime,
            'time_from' => $timeFrom,
            'time_to' => $timeTo,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($slot) {
            while (Slot::where([
                'consultant_id' => $slot->consultant_id,
                'date' => $slot->date,
                'time_from' => $slot->time_from,
                'time_to' => $slot->time_to,
            ])->exists()) {
                $this->definition();
                $slot->save();
            }
        });
    }
}
