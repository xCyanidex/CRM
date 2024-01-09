<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email', // Validation rule for email field
            'password' => 'required',   // Validation rule for password field
        ];
    }

    /**
     * Get the custom validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',      // Custom error message for the required email field
            'password.required' => 'Password is required!' // Custom error message for the required password field
        ];
    }

    // /**
    //  * Get filters to be applied to the input.
    //  *
    //  * @return array
    //  */
    // public function filters()
    // {
    //     return [
    //         'email' => 'trim|lowercase',
    //     ];
    // }
}
