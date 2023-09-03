<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => ['required', 'max:70'],
            'last_name' => ['required', 'max:70'],
            'phone' => ['required'],
            'password' => ['nullable', 'min:8'],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'notes' => ['nullable', 'max:500'],
        ];

        if (auth()->user()->isConsultant()) {
            $rules['countries'] = ['required', 'array'];
        }

        return $rules;
    }
}
