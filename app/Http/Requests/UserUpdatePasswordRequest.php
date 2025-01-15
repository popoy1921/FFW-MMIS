<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserUpdatePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $oRequest): array
    {
        return [
            'current_password'  => ['required', 'current_password'],
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.current_password' => 'The current password you entered is incorrect.',
            'password.mixedCase' => 'Password must be at least 8 characters and include a mix of uppercase, lowercase, numbers, and special characters.',
            'password.mixedCase' => 'Password must be at least 8 characters and include a mix of uppercase, lowercase, numbers, and special characters.',
            'password.mixedCase' => 'Password must be at least 8 characters and include a mix of uppercase, lowercase, numbers, and special characters.',
            'password.confirmed' => 'The new password and confirmation password do not match.',
        ];
    }
    
    /**
     * failedValidation
     *
     * @param  Validator $validator
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $oValidator)
    {
        // Check if there are errors for the password field
        if ($oValidator->errors()->has('password')) {
            // You can customize the error message or handle it as needed
            $errors = $oValidator->errors()->get('password');
            $bHasPasswordError = false;
            foreach ($errors as $sKey => $error) {
                if (strpos($error, 'confirmation') !== false) {
                    $oValidator->errors()->forget('password');
                    session()->flash('confirmation_error', 'The new password and confirmation password do not match.');
                } else {
                    $bHasPasswordError = true;
                }
            }
            if ($bHasPasswordError === true) {
                $oValidator->errors()->add('password', 'Password must be at least 8 characters and include a mix of uppercase, lowercase, numbers, and special characters.');
            }
        }

        // Call the parent method to handle the default behavior
        throw new ValidationException($oValidator);
    }
}
