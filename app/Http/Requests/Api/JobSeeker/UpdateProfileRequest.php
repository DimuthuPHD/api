<?php

namespace App\Http\Requests\Api\JobSeeker;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
        $rules['first_name'] = ['required', 'max:70'];
        $rules['last_name'] = ['required', 'max:70'];
        $rules['telephone'] = ['required'];
        $rules['email'] = ['required', 'email'];
        $rules['notes'] = ['nullable', 'max:1500'];
        $rules['password'] = ['nullable', 'min:8', 'confirmed'];

        return $rules;
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors(),
        ]));
    }
}
