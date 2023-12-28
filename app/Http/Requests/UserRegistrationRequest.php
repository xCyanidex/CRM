<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
        $rules = [
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'userType' => 'required|string|in:company,freelancer,employee',
        ];

        if ($this->input('userType') === 'company') {
            $rules += [
                'company_name' => 'required|string',
                'business_type' => 'required|string',
                'industry' => 'required|string',
                'registration_number' => 'required',
            ];
        } elseif ($this->input('userType') === 'freelancer') {
            $rules += [
                'freelancer_name' => 'required|string',
                'industry' => 'required|string',
            ];
        } elseif ($this->input('userType') === 'employee') {
            $rules += [
                'employee_name' => 'required|string',
                'phone_number' => 'required|string',
                'dob' => 'required|date',
                'gender' => 'required|string|in:male,female,other',
                'department_id' => 'required|integer|exists:departments,id',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required.',
            'username.unique' => 'Username already exists.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password should be at least 6 characters long.',
            'user_type.required' => 'User type is required.',
            'user_type.in' => 'Invalid user type.',
        ];
    }
}
