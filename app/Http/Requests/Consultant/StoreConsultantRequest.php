<?php

namespace App\Http\Requests\Consultant;

use App\Models\Country;
use App\Models\JobType;
use Illuminate\Foundation\Http\FormRequest;

class StoreConsultantRequest extends FormRequest
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
            'address' => 'required|max:250',
            'telephone' => 'required',
            'email' => 'required|email|unique:consultants,email',
            'job_types' => 'required|array|in:'.implode(',', JobType::all()->pluck('id')->toArray()),
            'countries' => 'required|array|in:'.implode(',', Country::all()->pluck('id')->toArray()),
            'notes' => 'nullable',
            'status' => 'boolean',
        ];
    }
}
