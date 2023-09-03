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

        $rules = [
            'job_seeker_id' => ['required', 'exists:job_seekers,id'],
            'consultant_id' => ['required', 'exists:consultants,id'],
            'slot_id' => ['required', 'exists:slots,id'],
            'status_id' => ['required', 'exists:appointment_statuses,id'],
            'notes' => ['sometimes', 'max:1200'],
        ];

        return $rules;
    }
}
