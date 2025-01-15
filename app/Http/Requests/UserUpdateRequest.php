<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $oUser = User::firstwhere('guid', $this->input('guid'));
        return [
            'fname' => ['required', 'regex:/^[\p{L}\'\s-]+$/u', 'max:50'],
            'mname' => ['nullable', 'regex:/^[\p{L}\'\s-]*$/u', 'max:50'],
            'lname' => ['required', 'regex:/^[\p{L}\'\s-]+$/u', 'max:50'],
            'email' => ['required', 'custom_email', 'unique:users,email,' . $oUser->id],
        ];
    }

    public function messages()
    {
        $sNameError = 'Enter a valid name with only letters, hyphens, apostrophes, spaces, and up to 50 characters.';
        return [
            'fname.regex' => $sNameError,            
            'mname.regex' => $sNameError,
            'lname.regex' => $sNameError,
            'fname.max' => $sNameError,            
            'mname.max' => $sNameError,
            'lname.max' => $sNameError,
            'email.custom_email' => 'Please enter a valid email address (e.g., example@domain.com).',
            'email.unique' => 'This email address is already associated with another account.',
        ];
    }
}
