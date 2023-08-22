<?php

namespace App\Rules;

use App\Models\Appointment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsAppointmenAvailable implements ValidationRule
{
    protected $consultant_id;

    protected $job_seeker_id;

    protected $time_from;

    protected $date;

    protected $id;

    public function __construct($consultant_id, $job_seeker_id, $time_from, $date, $id = null)
    {
        $this->consultant_id = $consultant_id;
        $this->job_seeker_id = $job_seeker_id;
        $this->time_from = $time_from;
        $this->id = $id;
        $this->date = $date;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $appoinment = Appointment::where([
            'consultant_id' => $this->consultant_id,
            'job_seeker_id' => $this->job_seeker_id,
            'date' => $this->date,
        ])
            ->where('time_from', '<', $this->time_from)
            ->where('time_to', '>', $value);
            
        // if ($this->id !== null) {
        //     $appoinment = $appoinment->where('id', '!=', $this->id);
        // }

        $appoinment = $appoinment->first();

        if ($appoinment) {
            $fail('The consultant is not available at this time');
        }
    }
}
