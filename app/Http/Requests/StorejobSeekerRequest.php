<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorejobSeekerRequest extends FormRequest
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
            'gender_id' => 'required|exists:genders,id',
            'first_name' => 'required|max:70',
            'last_name' => 'required|max:70',
            'date_of_birth' => 'required|date',
            'address' => 'required|max:250',
            'telephone' => 'required|unique:job_seekers,telephone',
            'email' => 'required|email|unique:job_seekers,email',
            'job_type_id' => 'required|exists:job_types,id',
            'education_level_id' => 'required|exists:education_levels,id',
            'work_experience' => 'required',
            'notes' => 'nullable',
            'status' => 'boolean',
        ];
    }
}
