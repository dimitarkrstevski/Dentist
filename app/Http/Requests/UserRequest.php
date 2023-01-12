<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[-+_!@#$%^&*., ?]).+$/'],
            'phone_number' => 'required',
            'date_of_birth' => 'required',
            'EMBG' => ['required','min:13', 'max:13'],
            'city' => 'required',
            'street' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'The name is required',
            'surname.required' => 'The surname is required',
            'email.required' => 'The email is required',
            'email.email' => 'The email must be valid email address',
            'email.unique' => 'The user with this email address already exist',
            'password.required' => 'The password is required',
            'password.regex' => 'Password must contain at least one capital letter, one lower letter and one special character',
            'password.min' => 'Password should be at least 8 characters long',
            'password.max' => 'Password should not be at more than 16 characters long',
            'EMBG.required' => 'EMBG is required',
            'EMBG.min' => 'EMBG must be 13 characters',
            'EMBG.max' => 'EMBG must be 13 characters',
            'city.required' => 'The city is required',
            'street.required' => 'The street is required',
            'date_of_birth.required' => 'The date of birth is required',
            'phone_number.required' => 'The phone number is required',

        ];
    }

}
