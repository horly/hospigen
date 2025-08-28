<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserForm extends FormRequest
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
            'full_name_register' => 'required|regex:/^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/',
            'email_register' => 'required|email',
            'password_register' => 'required|min:8',
            'password_confirm_register' => 'required|same:password_register',
            'role_register' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'full_name_register.required' => __('auth.please_enter_the_users_full_name'),
            'full_name_register.regex' => __('auth.please_enter_a_valid_full_name'),
            'email_register.required' => __('auth.please_enter_the_users_email_address'),
            'email_register.email' => __('auth.enter_a_valid_email_please'),
            'password_register.required' => __('auth.please_enter_the_users_password'),
            'password_register.min' => __('auth.error_password_register_message'),
            'password_confirm_register.required' => __('auth.please_confirm_password'),
            'password_confirm_register.same' => __('auth.password_confirmation_register_message'),
            'role_register.required' => __('auth.please_select_the_role'),
        ];
    }
}
