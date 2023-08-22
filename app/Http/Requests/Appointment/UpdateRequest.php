<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'date_format:Y-m-d|after_or_equal:today',
            'consultant_id' => 'required|exists:users,id',
            'job_seeker_id' => 'required|exists:job_seekers,id',
            'time_from' => 'required',
            'time_to' => 'required|after:time_from',
            'status_id' => 'required|exists:appointment_statuses,id',
        ];
    }
}
