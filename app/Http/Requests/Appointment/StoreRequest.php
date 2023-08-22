<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'date' => 'date|after_or_equal:today',
            'time_from' => 'date_format:H:i',
            'time_to' => 'date_format:H:i|after:time_from',
            'consultant_id' => 'required|exists:users,id',
            'job_seeker_id' => 'required|exists:job_seekers,id',
            'status_id' => 'required|exists:appointment_statuses,id',
        ];
    }
}
