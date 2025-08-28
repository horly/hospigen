<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'license-day' => 'required',
            'license-month' => 'required',
            'license-year' => 'required',
            'license-type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'license-day.required' => __('licence.all_fields_are_required'),
            'license-month.required' => __('licence.all_fields_are_required'),
            'license-day.year' => __('licence.all_fields_are_required'),
            'license-day.type' => __('licence.all_fields_are_required'),
        ];
    }
}
